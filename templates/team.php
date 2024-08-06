<?php /* Template Name: Team Template */

get_header();
?>

<main id="primary" class="site-main team-page">

	<?php
	while (have_posts()):
		the_post(); ?>

		<?php get_template_part('subheader'); ?>

		<div class="container">
			<div class="row">

				<?php
				$args = array(
					'post_type' => 'team', 
					'posts_per_page' => -1 
				);
				$team_query = new WP_Query($args);

				if ($team_query->have_posts()):
					while ($team_query->have_posts()):
						$team_query->the_post(); ?>
						<div class="col-md-3">
							<div class="team-column">
								<a href="<?php echo get_permalink(); ?>">
									<?php
									if (has_post_thumbnail()) {
										$thumbnail_id = get_post_thumbnail_id();
										$alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
										echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="' . esc_attr($alt_text) . '">';
									} else {
										$placeholder_url = '/wp-content/uploads/2024/07/headshot-team.jpg';
										echo '<img src="' . esc_url($placeholder_url) . '" alt="Placeholder Image">';
									}
									?>

									<p class=""><?php the_title(); ?></p>

									<p class="position"><?php the_field('position'); ?></p> <!-- Display position field -->
								</a>
							</div>
						</div>
					<?php endwhile;
					wp_reset_postdata();
				else: ?>
					<p>No team members found.</p>
				<?php endif; ?>

			</div>
		</div>

		<!-- Call to action -->

		<section class="my-lg-14 mb-8">
			<!-- container -->
			<div class="" style="background-color: var(--secondary-color);">
				<!-- row -->
				<div class="row align-items-center">
					<!-- col -->
					<div class="col-lg-6 col-12 d-none d-lg-block">
						<div class="d-flex justify-content-center ">
							<!-- img -->
							<div class="position-relative">
								<img src="http://44.212.37.12/wp-content/uploads/2024/07/corporate-fund.png" alt="" class="img-fluid mt-n13">								
							</div>
						</div>
					</div>
					<div class="col-lg-5 col-12">
						<div class="text-white p-5 p-xl-0">
							<!-- text -->
							<h2 class="text-white">Corporate Fund</h2>
							<p class="mb-0"></p>
							<a href="#" class="btn btn-white mt-4">View PDF <i class="fa fa-file-pdf-o"
									aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

	<?php endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
?>