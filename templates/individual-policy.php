<?php

/**
 * The template for displaying all single individual policy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ccpsa
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'individual-policy' );

		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_footer();


