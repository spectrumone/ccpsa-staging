<?php
/**
 * Template part for displaying page content in single-press-release.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccpsa
 */

?>

<?php get_template_part('subheader'); ?>

<div class="container">
	<div class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-8'); ?>>

		<div class="entry-content">
			
					<h2><?php the_title(); ?></h2>

					<div class="divider pt-2 pb-4">
						<span class="divider-separator"></span>
					</div>

					<p class="text-uppercase fw-bold mb-0">Date:</p>
					<p class=""><?php echo esc_html ( get_field( 'release_date' ) ); ?></p>


					<p><?php the_content(); ?></p>
				
		</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

		<?php get_template_part('sidebar-press-release'); ?>


