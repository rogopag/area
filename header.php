<?php
////INTENDED FOR DEBUG OPERATIONS ONLY //////
////////////////////////////////////
include 'browser.php';
$mapLoaded = isset($mapLoaded)?$mapLoaded:"";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link type="image/x-icon" href="<?php bloginfo('url') ?>>/wp-content/themes/area/favicon.ico" rel="shortcut icon" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>       
<?php
if ($SF)
{
	?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/safari.css" type="text/css" media="screen" />
<?php
} elseif($IE){
	if($IEV <= 6){
		?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie6style.css" type="text/css" media="screen" />	
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/styleSl.css" type="text/css" media="screen" />	
		<!--DEBUGGER-->
		<!--<script type='text/javascript' 
		src='http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js'></script>-->
		<!--DEBUGGER END--> 
			<?php
	} elseif($IEV == 7) {
		?> 
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/iestyle.css" type="text/css" media="screen" />
	<?php
} elseif($IEV == 9) {
	?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
<?php
} else {?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie8style.css" type="text/css" media="screen" />
<?php	}
} else {
	?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php
}
?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/pngfix.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/utils.js"></script>
<!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/slideshow.js"></script>

<?php
if( is_front_page() )
{
	echo "<script type=\"text/javascript\" src=\"". get_bloginfo('stylesheet_directory') ."/js/jquery.expander.js\"></script>\n";
}
?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script>
<?php if ($mapLoaded == true) {?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAzxX5Mn7-b3jCNPCVAGep6hS3N25njJgxlCrYmbid7_Wn44kqTxRXjNXNGEH7VKq3kBIYxpZyymlFxg" type="text/javascript"></script>	
<?php } ?>
<?php
if (is_page_template('geo.php')){?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAzxX5Mn7-b3jCNPCVAGep6hS3N25njJgxlCrYmbid7_Wn44kqTxRXjNXNGEH7VKq3kBIYxpZyymlFxg" type="text/javascript"></script>	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/gmapsedit.js"></script>
<?php }
if ((is_category('43')) || (is_category('42')) || (is_category('47')) || (is_category('50')) || (is_category('44')) || is_page_template('annunci.php')){?>
<script type="text/javascript" >
logoDown = true;
</script>
<?php
} if (in_category('34') || in_category('35')){?>
<script type="text/javascript">
var annunciSingle = true;
</script>
<?php 
}
wp_head(); ?>
</head>
<body>
<a name="topOfThePage"></a>
<?php 
//echo TEMPLATEPATH;
//echo DB_NAME;
?>
<div id="page">

<div id="header">
	<a href="<?php bloginfo('url');?>"><img class="logo" src="<?php bloginfo('stylesheet_directory'); ?>/imgs/logo.gif"  alt="dito" /></a>
<div id="empty">&nbsp;</div>
<!-- MENU-->
<div id="menu">

<div class="community">
<div class="menuItemLeft">
<div class="com"><a href="<?php bloginfo('url');?>/?page_id=<?php echo  dito_mediateca_page_link();?>">Mediateca</a></div>
<div class="com"><a href="<?php bloginfo('url');?>/?page_id=958">Interviste e dintorni</a></div>
<div class="comLast"><a href="<?php bloginfo('url');?>/?page_id=88">Come ho fatto a...</a></div>
</div>
</div>

<div class="percorsi">
<div class="menuItemLeft">
<div class="per"><a href="<?php bloginfo('url');?>/category/carte-in-regola">Carte in regola</a></div>
<div class="per"><a href="<?php bloginfo('url');?>/category/servizi">Sanit&agrave; e servizi</a></div>
<div class="perLast"><a href="<?php bloginfo('url');?>/category/benefici-e-permessi">Benefici e permessi</a></div>
</div>
<div class="menuItemRight">
<div class="per"><a href="<?php bloginfo('url');?>/category/trasporti">Trasporti</a></div>
<div class="per"><a href="<?php bloginfo('url');?>/category/scuola">Scuola</a></div>
<div class="perLast"><a href="<?php bloginfo('url');?>/category/sport-e-tempo-libero">Sport e tempo libero</a></div>
</div>
</div>



<div class="strumenti">
<div class="menuItemLeft">
<div class="strum"><a href="<?php bloginfo('url')?>/map.php">Trova servizio</a></div>
<div class="strum"><a href="<?php bloginfo('url');?>/?page_id=71">Sogni, segni, disegni</a></div>
<div class="strumLast"><a href="<?php bloginfo('url');?>/?page_id=124">Link utili</a></div>
</div>
<div class="menuItemRight">
<div class="strum"><a href="<?php bloginfo('url');?>/?page_id=86">Eventi</a></div>
<div class="strum"><a href="<?php bloginfo('url');?>/?page_id=957">Multimedia</a></div>
<div class="strumLast"><a href="<?php bloginfo('url');?>/?page_id=82">News</a></div>
</div>
</div>
</div><!-- MENU END-->
<?php include_once (TEMPLATEPATH . "/searchform.php"); ?>





</div>