<?php /* Template Name: COPA Template */

get_header();
?>

<main id="primary" class="site-main copa-page">

    <?php
    while (have_posts()):
        the_post(); ?>

        <?php get_template_part('subheader'); ?>

        <div class="container">
            <div class="row">
                <h2>Civilian Office of Police Oversight (COPA)</h2>
                <div class="divider">
                    <span class="divider-separator"></span>
                </div>
                <?php echo get_field('copa'); ?>
            </div>

            <div class="row">
                <h2>What is COPA?</h2>
                <div class="divider">
                    <span class="divider-separator"></span>
                </div>
                <?php echo get_field('what_is_copa'); ?>
            </div>

            <?php if (have_rows('copa_column')): ?>
                <div class="row">
                    <?php while (have_rows('copa_column')):
                        the_row();
                        $copa_title = get_sub_field('title');
                        $copa_link = get_sub_field('link');
                        $copa_image = get_sub_field('background_image');
                        ?>
                        <div class="col-md-3 mb-3 col-sm-6">
                            <div class="box-container">
                                <div class="box" style="background-image: url('<?php echo esc_url($image); ?>');">
                                    <div class="overlay">
                                        <h3><?php echo esc_html($copa_title); ?></h3>

                                        <?php if ($copa_link):
                                            $copa_link_url = $copa_link['url'];
                                            $copa_link_title = $copa_link['title'];
                                            $copa_link_target = $copa_link['target'] ? $copa_link['target'] : '_self';
                                            ?>

                                            <a href="<?php echo esc_url($copa_link_url); ?>" class="btn btn-primary"
                                                target="<?php echo esc_attr($copa_link_target); ?>"><?php echo esc_html($copa_link_title); ?></a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <h2>The Commission’s Powers and Responsibilities over COPA</h2>
                <div class="divider">
                    <span class="divider-separator"></span>
                </div>
            </div>

            <?php if (have_rows('powers_responsibilities')): ?>
                <div class="row">
                    <?php while (have_rows('powers_responsibilities')):
                        the_row();
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                        ?>
                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <h3><?php echo esc_html($title); ?></h3>
                                <?php echo esc_html($description); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <h2>Selection of the COPA Chief Administrator</h2>
                <div class="divider">
                    <span class="divider-separator"></span>
                </div>
                <?php echo get_field('selection_chief_admin'); ?>

                <?php $review_link = get_field('review_the_procedures_link');
                if ($review_link):
                    $review_link_url = $review_link['url'];
                    $review_link_title = $review_link['title'];
                    $review_link_target = $review_link['target'] ? $review_link['target'] : '_self';
                    ?>

                    <a href="<?php echo esc_url($review_link_url); ?>" class="btn btn-primary"
                        target="<?php echo esc_attr($review_link_target); ?>"><?php echo esc_html($review_link_title); ?></a>
                <?php endif; ?>

                <?php echo get_field('add-on_description'); ?>
            </div>

            <?php if (have_rows('selection_procedure')): ?>
                <div class="row">
                    <?php while (have_rows('selection_procedure')):
                        the_row();
                        $selection_title = get_sub_field('title');
                        $selection_link = get_sub_field('link');
                        ?>
                        <div class="col-md-4 col-sm-6 mb-3 d-flex align-items-stretch">
                            <div class="selection-container">
                                <?php $selection_icon = get_sub_field('icon');
                                if (is_string($selection_icon)) {
                                    echo esc_html($selection_icon);
                                } else {
                                    if ('dashicons' === $selection_icon['type']) { ?>
                                        <div class="<?php echo esc_attr($selection_icon['value']); ?>"></div>
                                    <?php }
                                    if ('media_library' === $selection_icon['type']) {
                                        $attachment_id = $selection_icon['value'];
                                        $size = 'full';
                                        $image_html = wp_get_attachment_image($attachment_id, $size);
                                        echo wp_kses_post($image_html);
                                    }
                                    if ('url' === $selection_icon['type']) {
                                        $url = $selection_icon['value']; ?><img src="<?php echo esc_url($url); ?>" alt=""><?php
                                    }
                                } ?>
                                <h3><?php echo esc_html($selection_title); ?></h3>
                                <?php if ($selection_link):
                                    $selection_link_url = $selection_link['url'];
                                    $selection_link_title = $selection_link['title'];
                                    $selection_link_target = $selection_link['target'] ? $selection_link['target'] : '_self';
                                    ?>
                                    <a href="<?php echo esc_url($selection_link_url); ?>" class="btn btn-primary"
                                        target="<?php echo esc_attr($selection_link_target); ?>"><?php echo esc_html($selection_link_title); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php echo get_field('survey_content'); ?>
                </div>
            <?php endif; ?>





            <div class="row">
                <h2>Yearly Goals and Evaluations of the COPA Chief Administrator</h2>
                <div class="divider">
                    <span class="divider-separator"></span>
                </div>
                <?php echo get_field('yearly_goals'); ?>
            </div>

        </div>


        </section>

    <?php endwhile;
    ?>

</main><!-- #main -->

<?php
get_footer();
?>