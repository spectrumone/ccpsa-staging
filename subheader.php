<header class="entry-header">
	<div class="hero-banner bg-dark" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>')">
	<div class="overlay"></div>
		<div class="container">
			<div class="title">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="breadcrumbs">
				<?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); } ?>
			</div>
		</div>
	</div>
</header><!-- .entry-header -->