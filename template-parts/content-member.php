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

        <!-- Member Details -->

        <div class="full-member">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class=""><?php the_title(); ?></h2>
                        <p class="position"><?php the_field('position'); ?></p>
                        <p class="biography"><?php the_content(); ?></p>
                        <a class="email" href="<?php echo esc_url( 'mailto:' . antispambot( get_field('email_address' ) ) ); ?>">Email Me</a>
                    </div>

                    <div class="col-md-6">
                        <?php 
                        $member_url = has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url()) : 'default-image-url.jpg';
                        $alt_text = get_the_title();
                        echo '<img class="solo-headshot" src="' . $member_url . '" alt="' . esc_attr($alt_text) . '">';
                        ?>
                    </div>

                </div>
            </div>
        </div>
            
        </div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
