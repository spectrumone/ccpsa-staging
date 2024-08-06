<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccpsa
 */

get_header();
?>

	<main id="primary" class="site-main home">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

			<div class="p-4 p-md-5 mb-4 text-white bg-dark banner" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>')">
			<div class="container">
				<div class="col-md-10 px-0">
					<h1 class="">Community Commission for Public Safety and Accountability</h1>
					<p class="lead my-3">Increasing public safety and strengthening police oversight and accountability</p>
					</div>
				
				</div>
			</div>

			

  <?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer(); ?>
