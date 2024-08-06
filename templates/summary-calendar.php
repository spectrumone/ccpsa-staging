<?php
/*
Template Name: Events Summary Table
*/

get_header();
?>

<?php get_template_part('subheader'); ?>

<div class="container my-5">
    <div class="tribe-events-summary">

        <!-- Filter Form -->
        <form method="get" id="events-filter" class="mb-4">
            <div class="row align-items-end g-3">
                <div class="col-md-3">
                    <select name="organizer" id="organizer" class="form-select">
                        <option value=""><?php _e('All Meetings', 'text-domain'); ?></option>
                        <?php
                        $organizers = tribe_get_organizers();
                        foreach ($organizers as $organizer) {
                            echo '<option value="' . esc_attr($organizer->ID) . '">' . esc_html($organizer->post_title) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="month" id="month" class="form-select">
                        <option value=""><?php _e('All Months', 'text-domain'); ?></option>
                        <?php
                        for ($m = 1; $m <= 12; $m++) {
                            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                            echo '<option value="' . esc_attr($m) . '">' . esc_html($month) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="year" id="year" class="form-select">
                        <option value=""><?php _e('All Years', 'text-domain'); ?></option>
                        <?php
                        $args = array(
                            'post_type' => 'tribe_events',
                            'posts_per_page' => -1,
                            'meta_key' => '_EventStartDate',
                            'orderby' => 'meta_value',
                            'order' => 'ASC',
                            'fields' => 'ids', 
                        );

                        $events_query = new WP_Query($args);
                        $events_years = array();

                        if ($events_query->have_posts()) {
                            while ($events_query->have_posts()) {
                                $events_query->the_post();
                                $event_start_date = strtotime(tribe_get_start_date(null, false, 'Y-m-d H:i:s'));
                                $event_year = date('Y', $event_start_date);
                                $events_years[$event_year] = $event_year;
                            }
                            wp_reset_postdata();
                        }

                        foreach ($events_years as $year) {
                            echo '<option value="' . esc_attr($year) . '">' . esc_html($year) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" id="filter-button" class="btn btn-primary w-100"><?php _e('Filter', 'text-domain'); ?></button>
                </div>
                <div class="col-md-2">
                    <button type="button" id="clear-button" class="btn btn-link w-100"><?php _e('Clear', 'text-domain'); ?></button>
                </div>

            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Type of Meeting</th>
                        <th>Date of Meeting</th>
                        <th>Meeting Notice/Agenda</th>
                        <th>Meeting Minutes/Recordings</th>
                        <th>Meeting Resources</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selected_organizer = isset($_GET['organizer']) ? sanitize_text_field($_GET['organizer']) : '';
                    $selected_month = isset($_GET['month']) ? intval($_GET['month']) : '';
                    $selected_year = isset($_GET['year']) ? intval($_GET['year']) : '';

                    $args = array(
                        'post_type' => 'tribe_events',
                        'posts_per_page' => -1,
                        'meta_key' => '_EventStartDate',
                        'orderby' => 'meta_value',
                        'order' => 'ASC',
                    );

                    $meta_query = array();

                    if ($selected_month || $selected_year) {
                        if ($selected_month) {
                            $start_date = $selected_year . '-' . sprintf('%02d', $selected_month) . '-01 00:00:00';
                            $end_date = $selected_year . '-' . sprintf('%02d', $selected_month) . '-' . date('t', strtotime($start_date)) . ' 23:59:59';

                            $meta_query[] = array(
                                'key' => '_EventStartDate',
                                'value' => array($start_date, $end_date),
                                'compare' => 'BETWEEN',
                                'type' => 'DATETIME'
                            );
                        } else {
                            // Filter by selected year only
                            $start_date = $selected_year . '-01-01 00:00:00';
                            $end_date = $selected_year . '-12-31 23:59:59';

                            $meta_query[] = array(
                                'key' => '_EventStartDate',
                                'value' => array($start_date, $end_date),
                                'compare' => 'BETWEEN',
                                'type' => 'DATETIME'
                            );
                        }
                    }

                    if ($selected_organizer) {
                        // Handle both "District Council" and "Commission" organizers
                        $meta_query[] = array(
                            'relation' => 'OR',
                            array(
                                'key' => '_EventOrganizerID',
                                'value' => $selected_organizer,
                                'compare' => '='
                            ),
                            array(
                                'key' => '_EventOrganizerID',
                                'value' => 'District Council',
                                'compare' => 'LIKE'
                            ),
                            array(
                                'key' => '_EventOrganizerID',
                                'value' => 'Commission',
                                'compare' => 'LIKE'
                            )
                        );
                    }

                    if (!empty($meta_query)) {
                        $args['meta_query'] = $meta_query;
                    }

                    $events = new WP_Query($args);

                    if ($events->have_posts()) :
                        while ($events->have_posts()) : $events->the_post();
                            $start_date = strtotime(tribe_get_start_date(null, false, 'Y-m-d'));
                            $formatted_start_date = date_i18n('F j, Y', $start_date);
                            $organizer_id = tribe_get_organizer_id();
                            $organizer_name = tribe_get_organizer($organizer_id);

                            // Check if organizer name contains "District Council" or "Commission"
                            if (strpos($organizer_name, 'District Council') !== false) {
                                $css_class = 'district-council-color';
                            } elseif (strpos($organizer_name, 'Commission') !== false) {
                                $css_class = 'commission-color';
                            } else {
                                $css_class = ''; // Default class if no match
                            }
                            ?>
                            <tr class="<?php echo esc_attr($css_class); ?>">
                                <td><?php echo esc_html($organizer_name); ?></td>
                                <td><?php echo esc_html($formatted_start_date); ?></td>
                                <td><a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'meeting_notice', true)); ?>">View Agenda</a></td>
                                <td><a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'meeting_minutes', true)); ?>">View Minutes</a></td>
                                <td><a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'meeting_resources', true)); ?>">View Resources</a></td>
                            </tr>
                        <?php endwhile;
                    else : ?>
                        <tr>
                            <td colspan="5"><?php esc_html_e('No events found', 'text-domain'); ?></td>
                        </tr>
                    <?php endif;
                    wp_reset_postdata();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
get_footer();
?>

<script>
    jQuery(document).ready(function($) {
        // Submit form on filter button click
        $('#filter-button').click(function(e) {
            e.preventDefault(); // Prevent form submission
            $('#events-filter').submit(); // Submit form
        });

        // Clear all filter fields
        $('#clear-button').click(function(e) {
            e.preventDefault(); // Prevent form submission
            // Clear all select fields
            $('#events-filter select').val('');
            // Submit form to apply clear filters
            $('#events-filter').submit();
        });

        // Set selected options on page load
        var selectedMonth = '<?php echo isset($_GET['month']) ? esc_js($_GET['month']) : ''; ?>';
        var selectedYear = '<?php echo isset($_GET['year']) ? esc_js($_GET['year']) : ''; ?>';
        if (selectedMonth) {
            $('#month').val(selectedMonth);
        }
        if (selectedYear) {
            $('#year').val(selectedYear);
        }
    });
</script>
