<?php

function ccpsa_enqueue_assets() {
    wp_enqueue_style('bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2');

    wp_enqueue_script( 'ccpsa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    wp_enqueue_style( 'ccpsa-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'ccpsa-style', 'rtl', 'replace' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Page template
    $templates = [
        'templates/community-commission.php' => 'community-commission.css',
        'templates/policy.php' => 'policy.css',
        'templates/press-releases.php' => 'press-release.css',
        'templates/summary-calendar.php' => 'summary-calendar.css',
        'templates/copa.php' => 'copa.css',
    ];

    foreach ($templates as $template => $css_file) {
        if (is_page_template($template)) {
            wp_enqueue_style(basename($css_file, '.css') . '-css', get_template_directory_uri() . '/css/page/' . $css_file);
        }
    }

    // Enqueue block level css files
    wp_enqueue_style('header', get_template_directory_uri() . '/css/block/header.css');
    wp_enqueue_style('footer', get_template_directory_uri() . '/css/block/footer.css');
    wp_enqueue_style('subheader', get_template_directory_uri() . '/css/block/subheader.css');

    // Enqueue tribe plugin/calendar css
    wp_enqueue_style('calendar', get_template_directory_uri() . '/css/tribe/style.css');

    // Enqueue org chart css
    wp_enqueue_style('chart', get_template_directory_uri() . '/css/org-chart/style.css');

    // Enqueue main css
    wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');

    // Enqueue reset css
    wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css');

    // Enqueue front-page.css
    if (is_front_page()) {
        wp_enqueue_style('home', get_template_directory_uri() . '/css/page/front-page.css');
    }
    
    // Enqueue district-council.css
    if (is_singular('district-council')) {
        wp_enqueue_style('district-council', get_template_directory_uri() . '/css/page/district-council.css');
    }

    // Enqueue single-individual-policy.css
    if (is_singular('individual-policy')) {
        wp_enqueue_style('individual-policy', get_template_directory_uri() . '/css/page/individual-policy.css');
    }

    // Enqueue press-release.css
    if (is_singular('press-release')) {
        wp_enqueue_style('press-release', get_template_directory_uri() . '/css/page/press-release.css');
    }

    // Enqueue jQuery UI Datepicker
    wp_enqueue_script('jquery-ui-datepicker');

    // Load jQuery UI CSS file (only if needed for styling)
    wp_enqueue_style('jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
}

add_action( 'wp_enqueue_scripts', 'ccpsa_enqueue_assets' );


