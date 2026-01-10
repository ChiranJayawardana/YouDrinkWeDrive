<?php
  require_once('sess_auth.php');
  
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <style>
        :root {
            --admin-primary: #9333ea;
            --admin-primary-light: #a855f7;
            --admin-primary-dark: #7e22ce;
            --admin-gradient: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        }
        /* Modern Admin Theme Overrides */
        .bg-gradient-purple {
            background: var(--admin-gradient) !important;
        }
        .card-purple {
            border-top-color: var(--admin-primary) !important;
        }
        .btn-primary {
            background: var(--admin-gradient) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3) !important;
            transition: all 0.3s ease !important;
        }
        .btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(147, 51, 234, 0.4) !important;
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }
        .form-control:focus, .custom-select:focus {
            border-color: var(--admin-primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25) !important;
        }
        .info-box {
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
            border: none !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
        }
        .info-box:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        .info-box-icon {
            border-radius: 12px 0 0 12px !important;
        }
        .card {
            border-radius: 15px !important;
            border: none !important;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
        }
        .card-header {
            background: var(--admin-gradient) !important;
            color: white !important;
            border-radius: 15px 15px 0 0 !important;
            border: none !important;
            padding: 1.25rem 1.5rem !important;
        }
        .card-title {
            color: white !important;
            font-weight: 600 !important;
            margin: 0 !important;
        }
        /* Modern Form Styling */
        .form-group label.control-label {
            font-weight: 600 !important;
            color: #4a5568 !important;
            margin-bottom: 0.5rem !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        .form-control, .custom-select {
            border-radius: 8px !important;
            border: 2px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
            transition: all 0.3s ease !important;
            font-size: 0.95rem !important;
        }
        .custom-select {
            padding-right: 2.5rem !important;
            padding-left: 1rem !important;
            line-height: 1.5 !important;
            color: #495057 !important;
            font-weight: 400 !important;
            min-height: calc(1.5em + 1.5rem + 4px) !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            width: 100% !important;
            display: block !important;
        }
        .custom-select::-webkit-input-placeholder {
            color: #6c757d !important;
        }
        .custom-select::-moz-placeholder {
            color: #6c757d !important;
        }
        .custom-select:-ms-input-placeholder {
            color: #6c757d !important;
        }
        .custom-select::-ms-expand {
            display: none !important;
        }
        .custom-select option {
            padding: 0.5rem 1rem !important;
            line-height: 1.5 !important;
            color: #495057 !important;
            background-color: #fff !important;
            font-size: 0.95rem !important;
        }
        .custom-select:not([multiple]):not([size]) {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") !important;
            background-position: right 0.75rem center !important;
            background-repeat: no-repeat !important;
            background-size: 8px 10px !important;
        }
        .custom-select:focus:not([multiple]):not([size]) {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%239333ea' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") !important;
        }
        .form-control:focus, .custom-select:focus {
            border-color: var(--admin-primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25) !important;
            outline: none !important;
        }
        .form-control.rounded-0 {
            border-radius: 8px !important;
        }
        .card-body {
            padding: 2rem !important;
        }
        .card-footer {
            background: #f8f9fa !important;
            border-top: 1px solid #e2e8f0 !important;
            border-radius: 0 0 15px 15px !important;
            padding: 1.25rem 1.5rem !important;
        }
        .btn-flat {
            border-radius: 8px !important;
            padding: 0.625rem 1.5rem !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            border: none !important;
        }
        .btn-flat:hover {
            transform: translateY(-2px) !important;
        }
        .custom-file-label {
            border-radius: 8px !important;
            border: 2px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
        }
        .custom-file-input:focus ~ .custom-file-label {
            border-color: var(--admin-primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25) !important;
        }
        textarea.form-control {
            min-height: 100px !important;
            resize: vertical !important;
        }
        .input-group .form-control {
            border-right: none !important;
        }
        .input-group-append .btn {
            border-left: none !important;
            border-color: #e2e8f0 !important;
            background: #f8f9fa !important;
        }
        .input-group-append .btn:hover {
            background: #e2e8f0 !important;
            color: var(--admin-primary) !important;
        }
        /* Modern Table Styling */
        .table {
            border-radius: 12px !important;
            overflow: hidden !important;
        }
        .table thead tr {
            background: var(--admin-gradient) !important;
            color: white !important;
        }
        .table thead th {
            border: none !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
            letter-spacing: 0.5px !important;
            padding: 1rem !important;
        }
        .table tbody tr {
            transition: all 0.2s ease !important;
        }
        .table tbody tr:hover {
            background: #f8f9fa !important;
            transform: scale(1.01) !important;
        }
        .table tbody td {
            padding: 1rem !important;
            vertical-align: middle !important;
            border-color: #e2e8f0 !important;
        }
        .table-bordered {
            border: none !important;
        }
        .table-bordered thead th {
            border-bottom: 2px solid rgba(255,255,255,0.3) !important;
        }
        .btn-sm {
            border-radius: 6px !important;
            padding: 0.375rem 0.875rem !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }
        .btn-sm:hover {
            transform: translateY(-2px) !important;
        }
        .card-tools .btn {
            margin-left: 0.5rem !important;
        }
        /* Badge Styling */
        .badge {
            padding: 0.5rem 0.75rem !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
        }
        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        }
        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }
        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        }
        .badge-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        }
        .badge-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
        }
        /* Inline Action Buttons Styling */
        .btn-group {
            display: inline-flex !important;
            gap: 0.25rem !important;
        }
        .btn-group .btn {
            margin: 0 !important;
            padding: 0.375rem 0.75rem !important;
            font-size: 0.875rem !important;
            white-space: nowrap !important;
        }
        .btn-group .btn i {
            margin-right: 0.25rem;
        }
        .btn-group .btn-sm {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.8rem !important;
        }
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column !important;
                width: 100% !important;
            }
            .btn-group .btn {
                width: 100% !important;
                margin-bottom: 0.25rem !important;
            }
        }
    </style>
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style type="text/css">/* Chart.js */
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>

     <!-- jQuery -->
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>

  </head>