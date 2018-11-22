<?php
	include 'inc/config.php';
    //include 'inc/globals.php';
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	$titulo 		= 'Fenix';
	$descripcion 	= 'Descripción..';
	$keywords 		= 'Keywords..';
	$fb_img 		= '[ruta-absoluta-imagen-para-compartir-1200x630]';
	$url     		= '';
?>    
    <!-- <base href="<?php echo $url?>" /> -->
	<title><?php echo($titulo); ?></title>
	<!-- Favicon-->  
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="icon" href="favicon.png">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
	<meta http-equiv="Content-Language" content="es">
    <meta name="description" content="<?php echo($descripcion); ?>">
	<meta name="keywords" content="<?php echo($keywords);?>">
    <!-- OpenGraph-->
	<meta property="og:title" content="<?php echo($titulo); ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo($url); ?>">
	<meta property="og:image" content="<?php echo($fb_img); ?>"/>
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:description" content="<?php echo($descripcion); ?>">
	<!-- Twitter Card-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="">
	<meta name="twitter:title" content="<?php echo($titulo); ?>">
	<meta name="twitter:description" content="<?php echo($descripcion); ?>">
	<meta name="twitter:image:src" content="<?php echo($fb_img); ?>">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<!-- Font Awesome css -->
    <link rel="stylesheet" href="fonts/fontawesome-free-5.2.0-web/css/brands.css">
    <link rel="stylesheet" href="fonts/fontawesome-free-5.2.0-web/css/fontawesome.css">
    <link rel="stylesheet" href="fonts/fontawesome-free-5.2.0-web/css/solid.css">
    <!-- Animate -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- OWL -->
	<link rel="stylesheet" href="css/owl.carousel.css">
	<!-- Google fonts - Open Sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,700" rel="stylesheet">
	<!-- Tweaks for older IEs -->
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<!-- Main Custom CSS stylesheet -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123747514-1"></script>
	<script>
	  /* Google tag manager */
	</script>
</head>
<body>

	<!-- jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>	
	<!-- [if lt IE 8]>
	    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif] -->
		
    <?php require_once "sections/tpl/header.php"; ?>

    <?php 
		if(file_exists("sections/".$section.".php")){
			require_once "sections/".$section.".php";
		}else{
			require_once "sections/404.php";
		}
	?>

    <?php require_once "sections/tpl/footer.php"; ?>

    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDMSqJvrVIY39f7QHIwrFaaiIxgRgR6Bso"></script>
	<script type="text/javascript" src="js/mapa.js"></script>
	<!-- scrollmagic -->
    <script type="text/javascript" src="js/lib/greensock/TweenMax.min.js"></script>
    <script src="js/scrollmagic/minified/ScrollMagic.min.js"></script>
    <script type="text/javascript" src="js/scrollmagic/uncompressed/plugins/animation.gsap.js"></script>
    <!-- <script type="text/javascript" src="js/scrollmagic/uncompressed/plugins/debug.addIndicators.js"></script> -->
    <script src="js/scrollreveal.min.js"></script>
    <script src="js/main.js"></script>


</body>
</html>

