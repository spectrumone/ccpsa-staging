<?php /* Template Name: Community Commission */

get_header();
?>

	<main id="primary" class="site-main community-commission">
    <?php get_template_part('subheader'); ?>

    <div class="container">
        
        <div class="community-commission-section">
            <h2 class="community-commision header-title main-title">What is the Community Commission?</h2>
            <div class="blue-bar"></div>
            <p class="community-commission text">
                <?php echo wp_kses_post ( get_field('what_is_the_community_commission') ); ?>
            <p>
        </div>
        <div class="community-commission-image">
            <img src="<?php the_field('about_the_commission_image_1'); ?>" alt="" />
            <p class="image-source">Source: <a href="https://ecpsdistrict12.com/whatisecps/" target="_blank">https://ecpsdistrict12.com/whatisecps/</a></p>
        </div>
        <div class="community-commission-section">
            <h3 class="community-commision header-title">What are the goals of the Commission and District Councils?</h3>
            <p class="community-commission text">
                <?php echo wp_kses_post ( get_field('what_are_the_goals_of_the_commission_and_district_councils') ); ?>
            <p>
        </div>
        <div class="community-commission-image">
            <img src="<?php the_field('about_the_commission_image_2'); ?>" alt="" />
            <p class="image-source">Source: <a href="https://www.19thtogether.com/the-19th-district" target="_blank">https://www.19thtogether.com/the-19th-district</a></p>
        </div>
        <div class="community-commission-section">
            <h3 class="community-commision header-title">How are commissioners selected?</h3>
            <p class="community-commission text">
                <?php echo wp_kses_post ( get_field('how_are_commissioners_selected') ); ?>
            <p>
        </div>
        <div class="community-commission-section">
            <h3 class="community-commision header-title">Who can be a commissioner and for how long?</h3>
            <p class="community-commission text">
                <?php echo wp_kses_post ( get_field('who_can_be_a_commissioner_and_for_how_long') ); ?>
            <p>
        </div>
        <div class="community-commission-section">
            <h3 class="community-commision header-title">What range of powers does the commission have?</h3>
            <p class="community-commission text">
                <?php echo wp_kses_post ( get_field('what_range_of_powers_does_the_commission_have') ); ?>
            <p>
        </div>
        
        
        <div class="faq-container">
            <?php if (have_rows('faq_items')) : ?>
                <div class="accordion">
                    <?php while (have_rows('faq_items')) : the_row(); 
                        $faq_icon_id = get_sub_field('faq_icon');
                        $faq_question = get_sub_field('faq_question');
                        $faq_answer = get_sub_field('faq_answer'); 
                    ?>
                        <div class="accordion-item">
                            <input type="checkbox" id="faq-<?php echo get_row_index(); ?>">
                            <label for="faq-<?php echo get_row_index(); ?>" class="faq-header">
                                <span class="faq-question-container">
                                    <?php 
                                    if (!empty($faq_icon_id)) :
                                        $faq_icon_url = wp_get_attachment_image_src($faq_icon_id, 'full')[0]; // Adjust 'full' to your desired size
                                    ?>
                                        <img src="<?php echo esc_url($faq_icon_url); ?>" alt="<?php echo esc_attr(get_post_meta($faq_icon_id, '_wp_attachment_image_alt', true)); ?>" class="faq-icon" />
                                    <?php endif; ?>
                                    <span class="faq-question"><?php echo $faq_question; ?></span>
                                    <span class="faq-arrow"></span>
                                </span>
                            </label>
                            <div class="faq-content">
                                <?php echo $faq_answer; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <p class="fst-italic">(Source: Municipal Code of Chicago, 2-80-040(c) and (d), and 2-80-050)</p>

            <?php else : ?>
                <p>No FAQs found.</p>
            <?php endif; ?>
        </div>




    </div>



   
	</main><!-- #main -->

<?php
get_footer();
