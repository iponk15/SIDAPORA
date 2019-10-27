<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>

    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
	<script type="text/javascript" src="<?php echo base_url('assets/backend/plugins/datatable/DataTables/media/js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/backend/plugins/datatable/DataTables/media/js/jquery.dataTables.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/backend/plugins/datepicker/js/bootstrap-datepicker.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/backend/plugins/swal/swal.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/backend/plugins/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>


    <link href="<?php echo base_url('assets/backend/css//main.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/plugins/datatable/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/plugins/datatable/DataTables/media/css/jquery.dataTables.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/plugins/datatable/DataTables/media/css/dataTables.bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/plugins/datepicker/css/bootstrap-datepicker.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/plugins/sweetalert2/dist/sweetalert2.min.css'); ?>">
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php echo $_header; ?>        
		<div class="ui-theme-settings">
            <?php echo $_theme; ?>
        </div>        
		<div class="app-main">
			<?php echo $_sidebar; ?>  
			<div class="app-main__outer">
				<div class="app-main__inner">
					<?php echo $_page_header; ?>          
					<?php echo $_content; ?>
				</div>
				<?php echo $_footer; ?> 
			</div>
			<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
	<script type="text/javascript" src="<?php echo base_url('assets/backend/js/main.js'); ?>"></script>
</body>
</html>
