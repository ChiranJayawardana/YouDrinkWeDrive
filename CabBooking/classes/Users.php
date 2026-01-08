<?php
require_once('../config.php');
Class Users extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_users(){
		if(!isset($_POST['status']) && $this->settings->userdata('login_type') == 1){
			$_POST['status'] = 1;
		}
		extract($_POST);
		$oid = $id;
		$data = '';
		if(isset($oldpassword)){
			if(md5($oldpassword) != $this->settings->userdata('password')){
				return 4;
			}
		}
		$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' ".($id>0? " and id!= '{$id}' " : ""))->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		foreach($_POST as $k => $v){
			if(in_array($k,array('firstname','middlename','lastname','username','type'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(!empty($password)){
			$password = md5($password);
			if(!empty($data)) $data .=" , ";
			$data .= " `password` = '{$password}' ";
		}

		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if($qry){
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success','User Details successfully saved.');
				$resp['status'] = 1;
			}else{
				$resp['status'] = 2;
			}

		}else{
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully updated.');
				if($id == $this->settings->userdata('id')){
					foreach($_POST as $k => $v){
						if($k != 'id'){
							if(!empty($data)) $data .=" , ";
							$this->settings->set_userdata($k,$v);
						}
					}
					
				}
				$resp['status'] = 1;
			}else{
				$resp['status'] = 2;
			}
			
		}
		
		// ============================================================
		// UPDATED IMAGE UPLOAD - Save to uploads/admin/ folder
		// ============================================================
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			// Create admin directory if it doesn't exist
			if(!is_dir(base_app.'uploads/admin/')){
				mkdir(base_app.'uploads/admin/', 0777, true);
			}
			
			// Save to uploads/admin/ folder with unique filename
			$fname = 'uploads/admin/admin-'.$id.'-'.time().'.png';
			$dir_path = base_app. $fname;
			$upload = $_FILES['img']['tmp_name'];
			$type = mime_content_type($upload);
			$allowed = array('image/png','image/jpeg');
			
			if(!in_array($type,$allowed)){
				$resp['msg'].=" But Image failed to upload due to invalid file type.";
			}else{
				// Check if GD library is available
				if(function_exists('imagecreatetruecolor') && function_exists('imagecreatefrompng') && function_exists('imagecreatefromjpeg')){
					// Use GD library for image resizing
					$new_height = 200; 
					$new_width = 200; 
			
					list($width, $height) = getimagesize($upload);
					$t_image = imagecreatetruecolor($new_width, $new_height);
					imagealphablending( $t_image, false );
					imagesavealpha( $t_image, true );
					$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
					if($gdImg){
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						
						// Delete old admin image before uploading new one
						$old_avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array();
						if($old_avatar && isset($old_avatar['avatar'])){
							$old_path = base_app.explode('?',$old_avatar['avatar'])[0];
							if(is_file($old_path)){
								unlink($old_path);
							}
						}
						
						$uploaded_img = imagepng($t_image,$dir_path);
						imagedestroy($gdImg);
						imagedestroy($t_image);
					}else{
						$resp['msg'].=" But Image failed to upload due to unkown reason.";
					}
				}else{
					// Fallback: Save file directly without resizing (GD library not available)
					// Delete old admin image before uploading new one
					$old_avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array();
					if($old_avatar && isset($old_avatar['avatar'])){
						$old_path = base_app.explode('?',$old_avatar['avatar'])[0];
						if(is_file($old_path)){
							unlink($old_path);
						}
					}
					
					// Determine file extension based on mime type
					$ext = ($type == 'image/png') ? 'png' : 'jpg';
					$fname = 'uploads/admin/admin-'.$id.'-'.time().'.'.$ext;
					$dir_path = base_app. $fname;
					if(move_uploaded_file($upload, $dir_path)){
						$uploaded_img = true;
					}else{
						$resp['msg'].=" But Image failed to upload due to unkown reason.";
					}
				}
			}
			
			if(isset($uploaded_img) && $uploaded_img){
				$this->conn->query("UPDATE users set `avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}' ");
				if($id == $this->settings->userdata('id')){
					$this->settings->set_userdata('avatar',$fname);
				}
			}
		}
		
		if(isset($resp['msg']))
			$this->settings->set_flashdata('success',$resp['msg']);
		return  $resp['status'];
	}
	
	public function delete_users(){
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			// Remove ?v= timestamp from avatar path before deleting
			if($avatar){
				$avatar_path = explode('?',$avatar)[0];
				if(is_file(base_app.$avatar_path)){
					unlink(base_app.$avatar_path);
				}
			}
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	
	public function save_client(){
		if(!empty($_POST['password']))
		$_POST['password'] = md5($_POST['password']);
		else
		unset($_POST['password']);
		if(isset($_POST['oldpassword'])){
			if($this->settings->userdata('id') > 0 && $this->settings->userdata('login_type') == 2){
				$get = $this->conn->query("SELECT * FROM `client_list` where id = '{$this->settings->userdata('id')}'");
				$res = $get->fetch_array();
				if($res['password'] != md5($_POST['oldpassword'])){
					return  json_encode([
						'status' =>'failed',
						'msg'=>' Current Password is incorrect.'
					]);
				}
			}
			unset($_POST['oldpassword']);
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id'))){
				if(!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `client_list` where email = '{$email}' and delete_flag ='0' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = ' Email already exists in the database.';
		}else{
			if(empty($id)){
				$sql = "INSERT INTO `client_list` set $data";
			}else{
				$sql = "UPDATE `client_list` set $data where id = '{$id}'";
			}
			$save = $this->conn->query($sql);
			if($save){
				$resp['status'] = 'success';
				$uid = empty($id) ? $this->conn->insert_id : $id;
				if(empty($id)){
					$resp['msg'] = " Account is successfully registered.";
				}else if($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2){
					$resp['msg'] = " Account Details has been updated successfully.";
					foreach($_POST as $k => $v){
						if(!in_array($k,['password'])){
							$this->settings->set_userdata($k,$v);
						}
					}
				}else{
					$resp['msg'] = " Client's Account Details has been updated successfully.";
				}
				if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					if(!is_dir(base_app."uploads/clients/"))
						mkdir(base_app."uploads/clients/", 0777, true);
					$fname = 'uploads/clients/'.$uid.'.png';
					$dir_path =base_app. $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png','image/jpeg');
					if(!in_array($type,$allowed)){
						$resp['msg'].=" But Image failed to upload due to invalid file type.";
					}else{
						// Check if GD library is available
						if(function_exists('imagecreatetruecolor') && function_exists('imagecreatefrompng') && function_exists('imagecreatefromjpeg')){
							// Use GD library for image resizing
							$new_height = 200; 
							$new_width = 200; 
					
							list($width, $height) = getimagesize($upload);
							$t_image = imagecreatetruecolor($new_width, $new_height);
							imagealphablending( $t_image, false );
							imagesavealpha( $t_image, true );
							$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
							if($gdImg){
								imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
								if(is_file($dir_path))
									unlink($dir_path);
								$uploaded_img = imagepng($t_image,$dir_path);
								imagedestroy($gdImg);
								imagedestroy($t_image);
							}else{
								$resp['msg'].=" But Image failed to upload due to unkown reason.";
							}
						}else{
							// Fallback: Save file directly without resizing (GD library not available)
							if(is_file($dir_path))
								unlink($dir_path);
							// Determine file extension based on mime type
							$ext = ($type == 'image/png') ? 'png' : 'jpg';
							$fname = 'uploads/clients/'.$uid.'.'.$ext;
							$dir_path = base_app. $fname;
							if(move_uploaded_file($upload, $dir_path)){
								$uploaded_img = true;
							}else{
								$resp['msg'].=" But Image failed to upload due to unkown reason.";
							}
						}
					}
					if(isset($uploaded_img) && $uploaded_img){
						$this->conn->query("UPDATE client_list set `image_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}' ");
						if($id == $this->settings->userdata('id') && $this->settings->userdata('login_type') == 2){
								$this->settings->set_userdata('image_path',$fname);
						}
					}
				}
			}else{
				$resp['status'] = 'failed';
				if(empty($id)){
					$resp['msg'] = " Account has failed to register for some reason.";
				}else if($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2){
					$resp['msg'] = " Account Details has failed to update.";
				}else{
					$resp['msg'] = " Client's Account Details has failed to update.";
				}
			}
		}
		
		if($resp['status'] == 'success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);

	} 
	
	function delete_client(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `client_list` set delete_flag = 1 where id='{$id}'");
		if($del){
			$resp['status'] = 'success';
			$resp['msg'] = ' Client Account has been deleted successfully.';
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = " Client Account has failed to delete";
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
	break;
	case 'delete':
		echo $users->delete_users();
	break;
	case 'save_client':
		echo $users->save_client();
	break;
	case 'delete_client':
		echo $users->delete_client();
	break;
	break;
	default:
		// echo $sysset->index();
		break;
}
?>