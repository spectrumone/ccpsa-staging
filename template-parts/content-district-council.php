<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccpsa
 */

?>

<?php get_template_part('subheader'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<!-- Member Block -->
		<div class="member-container">
			<div class="member-title">
				<h3>Members</h3>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
					laborum</p>
			</div>

			<div class="container">
				<div class="row">

					<?php $member = get_field('member');
					if ($member): ?>
						<?php foreach ($member as $post):
							setup_postdata($post); ?>
							<div class="col-md-4">
								<div class="member-column">
									<?php echo '<img src="' . (has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url()) : 'default-image-url.jpg') . '" alt="Featured Image">'; ?>

									<h5 class=""><?php the_title(); ?></h5>

									<p class="position"><?php the_field('position'); ?></p>

									<a class="email"
										href="<?php echo esc_url('mailto:' . antispambot(get_field('email_address'))); ?>">Email
										Me</a>

									<?php
									$biography = get_the_content();
									if (strlen($biography) > 200) {
										$truncated_content = substr($biography, 0, 200);
										echo '<p class="biography">' . $truncated_content . '... <a class="read-more" href="' . get_permalink() . '">Read More</a></p>';
									} else {
										echo '<p class="biography">' . $biography . '</p>';
									}
									?>
								</div>
							</div>
						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Who We Serve -->
	<div class="who-we-serve-container">
		<div class="container">
			<div class="row">
				<div class="col-md-6 align-self-center">
					<h3>Who we serve</h3>
					<div class="divider">
						<span class="divider-separator"></span>
					</div>

					<div class="content">
						<p><?php echo wp_kses_post(get_field('who_we_serve')); ?></p>
					</div>
				</div>
				<div class="col-md-6">
					<?php $map = get_field('district_council_map');
					if (!empty($map)): ?>
						<img src="<?php echo esc_url($map['url']); ?>" alt="<?php echo esc_attr($map['alt']); ?>"
							class="img-fluid mx-auto d-block" />
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Vision and Goals -->
	<div class="vision-and-goals">
		<div class="container">
			<div class="row">

				<div class="col-md-6">
					<h3>Vision and Goals</h3>
					<div class="divider">
						<span class="divider-separator"></span>
					</div>
					<p><?php echo wp_kses_post(get_field('vision')); ?></p>

					<p><?php echo wp_kses_post(get_field('mission')); ?></p>

				</div>
				<div class="col-md-6">
					<p><?php echo wp_kses_post(get_field('goals')); ?></p>
				</div>
			</div>
		</div>
	</div>

	<!-- Get Involved -->
	<div class="get-involved">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3>Get Involved with <?php the_title(); ?> </h3>

					<div class="divider">
						<span class="divider-separator"></span>
					</div>
					<p>Connect, engage, and stay informed with the <?php the_title(); ?> on social media! </p>

					<p>Follow us on Facebook, Twitter, and Instagram to join the conversation, receive updates on
						community meetings, and participate in discussions on local public safety issues.</p>
				</div>
				<div class="col-md-8">
					<p>Stay in the loop with the <?php the_title(); ?>'s latest updates, events, and community news.
						Sign up for our newsletter today and be the first to know about what’s happening in your police
						district. Don’t miss out- join our mailing list!</p>
					<?php
					$iframe_url = esc_url(get_field('dc_form'));
					?>
					<iframe src="<?php echo $iframe_url; ?>" width="100%" height="600" frameborder="0" marginheight="0"
						marginwidth="0">
						Your browser does not support iframes.
					</iframe>
				</div>
			</div>
		</div>
	</div>

	<!-- Yearly Calendar -->
	<div class="yearly-calendar">
		<div class="container">
			<h3>Yearly Calendar​</h3>
			<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
				laborum</p>

			<?php
			$current_url = $_SERVER['REQUEST_URI'];
			$path_parts = explode('/', trim($current_url, '/'));
			$organizer_slug = end($path_parts);

			if ($organizer_slug) {
				echo do_shortcode('[tribe_events events_per_page="5" view="list" organizer="' . esc_attr($organizer_slug) . '"]');
			} else {
				echo '<p>No events found for the specified organizer.</p>';
			}
			?>
		</div>
	</div>


	<!-- Media Library -->
	<div class="media-library">
		<div class="container">
			<h3>Media Library</h3>
			<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
				laborum</p>
			<div class="text-center">
				<?php echo do_shortcode('[catf_dg id="362"]'); ?>
			</div>
		</div>

	</div>

	<!-- Quick Links -->
	<div class="quick-links">

		<div class="container">
			<h4>Quick Links</h4>
			<div class="row">
				<div class="col-md-4">
					<ul>
						<li><a href="#">City of Chicago Website</a></li>
						<li><a href="#">Chicago Police</a></li>
						<li><a href="#">Civilian Office of Police Accountability</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul>
						<li><a href="#">Cook County State’s Attorney Office</a></li>
						<li><a href="#">Law Office of the Cook County Public Defender</a></li>
						<li><a href="#">Consent Decree Monitor</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul>
						<li><a href="#">Office of Inspector General</a></li>
						<li><a href="#">Office of Public Safety Administration</a></li>
						<li><a href="https://codelibrary.amlegal.com/codes/chicago/latest/chicago_il/0-0-0-2600394"
								target="_blank">CCPSA Ordinance</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->