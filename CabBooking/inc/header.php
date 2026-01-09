<?php
  // require_once('sess_auth.php');
  
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <meta name="description" content="Professional cab booking system - Book rides, manage bookings, and track drivers in real-time.">
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    
    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
    
    <!-- Bootstrap & Plugins -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    
    <!-- Theme Styles -->
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/styles.css">
    
    <!-- Modern Design System (NEW) -->
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/modern-design.css">
    
    <style type="text/css">
    /* Chart.js animations */
    @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    
    /* Modern Header Styles */
    html,
    body {
        height: 100%;
        width: 100%;
    }
    
    #main-header {
        position: relative;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: #1e3a8a;
        padding-top: 6rem;
        padding-bottom: 3rem;
    }
    
    /* Background Image Layer - Full Visibility */
    #main-header:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url(<?php echo base_url.$_settings->info('cover') ?>);
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        z-index: 0;
    }
    
    /* Light purple overlay - 25% for theme consistency */
    #main-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(147, 51, 234, 0.25) 0%, rgba(168, 85, 247, 0.25) 100%);
        z-index: 1;
    }
    
    #main-header .container {
        position: relative;
        z-index: 2;
    }
    
    /* Clean text with enhanced shadow for purple overlay */
    .hero-modern-title {
        color: #ffffff !important;
        text-shadow: 
            0 2px 8px rgba(0, 0, 0, 0.4),
            0 4px 16px rgba(0, 0, 0, 0.3);
        font-weight: 800 !important;
        letter-spacing: -0.02em;
        background: none;
        padding: 0;
        border-radius: 0;
        display: block;
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
    }
    
    .hero-modern-subtitle {
        color: #ffffff !important;
        text-shadow: 
            0 2px 8px rgba(0, 0, 0, 0.4),
            0 4px 16px rgba(0, 0, 0, 0.3);
        font-weight: 500 !important;
        max-width: 750px;
        margin: 0 auto;
        background: none;
        padding: 0;
        border-radius: 0;
        display: block;
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
    }
    
    /* Hero badge - clean style */
    .hero-badge {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        color: #1e3a8a;
        border: none;
    }
    
    .hero-badge span {
        color: #1e3a8a !important;
    }
    
    .hero-badge i {
        color: #fbbf24 !important;
    }
    
    /* Trust indicators - clean cards */
    .hero-trust-indicators > div {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .hero-trust-indicators > div > div:first-child {
        color: #1e3a8a !important;
        text-shadow: none;
    }
    
    .hero-trust-indicators > div > div:last-child {
        color: #6b7280 !important;
        text-shadow: none;
    }
    
    @media (max-width: 768px) {
        #main-header {
            min-height: 65vh;
            padding-top: 5rem;
            padding-bottom: 2rem;
        }
        
        .hero-modern-title {
            font-size: 2.25rem !important;
        }
        
        .hero-modern-subtitle {
            font-size: 1.125rem !important;
        }
    }
    
    @media (max-width: 576px) {
        #main-header {
            min-height: 60vh;
            padding-top: 4.5rem;
        }
        
        .hero-modern-title {
            font-size: 1.875rem !important;
        }
    }
    </style>

    <!-- jQuery -->
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    
    <script src="<?php echo base_url ?>dist/js/script.js"></script>
    <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
    <!-- Modern Interactions (NEW) -->
    <script src="<?php echo base_url ?>assets/js/modern-interactions.js"></script>
</head>