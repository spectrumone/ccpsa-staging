<?php
/**
 * Template part for displaying page content in press-release.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccpsa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
        <div class="container">
            <div class="row">
                <h2><?php the_title(); ?></h2>

                <div class="divider">
					<span class="divider-separator"></span>
				</div>

                <div class="col-md-7">
                    <p><?php echo wp_kses_post ( get_field('press_release_announcement') ); ?></p>
                </div>
            </div>

            <!-- Announcements -->

            <div class="search-container">
                <?php echo do_shortcode( '[searchandfilter fields="search,press-release"]' ); ?>
            </div>

            <div class="announcements">
            <?php
            $announcements = get_field('announcements');
            if( $announcements ): ?>
                <?php foreach( $announcements as $post ): 
                    setup_postdata($post); ?>
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col-md-3 d-none d-lg-block">
                            <?php if( has_post_thumbnail() ): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'bd-placeholder-img', 'width' => 200, 'height' => 250]); ?>
                                </a>
                            <?php else: ?>
                                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9 p-4 d-flex flex-column position-static">
                            <div class="mb-1 text-muted date"><?php the_date(); ?></div>
                            <h3 class="mb-0"><?php the_title(); ?></h3>
                            <p class="card-text mb-auto"><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="stretched-link">Learn more</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php 
                wp_reset_postdata(); ?>
            <?php endif; ?>
</div>



        </div>
        
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
