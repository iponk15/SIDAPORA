<div class="app-sidebar sidebar-shadow">
	<div class="app-header__logo">
		<div class="logo-src"></div>
		<div class="header__pane ml-auto">
			<div>
				<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<div class="app-header__mobile-menu">
		<div>
			<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
		</div>
	</div>
	<div class="app-header__menu">
		<span>
			<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
				<span class="btn-icon-wrapper">
					<i class="fa fa-ellipsis-v fa-w-6"></i>
				</span>
			</button>
		</span>
	</div>    <div class="scrollbar-sidebar">
		<div class="app-sidebar__inner">
			<ul class="vertical-nav-menu">
				<li class="app-sidebar__heading"><h6><b>Dashboards</b></h4></li>
				<li>
					<a href="<?php echo base_url('landing'); ?>" class="<?php echo (getCtrl() == 'landing' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-home"></i> Landing
					</a>
				</li>
				<li class="app-sidebar__heading"><h6><b>Master Data</b></h4></li>
				<li>
					<a href="<?php echo base_url('user'); ?>" class="<?php echo (getCtrl() == 'user' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-user"></i> User
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('kategori'); ?>" class="<?php echo (getCtrl() == 'kategori' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-menu"></i> Kategori
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('bantuan'); ?>" class="<?php echo (getCtrl() == 'bantuan' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-box2"></i> Bantuan
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('jenis_bantuan'); ?>" class="<?php echo (getCtrl() == 'jenis_bantuan' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-plugin"></i> Jenis Bantuan
					</a>
				</li>
				<li class="app-sidebar__heading"><h6><b>Wilayah Administratif</b></h4></li>
				<li>
					<a href="<?php echo base_url('provinsi'); ?>" class="<?php echo (getCtrl() == 'provinsi' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-map-marker"></i> Provinsi
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('kabkot'); ?>" class="<?php echo (getCtrl() == 'kabkot' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-map-marker"></i> Kabupaten / Kota
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('kecamatan'); ?>" class="<?php echo (getCtrl() == 'kecamatan' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-map-marker"></i> Kecamatan
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('keldes'); ?>" class="<?php echo (getCtrl() == 'keldes' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-map-marker"></i> Kelurahan / Desa
					</a>
				</li>
				<li class="app-sidebar__heading"><h6><b>Data Rekapitulasi</b></h4></li>
				<li>
					<a href="<?php echo base_url('rekap'); ?>" class="<?php echo (getCtrl() == 'rekap' ? 'mm-active' : ''); ?>">
						<i class="metismenu-icon pe-7s-news-paper"></i> Rekap
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>  