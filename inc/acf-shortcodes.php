<?php

add_shortcode( 'pr_shortcode', 'pr_shortcode' );
function pr_shortcode() {
    $buffer = ''; 
    $q = new WP_Query(array(
        'post_type' => 'press-release',
        'posts_per_page' => 3,
        'orderby' => 'date', 
        'order' => 'DESC', 
    ));
    $counter = 0;
    while ($q->have_posts()) {
        $q->the_post();
        $buffer .= '<a href="' . get_permalink() . '" class="press-release-link">';
        $buffer .= '<div class="press-release d-flex">';
        if (has_post_thumbnail()) {
            $buffer .= '<div class="press-release-thumbnail">';
            $buffer .= get_the_post_thumbnail();
            $buffer .= '</div>';
        }
        $excerpt = get_the_excerpt();
        $excerpt = mb_strimwidth($excerpt, 0, 66, '...');
        $buffer .= '<div class="press-release-content">';
        $buffer .= '<div class="press-release-date">' . get_the_date() . '</div>';
        $buffer .= '<div class="press-release-excerpt">';
        $buffer .= $excerpt;
        $buffer .= '</div>';
        $buffer .= '</div>'; 
        $buffer .= '</div>'; 
        $buffer .= '</a>';
    }
    wp_reset_postdata();
    return $buffer;
}


?>