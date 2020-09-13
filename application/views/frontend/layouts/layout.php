<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/libraries/font-awesome/css/font-awesome.css'); ?>" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/libraries/jquery-bxslider/jquery.bxslider.css'); ?>" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/libraries/flexslider/flexslider.css'); ?>" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/realocation.css'); ?>" media="screen, projection" id="css-main">

    <link href="http://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/libraries/isotope/jquery.isotope.min.js'); ?>"></script>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC7CSCe8aaJrXWkX7SZNKSiB94SEMWC6Sk"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/gmap3.infobox.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/gmap3.clusterer.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/map.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/frontend/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/libraries/jquery-bxslider/jquery.bxslider.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/libraries/flexslider/jquery.flexslider.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/jquery.chained.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/realocation.js'); ?>"></script>

    <title>
        Realocation | Modern Real Estate Template
    </title>
</head>

<body>

    <div class="palette-wrapper palette-closed">
        <div class="palette-inner">
            <div class="palette-toggle">
                <div class="palette-toggle-inner">
                    <span><i class="fa fa-cog"></i>Options</span>
                </div>
            </div><!-- /.palette-toggle -->

            <h2 class="palette-title">Color Variant</h2>

            <ul class="palette-colors clearfix">
                <li class="palette-color-red"><a href="assets/css/variants/red.css"></a></li>
                <li class="palette-color-pink"><a href="assets/css/variants/pink.css"></a></li>
                <li class="palette-color-blue"><a href="assets/css/variants/blue.css"></a></li>
                <li class="palette-color-green"><a href="assets/css/variants/green.css"></a></li>
                <li class="palette-color-cyan"><a href="assets/css/variants/cyan.css"></a></li>
                <li class="palette-color-purple"><a href="assets/css/variants/purple.css"></a></li>
                <li class="palette-color-orange"><a href="assets/css/variants/orange.css"></a></li>
                <li class="palette-color-brown"><a href="assets/css/variants/brown.css"></a></li>
            </ul>

            <h2 class="palette-title">Layout</h2>

            <select class="palette-layout">
                <option value="layout-wide" selected="selected">Wide</option>
                <option value="layout-boxed">Boxed</option>
            </select>


            <h2 class="palette-title">Patterns</h2>

            <ul class="palette-patterns clearfix">
                <li><a class="pattern-cloth-alike">cloth-alike</a></li>
                <li><a class="pattern-corrugation">corrugation</a></li>
                <li><a class="pattern-diagonal-noise">diagonal-noise</a></li>
                <li><a class="pattern-dust">dust</a></li>
                <li><a class="pattern-fabric-plaid">fabric-plaid</a></li>
                <li><a class="pattern-farmer">farmer</a></li>
                <li><a class="pattern-grid-noise">grid-noise</a></li>
                <li><a class="pattern-lghtmesh">lghtmesh</a></li>
                <li><a class="pattern-pw-maze-white">pw-maze-white</a></li>
                <li><a class="pattern-none">none</a></li>

                <li><a class="pattern-cloth-alike-dark">cloth-alike</a></li>
                <li><a class="pattern-corrugation-dark">corrugation</a></li>
                <li><a class="pattern-diagonal-noise-dark">diagonal-noise</a></li>
                <li><a class="pattern-dust-dark">dust</a></li>
                <li><a class="pattern-fabric-plaid-dark">fabric-plaid</a></li>
                <li><a class="pattern-farmer-dark">farmer</a></li>
                <li><a class="pattern-grid-noise-dark">grid-noise</a></li>
                <li><a class="pattern-lghtmesh-dark">lghtmesh</a></li>
                <li><a class="pattern-pw-maze-white-dark">pw-maze-white</a></li>
                <li><a class="pattern-none-dark">none</a></li>
            </ul>


            <h2 class="palette-title">Header Variant</h2>

            <select class="palette-header">
                <option value="header-dark" selected="selected">Dark</option>
                <option value="header-light">Light</option>
            </select>

            <h2 class="palette-title">Map Filter</h2>

            <select class="palette-map-navigation">
                <option value="map-navigation-dark" selected="selected">Dark</option>
                <option value="map-navigation-light">Light</option>
            </select>

            <h2 class="palette-title">Footer Variant</h2>

            <select class="palette-footer">
                <option value="footer-dark" selected="selected">Dark</option>
                <option value="footer-light">Light</option>
            </select>
        </div><!-- /.palette-inner -->
    </div><!-- /.palette-wrapper -->

    <div id="wrapper">
        <?php echo $_header; ?>
        <?php echo $_content; ?>
        <?php echo $_footer; ?>
    </div><!-- /#wrapper -->


</body>

</html>