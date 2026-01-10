<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = " Category already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success'," New Category successfully saved.");
			else
				$this->settings->set_flashdata('success'," Category successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `category_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Category successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_cab(){
		// Initialize response
		$resp = array('status' => 'failed', 'msg' => '');
		
		// Suppress any output that might interfere with JSON response
		ob_start();
		
		try {
			if(!empty($_POST['password']))
				$_POST['password'] = md5($_POST['password']);
			else
				unset($_POST['password']);
			if(empty($_POST['id'])){
				$prefix = date('Ym-');
				$code = sprintf("%'.05d",1);
				while(true){
					$check = $this->conn->query("SELECT * FROM `driver_list` where reg_code = '{$prefix}{$code}'")->num_rows;
					if($check > 0){
						$code = sprintf("%'.05d",ceil($code) + 1);
					}else{
						break;
					}
				}
				$_POST['reg_code'] = $prefix.$code;
				// Set default status to Active (1) if not provided
				if(!isset($_POST['status']) || $_POST['status'] === ''){
					$_POST['status'] = 1;
				}
			}

			extract($_POST);
			$data = "";
			foreach($_POST as $k =>$v){
				if(!in_array($k,array('id','oldpassword','img'))){
					$v = $this->conn->real_escape_string($v);
					if(!empty($data)) $data .=",";
					$data .= " `{$k}`='{$v}' ";
				}
			}
			
			if(isset($oldpassword)){
				$cur_pass = $this->conn->query("SELECT `password` from `driver_list` where id = '{$this->settings->userdata('id')}'")->fetch_array()[0];
				if(md5($oldpassword) != $cur_pass){
					$resp['status'] = 'failed';
					$resp['msg'] = " Current Password is Incorrect.";
					ob_end_clean();
					return json_encode($resp);
				}
			}
			
			if(empty($id)){
				$sql = "INSERT INTO `driver_list` set {$data} ";
				$save = $this->conn->query($sql);
			}else{
				$sql = "UPDATE `driver_list` set {$data} where id = '{$id}' ";
				$save = $this->conn->query($sql);
			}
			
			if($save){
				$resp['status'] = 'success';
				$cid = empty($id) ? $this->conn->insert_id : $id;
				$resp['id'] = $cid ;
				if(empty($id))
					$resp['msg'] = " New Driver successfully saved.";
				else
					$resp['msg'] = " Driver successfully updated.";
					
					// Handle image upload first
					$image_uploaded = false;
					$new_image_path = '';
					if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '' && $_FILES['img']['error'] == 0){
						// Check if GD library is available
						if(!function_exists('imagecreatetruecolor')){
							$resp['msg'] .= " But Image failed to upload: GD library is not available.";
						}else{
							// Create directory if it doesn't exist
							$upload_dir = base_app."uploads/drivers/";
							if(!is_dir($upload_dir)){
								if(!@mkdir($upload_dir, 0755, true)){
									$resp['msg'] .= " But Image failed to upload: Could not create upload directory.";
								}
							}
							
							// Check if directory is writable
							if(!is_writable($upload_dir)){
								$resp['msg'] .= " But Image failed to upload: Upload directory is not writable.";
							}else{
							
							$fname = 'uploads/drivers/'.$cid.'.png';
							$dir_path = base_app. $fname;
							$upload = $_FILES['img']['tmp_name'];
							
							// Check file size (max 5MB)
							if($_FILES['img']['size'] > 5242880){
								$resp['msg'] .= " But Image failed to upload: File size exceeds 5MB limit.";
							}elseif($_FILES['img']['size'] == 0){
								$resp['msg'] .= " But Image failed to upload: File is empty.";
							}else{
								$type = mime_content_type($upload);
								$allowed = array('image/png','image/jpeg','image/jpg');
								
								if(!in_array($type,$allowed)){
									$resp['msg'] .= " But Image failed to upload due to invalid file type. Only PNG and JPEG are allowed.";
								}else{
									$new_height = 200; 
									$new_width = 200; 
							
									$image_info = @getimagesize($upload);
									if($image_info === false){
										$resp['msg'] .= " But Image failed to upload: Invalid image file.";
									}else{
										list($width, $height) = $image_info;
										$t_image = @imagecreatetruecolor($new_width, $new_height);
										
										if($t_image === false){
											$resp['msg'] .= " But Image failed to upload: Could not create image resource.";
										}else{
											imagealphablending($t_image, false);
											imagesavealpha($t_image, true);
											
											// Create image from file
											if($type == 'image/png'){
												$gdImg = @imagecreatefrompng($upload);
											}else{
												$gdImg = @imagecreatefromjpeg($upload);
											}
											
											if($gdImg === false){
												$resp['msg'] .= " But Image failed to upload: Could not process image file.";
												imagedestroy($t_image);
											}else{
												imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
												
												// Delete old file if exists
												if(is_file($dir_path))
													@unlink($dir_path);
												
												$uploaded_img = @imagepng($t_image,$dir_path);
												imagedestroy($gdImg);
												imagedestroy($t_image);
												
												if($uploaded_img){
													// Store only the file path without query string
													$update_sql = "UPDATE driver_list set `image_path` = '".$this->conn->real_escape_string($fname)."' where id = '{$cid}' ";
													$this->conn->query($update_sql);
													$image_uploaded = true;
													$new_image_path = $fname;
													$resp['msg'] .= " Image uploaded successfully.";
												}else{
													$resp['msg'] .= " But Image failed to upload: Could not save image file.";
												}
											}
										}
									}
								}
							}
							}
						}
					}elseif(isset($_FILES['img']) && $_FILES['img']['error'] != 0){
						// Handle file upload errors
						$upload_errors = array(
							1 => 'File exceeds upload_max_filesize',
							2 => 'File exceeds MAX_FILE_SIZE',
							3 => 'File was only partially uploaded',
							4 => 'No file was uploaded',
							6 => 'Missing temporary folder',
							7 => 'Failed to write file to disk',
							8 => 'A PHP extension stopped the file upload'
						);
						$error_code = $_FILES['img']['error'];
						$error_msg = isset($upload_errors[$error_code]) ? $upload_errors[$error_code] : 'Unknown upload error';
						$resp['msg'] .= " But Image failed to upload: ".$error_msg.".";
					}
					
					// Update session if it's the logged-in driver (after image upload)
					if($this->settings->userdata('id')  == $cid && $this->settings->userdata('login_type') == 3){
						// Update session with POST data (excluding password and img)
						foreach($_POST as $k => $v){
							if(!in_array($k,['password', 'oldpassword', 'cpassword', 'img']))
								$this->settings->set_userdata($k,$v);
						}
						
						// Always refresh ALL driver data from database to ensure session is up-to-date
						$driver_data = $this->conn->query("SELECT * FROM driver_list where id = '{$cid}'")->fetch_assoc();
						if($driver_data){
							foreach($driver_data as $k => $v){
								if(!is_numeric($k) && $k != 'password'){
									$this->settings->set_userdata($k, $v);
								}
							}
						}
						
						$resp['msg'] = " Account successfully updated.";
					}
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "Database error: ".$this->conn->error;
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		} catch (Exception $e) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Error: ".$e->getMessage();
		}
		
		// Clean any output and return JSON
		$output = ob_get_clean();
		// If there was any output (errors), log it but don't include in response
		if(!empty($output) && $resp['status'] == 'success'){
			error_log("save_cab output captured: ".$output);
		}
		
		if(isset($resp['msg']) && $resp['status'] == 'success'){
			$this->settings->set_flashdata('success',$resp['msg']);
		}
		
		return json_encode($resp);
	}
	
	function delete_cab(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `driver_list` set `delete_flag` = 1  where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Driver successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	
	function save_booking(){
		if(empty($_POST['id'])){
			$prefix = date('Ym-');
			$code = sprintf("%'.05d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `booking_list` where ref_code = '{$prefix}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.05d",ceil($code) + 1);
				}else{
					break;
				}
			}
			$_POST['client_id'] = $this->settings->userdata('id');
			$_POST['ref_code'] = $prefix.$code;
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `booking_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `booking_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success'," Driver has been booked successfully.");
			else
				$this->settings->set_flashdata('success'," Booking successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	
	function delete_booking(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `booking_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Booking successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	
	function update_booking_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `booking_list` set `status` = '{$status}' where id = '{$id}' ");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Booking status successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_cab':
		// Set JSON header before any output
		header('Content-Type: application/json');
		// Suppress error display for AJAX requests
		$old_error_reporting = error_reporting(E_ALL);
		$old_display_errors = ini_get('display_errors');
		ini_set('display_errors', 0);
		echo $Master->save_cab();
		// Restore error settings
		error_reporting($old_error_reporting);
		ini_set('display_errors', $old_display_errors);
	break;
	case 'delete_cab':
		echo $Master->delete_cab();
	break;
	case 'save_booking':
		echo $Master->save_booking();
	break;
	case 'delete_booking':
		echo $Master->delete_booking();
	break;
	case 'update_booking_status':
		echo $Master->update_booking_status();
	break;
	default:
		// echo $sysset->index();
		break;
}
?>