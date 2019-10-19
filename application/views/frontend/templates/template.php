<!DOCTYPE html>
<html lang="en">

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>SIDAPORA</title>

  <link rel="shortcut icon" href="<?php echo base_url('assets/frontend/global/img/favicon.ico') ?>">

  <!-- Fonts START -->
  <link href="<?php echo base_url('assets/frontend/pages/css/fontGlobal.css') ?>" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="<?php echo base_url('assets/frontend/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/global/plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="<?php echo base_url('assets/frontend/global/plugins/fancybox/source/jquery.fancybox.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/global/plugins/select2/select2.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/global/plugins/bootstrap-datepicker/css/datepicker3.css'); ?>" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="<?php echo base_url('assets/frontend/global/css/components.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/global/css/plugins.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/layout/css/style.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/pages/css/style-revolution-slider.css'); ?>" rel="stylesheet"><!-- metronic revo slider styles -->
  <link href="<?php echo base_url('assets/frontend/layout/css/style-responsive.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/layout/css/themes/red.css'); ?>" rel="stylesheet" id="style-color">
  <link href="<?php echo base_url('assets/frontend/layout/css/custom.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/frontend/pages/css/portfolio.css'); ?>" rel="stylesheet">
  <!-- Theme styles END -->


  <script src="<?php echo base_url('assets/frontend/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>  
  <!-- END CORE PLUGINS -->

  <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
  <script src="<?php echo base_url('assets/frontend/global/plugins/fancybox/source/jquery.fancybox.pack.js'); ?>" type="text/javascript"></script><!-- pop up -->
  <script src="<?php echo base_url('assets/frontend/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js'); ?>" type="text/javascript"></script><!-- slider for products -->
  <script src="<?php echo base_url('assets/frontend/global/plugins/jquery-mixitup/jquery.mixitup.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/plugins/select2/select2.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>

  <!-- BEGIN RevolutionSlider -->  
  <script src="<?php echo base_url('assets/frontend/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>" type="text/javascript"></script> 
  <script src="<?php echo base_url('assets/frontend/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js'); ?>" type="text/javascript"></script> 
  <script src="<?php echo base_url('assets/frontend/pages/js/revo-slider-init.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/pages/js/portfolio.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/js/metronic.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/js/global.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/frontend/global/js/revo-ini.js'); ?>" type="text/javascript"></script>
  <!-- END RevolutionSlider -->
  
  <script src="<?php echo base_url('assets/frontend/layout/js/back-to-top.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/layout/js/layout.js" type="text/javascript"></script>

  <script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();    
        Layout.initOWL();
        RevosliderInit.initRevoSlider();
        Layout.initTwitter();
        Layout.initFixHeaderWithPreHeader();
        Layout.initNavScrolling();
        Portfolio.init();
    });

    var base_url = '<?php echo base_url() ?>';
    
  </script>
  <!-- END PAGE LEVEL JAVASCRIPTS -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    <!-- Start Header -->
    <?php echo $_header; ?> <br>
    <!-- End Header -->
    <!-- Start Slider -->
    <?php echo ( @$is_404 == 1 || @$slider == 0 ? '' : $_slider ); ?>
    <!-- End Slider -->

    <div class="main">
      <div class="container">
        <?php echo $_breadcrumb; ?>
        <?php echo $_content; ?>
      </div>
    </div>

    <?php echo $_footer; ?>
</body>
<!-- END BODY -->
</html>