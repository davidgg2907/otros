<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright © 2015 Himanshu Softtech.
********************************************************************************************************** -->

<!--
Template Name: Learning System HTML Template
Version: 1.0.0
Author: Kamleshyadav
Website: http://himanshusofttech.com/
Purchase: http://themeforest.net/user/kamleshyadav
-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- Header Start -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="description"  content="Learning System HTML Template"/>
<meta name="keywords" content="">
<meta name="author"  content="Kamleshyadav"/>
<meta name="MobileOptimized" content="320">
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
<link rel="icon" type="image/ico" href="favicon.ico" />
<!-- main css -->
<link rel="stylesheet" href="css/main.css" media="screen"/>
<title>{{ \App\admin\Empresa::getConfig()->nombre }}</title>
</head>
<!-- Header End -->

<!-- Body Start -->
<body>
<!--Pre loader start-->
<div id="preloader">
  <div id="status">
  	<p>Cargando</p>
  </div>
</div>
<!--pre loader end-->
<!--slider start-->
<div class="lms_comming_soon_wrapper">
  <img src="images/slider/slider2.jpg"   alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
  <div class="lms_slider_overlay">
  	<div class="lms_comming_soon">
    	<img src="images/logo.png" alt="logo" />
    	<h1>Coming Soon</h1>
        <p>We are creating awesomeness, please hold back and do visit us again.</p>
        <div class="lms_social5">
         	<ul>
            <?php if(\App\admin\Empresa::getConfig()->facebook ) { ?>
              <li><a href="{{ \App\admin\Empresa::getConfig()->facebook }}" title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <?php } ?>

            <?php if(\App\admin\Empresa::getConfig()->twitter ) { ?>
              <li><a href="{{ \App\admin\Empresa::getConfig()->twitter }}" title="Twitter"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>

            <?php if(\App\admin\Empresa::getConfig()->instagram ) { ?>
              <li><a href="{{ \App\admin\Empresa::getConfig()->instagram }}" title="Instagram"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>

            <?php if(\App\admin\Empresa::getConfig()->youtube ) { ?>
              <li><a href="{{ \App\admin\Empresa::getConfig()->instagram }}" title="Youtube"><i class="fa fa-youtube"></i></a></li>
            <?php } ?>
          </ul>
    </div>
    </div>
  </div>
</div>
<!--slider end-->
<!--main js file start-->
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<!--plugin-->
<script type="text/javascript" src="js/plugin/appear/jquery.appear.js"></script>
<script type="text/javascript" src="js/plugin/count/jquery.countTo.js"></script>
<script type="text/javascript" src="js/plugin/mediaelement/mediaelement-and-player.js"></script>
<script type="text/javascript" src="js/plugin/mixitup/jquery.mixitup.js"></script>
<script type="text/javascript" src="js/plugin/modernizr/modernizr.custom.js"></script>
<script type="text/javascript" src="js/plugin/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="js/plugin/parallax/jquery.stellar.js"></script>
<script type="text/javascript" src="js/plugin/prettyphoto/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/plugin/revslider/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="js/plugin/revslider/js/jquery.themepunch.revolution.js"></script>
<script type="text/javascript" src="js/plugin/single/single.js"></script>

<script type="text/javascript" src="js/plugin/wow/wow.js"></script>
<script type="text/javascript" src="js/grid-gallery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--main js file end-->
</body>
<!-- Body End -->
</html>
