<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ccpsa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ccpsa' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="blue-header">
			<div class="container">
				<div class="row align-items-start">
					<div class="col">
						<div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i><?php the_field('address', 'option'); ?></div>
									
					</div>
					<div class="col">
						<div class="phone-number"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo esc_attr( get_field('phone_number', 'option') ); ?>"><?php the_field('phone_number', 'option'); ?></a></div>
					</div>
					<div class="col">
						<i class="fa fa-facebook" aria-hidden="true"></i>
						<i class="fa fa-instagram" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			
		</div>

		<nav class="navbar navbar-expand-xl navbar-light">
			<div class="container">
				<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu-1" aria-controls="menu-1" aria-expanded="false" aria-label="Toggle navigation">

					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="menu-1">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-1',
						'container' => false,
						'menu_class' => '',
						'fallback_cb' => 'bootstrap_5_wp_nav_menu_walker::fallback',
						'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
						'depth' => 4,
						'walker' => new bootstrap_5_wp_nav_menu_walker()
					));
					?>
       			</div>
   			</div>
		</nav>


	</header><!-- #masthead -->
