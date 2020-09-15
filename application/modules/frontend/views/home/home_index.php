<style>
    .vertical .carousel-inner {
        height: 100%;
    }

    .carousel.vertical .item {
        -webkit-transition: 0.6s ease-in-out top;
        -moz-transition: 0.6s ease-in-out top;
        -ms-transition: 0.6s ease-in-out top;
        -o-transition: 0.6s ease-in-out top;
        transition: 0.6s ease-in-out top;
    }

    .carousel.vertical .active {
        top: 0;
    }

    .carousel.vertical .next {
        top: 400px;
    }

    .carousel.vertical .prev {
        top: -400px;
    }

    .carousel.vertical .next.left,
    .carousel.vertical .prev.right {
        top: 0;
    }

    .carousel.vertical .active.left {
        top: -400px;
    }

    .carousel.vertical .active.right {
        top: 400px;
    }

    .carousel.vertical .item {
        left: 0;
    }
</style>
<div id="main-wrapper">
    <div id="main" style="margin-top: 4%;">
        <div id="main-inner">
            <div class="row">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach ($slider_utama as $key => $value) { ?>
                            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key ?>" <?php echo ($key == 0 ? 'class="active"' : '') ?>></li>
                        <?php } ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($slider_utama as $key => $value) { ?>
                            <div class="item  <?php echo $key == 0 ? 'active' : '' ?>">
                                <img class="center-block" src="<?php echo $records[$value]->rekdok_file ?>" alt="image slider">
                                <div class="carousel-caption">
                                    <h3><?php echo $records[$value]->rekdok_ringkasan ?></h3>
                                    <p><?php echo $records[$value]->rekdok_deskripsi ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" id="left" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" id="right" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="row" style="margin-top: 25px;">
                <div class="container-fluid parent">

                </div>


                <div class="container wrapper">
                    <div class="row">
                        <div class="col-12-xs child">
                            <div class="carousel slide vertical" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner hidden-xs" role="listbox">
                                    <?php for ($i = 0; $i < count($result[0]); $i++) { ?>
                                        <div class="item <?php echo ($i == 0 ? 'active' : '') ?>">
                                            <div class="row">
                                                <?php for ($j = 0; $j < count($result); $j++) { ?>
                                                    <div class="col-sm-3">
                                                        <a class="thumbnail" href="#">
                                                            <img src="<?php echo $result[$j][$i]->rekdok_file ?>" alt="<?php echo $result[$j][$i]->rekdok_ringkasan ?>" />
                                                            <div class="carousel-caption"><?php echo $result[$j][$i]->step_nama ?></div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#main-inner -->
    </div><!-- /#main -->
</div><!-- /#main-wrapper -->

<script>
    $(document).ready(function() {
        $('.vertical').carousel({
            interval: 3000
        });
    });
</script>