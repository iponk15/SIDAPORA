<div id="header-wrapper">
    <div id="header">
        <div id="header-inner">
            <div class="header-bar">
                <div class="container">
                    <ul class="header-bar-nav nav nav-register">
                        <li><a href="<?php echo base_url('login') ?>">Login</a></li>
                    </ul>
                </div><!-- /.container -->
            </div>
            <div class="header-top">
                <div class="container">
                    <div class="header-identity">
                        <a href="<?php echo base_url() ?>" class="header-identity-target">
                            <span class="header-icon"><i class="fa fa-home"></i></span>
                            <span class="header-title">SIDAPORA</span><!-- /.header-title -->
                            <span class="header-slogan"><?php echo $pagetitle ?></span>
                        </a><!-- /.header-identity-target-->
                    </div><!-- /.header-identity -->

                    <div class="header-actions pull-right">
                        <?php
                        $active = 'style="color: #39b54a"';
                        $curr_url = current_url() == base_url('home') ? base_url('home') : current_url();
                        ?>
                        <a href="<?php echo base_url() ?>" class="btn btn-regular" <?php echo ($curr_url == base_url() ? $active : '') ?>>Beranda</a>
                        <a href="<?php echo base_url('pusatdata') ?>" class="btn btn-regular" <?php echo ($curr_url == base_url('pusatdata') ? $active : '') ?>>Pusat Data</a>
                    </div>

                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".header-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div><!-- /.container -->
            </div><!-- .header-top -->
        </div><!-- /.header-inner -->
    </div><!-- /#header -->
</div><!-- /#header-wrapper -->