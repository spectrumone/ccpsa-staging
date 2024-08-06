<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ccpsa
 */

get_header();
?>

	<main id="primary" class="site-main">

		<header class="entry-header">
			<div class="hero-banner bg-dark" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>')">
				<div class="container">
					<div class="title">
						<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ccpsa' ); ?></h1>
					</div>
					<div class="breadcrumbs">
						<?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); } ?>
					</div>
				</div>
			</div>
		</header><!-- .entry-header -->

		<section class="error-404 not-found">
	
			<div class="page-content mb-4">
			 	<div class="container">
					<div class="row">
						<h1 class="text-center">404 page</h1>
						<p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'ccpsa' ); ?></p>

						<div class="text-center">
						<?php
						get_search_form(); ?>
						</div>

					</div>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
