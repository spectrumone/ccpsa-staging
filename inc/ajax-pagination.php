<?php
function enqueue_ajax_pagination_script() {
    wp_enqueue_script('ajax-pagination', get_template_directory_uri() . '/js/ajax-pagination.js', array('jquery'), null, true);
    wp_localize_script('ajax-pagination', 'ajaxpagination', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-pagination-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_pagination_script');


?>