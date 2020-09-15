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
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img class="center-block" src="<?php echo base_url('assets\frontend\global\img\galeri\1.png') ?>" alt="image slider">
                            <div class="carousel-caption">
                                <h3>First Slide</h3>
                                <p>Deskrisi slide pertama</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="center-block" src="<?php echo base_url('assets\frontend\global\img\galeri\2.png') ?>" alt="image slider">
                            <div class="carousel-caption">
                                <h3>Second Slide</h3>
                                <p>Deskrisi slide kedua</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="center-block" src="<?php echo base_url('assets\frontend\global\img\galeri\3.png') ?>" alt="image slider">
                            <div class="carousel-caption">
                                <h3>Third Slide</h3>
                                <p>Deskrisi slide ketiga</p>
                            </div>
                        </div>
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
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <a class="thumbnail" href="#">
                                                    <img src="http://lorempixel.com/500/500" alt="" />
                                                    <div class="carousel-caption">Lorem ipsum dolor.</div>
                                                </a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a class="thumbnail" href="#">
                                                    <img src="http://lorempixel.com/500/500" alt="" />
                                                    <div class="carousel-caption">Lorem ipsum dolor.</div>
                                                </a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a class="thumbnail" href="#">
                                                    <img src="http://lorempixel.com/500/500" alt="" />
                                                    <div class="carousel-caption">Lorem ipsum dolor.</div>
                                                </a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a class="thumbnail" href="#">
                                                    <img src="http://lorempixel.com/500/500" alt="" />
                                                    <div class="carousel-caption">Lorem ipsum dolor.</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <a class="thumbnail" href="#">
                                                    <img src="http://lorempixel.com/500/500" alt="" />
                                                    <div class="carousel-caption">Lorem ipsum dolor.</div>
                                                </a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a class="thumbnail" href="#">
                                                    <img src="http://lorempixel.com/500/500" alt="" />
                                                    <div class="carousel-caption">Lorem ipsum dolor.</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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