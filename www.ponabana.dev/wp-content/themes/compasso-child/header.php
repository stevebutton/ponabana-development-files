<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if (g7_option('top_bar')) : ?>
	<nav id="top">
		<div class="container clearfix">
			<div class="sixteen columns">
             <a href="https://www.facebook.com/pages/Unicef-RDC/149925238389509" target="_blank"><img src="/gfx/facebook-icon.png" width="32" height="32" /></a>

<a href="http://www.youtube.com/user/unicefrdc2012" target="_blank"><img src="/gfx/youtube-icon.png" width="32" height="32" /></a>
<a href="https://twitter.com/UNICEFDRC" target="_blank"><img src="/gfx/twitter-icon.png" width="32" height="32" /></a>
				<?php g7_menu('topmenu'); ?>
				<?php if (g7_option('header_text')) : ?>
                
			  <div id="intro">
					<?php echo do_shortcode(g7_option('header_text')); ?>
				</div>
				<?php endif; ?>
            
		  </div>
		</div>
	</nav>
	<?php endif; ?>

	<header>
		<div class="container">
			<div class="six columns">
			  <div id="logo">
                

					<?php if (g7_option('logo') == '1') : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<img src="<?php echo g7_option('logo_image'); ?>" alt="<?php bloginfo('name'); ?>">
						</a>
					<?php else : ?>
						<h1>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<?php bloginfo('name'); ?>
							</a>
						</h1>
						<h2 id="site-description"><?php bloginfo('description'); ?></h2>
					<?php endif; ?>
				</div>
			</div>
			<div class="ten columns">
				<?php if (g7_option('banner') && g7_option('banner_image')) : ?>
				<div id="top-banner">
                <?php if(ICL_LANGUAGE_CODE=='fr'): ?>
<img src="/gfx/banner_right.png">
<?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
<img src="/gfx/banner_righteng.png">
<?php endif;?>

					<?php /*?><a href="<?php echo g7_option('banner_link'); ?>">
						<img src="<?php echo g7_option('banner_image'); ?>" alt="banner"><?php */?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<div id="wrapper">
		<div class="container">
			<nav id="mainnav" class="sixteen columns clearfix mb30">
				<?php g7_menu('mainmenu'); ?>
				<form method="get" id="searchf" action="<?php echo esc_url(home_url('/')); ?>">
					<input type="image" src="<?php echo PARENT_URL; ?>/images/search-16a.png" alt="Go" id="searchbtn">
					<input type="text" name="s" id="cari" placeholder="<?php _e('Search...', 'g7theme'); ?>">
				</form>
			</nav>
 <div id="callout">
 <?php if(ICL_LANGUAGE_CODE=='fr'): ?>
 <a href="http://ponabana.com/category/crc/" target="_self"><img src="/gfx/crcfr.png" alt=""></a>
<?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
<a href="http://ponabana.com/category/crc-en/?lang=en" target="_self"><img src="/gfx/crcen.png" alt=""></a>
<?php endif;?>
<div id="countdown"><?php echo do_shortcode('[tminus t="20-11-2014 12:12:12"]'); ?></div></div><div id="unieleze">
 <div id="unieleze"><?php if(ICL_LANGUAGE_CODE=='fr'): ?>
   <a href="http://unieleze.cd/" target="new"><img src="/gfx/unilezegrabfr.png"></a>
<?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
<a href="http://unieleze.cd/" target="new"><img src="/gfx/unilezegraben.png" alt=""></a>
<?php endif;?></div>
 
			<?php if (is_front_page() && g7_option('slider')) : ?>
				<?php get_template_part('slider'); ?>
			<?php endif; ?>