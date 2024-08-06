<?php
/**
 * View: List View
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://evnt.is/1aiy
 *
 * @since   6.1.4 Changing our nonce verification structures.
 *
 * @version 6.2.0
 * @since 6.2.0 Moved the header information into a new components/header.php template.
 *
 * @var array    $events               The array containing the events.
 * @var string   $rest_url             The REST URL.
 * @var string   $rest_method          The HTTP method, either `POST` or `GET`, the View will use to make requests.
 * @var int      $should_manage_url    int containing if it should manage the URL.
 * @var bool     $disable_event_search Boolean on whether to disable the event search.
 * @var string[] $container_classes    Classes used for the container of the view.
 * @var array    $container_data       An additional set of container `data` attributes.
 * @var string   $breakpoint_pointer   String we use as pointer to the current view we are setting up with breakpoints.
 */

$header_classes = [ 'tribe-events-header' ];
if ( empty( $disable_event_search ) ) {
    $header_classes[] = 'tribe-events-header--has-event-search';
}
?>
<style>
    /* Add styles for your tribe events pagination */
    .tribe-events-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        top: 50px;
    }

    #prev_events_button,
    #next_events_button {
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }

    /* Style for the icons inside buttons */
    .tribe-events-c-nav__prev-icon-svg,
    .tribe-events-c-nav__next-icon-svg {
        fill: #ffffff; /* Icon color */
    }

    /* This will ensure that the button contents are aligned properly */
    button {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Add a bit of space between the icon and the text */
    button svg {
        margin-right: 5px; /* Space for the prev button */
    }

    button#next_events_button svg {
        margin-right: 0;
        margin-left: 5px; /* Space for the next button */
    }

    /* ICON STYLING */
    .mycontainer {
        display: flex;
        align-items: center;
        align-items: flex-start;
    }

    .icon-container {
        margin-right: 10px !important;
    }
</style>

<div
    <?php tribe_classes( $container_classes ); ?>
    data-js="tribe-events-view"
    data-view-rest-url="<?php echo esc_url( $rest_url ); ?>"
    data-view-rest-method="<?php echo esc_attr( $rest_method ); ?>"
    data-view-manage-url="<?php echo esc_attr( $should_manage_url ); ?>"
    <?php foreach ( $container_data as $key => $value ) : ?>
        data-view-<?php echo esc_attr( $key ) ?>="<?php echo esc_attr( $value ) ?>"
    <?php endforeach; ?>
    <?php if ( ! empty( $breakpoint_pointer ) ) : ?>
        data-view-breakpoint-pointer="<?php echo esc_attr( $breakpoint_pointer ); ?>"
    <?php endif; ?>
>
    <div class="tribe-common-l-container tribe-events-l-container">
        <?php $this->template( 'components/loader', [ 'text' => __( 'Loading...', 'the-events-calendar' ) ] ); ?>
        <?php $this->template( 'components/json-ld-data' ); ?>
        <?php $this->template( 'components/data' ); ?>
        <?php $this->template( 'components/before' ); ?>
        <?php $this->template( 'components/header' ); ?>
        <?php $this->template( 'components/filter-bar' ); ?>

        <div>
            <table class="tribe-events-calendar-list">
                <thead>
                    <tr>
                        <th>
                            <div class="mycontainer">
                                <div class="icon-container">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="text-container">
                                    Type of Meeting
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="mycontainer">
                                <div class="icon-container">
                                <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="text-container">
                                    Date of Meeting
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="mycontainer">
                                <div class="icon-container">
                                <i class="fas fa-volume-up"></i>
                                </div>
                                <div class="text-container">
                                    Meeting Notice / Agendas
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="mycontainer">
                                <div class="icon-container">
                                <i class="fas fa-book"></i>
                                </div>
                                <div class="text-container">
                                    Meeting Minutes / Recordings
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="mycontainer">
                                <div class="icon-container">
                                <i class="fas fa-file"></i>
                                </div>
                                <div class="text-container">
                                    Meeting Resources
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $events as $event ) : ?>
                        <?php $this->setup_postdata( $event ); ?>

                        <!-- Begin table row for each event -->
                        <tr>
                            <td>
                                <?php
                                // Fetch the terms for the post's 'event_category' taxonomy
                                $event_categories = get_the_terms( $event->ID, 'tribe_events_cat' );

                                if ( ! empty( $event_categories ) && ! is_wp_error( $event_categories ) ) {
                                    // Join multiple category names with commas
                                    $category_names = wp_list_pluck( $event_categories, 'name' );
                                    echo esc_html( join( ', ', $category_names ) );
                                } else {
                                    // Fallback text if no categories are found
                                    echo '';
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                // Get the event URL.
                                $event_url = esc_url( get_permalink( $event->ID ) );

                                // Output the event details wrapped in an anchor tag linking to the event URL.
                                echo '<a href="' . $event_url . '">';
                                // Output the start date.
                                echo esc_html( tribe_get_start_date( $event->ID, false, 'F j, Y' ) ); 
                                
                                echo '</a>';
                                ?>
                            </td>
                            <td>
                                <?php
                                $notice_agenda_id = get_field('meeting_notice_agendas', $event->ID);
                                $meeting_agenda_name = get_field('meeting_agenda_name', $event->ID); // Replace 'agenda_name' with your actual field name
                                if( $notice_agenda_id ) {
                                    $url = wp_get_attachment_url( $notice_agenda_id );
                                    // Check if the agenda name was provided, and use it as the link text
                                    $link_text = $meeting_agenda_name ? $meeting_agenda_name : 'Meeting Agenda';
                                    echo '<a href="' . esc_url($url) . '" download>' . esc_html($link_text) . '</a>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $minutes_recordings_id = get_field('meeting_minutes_recordings', $event->ID);
                                $meeting_minutes_recordings_name = get_field('meeting_minutes_recordings_name', $event->ID); // Use your actual field key
                                if( $minutes_recordings_id ) {
                                    $url = wp_get_attachment_url( $minutes_recordings_id );
                                    $link_text = $meeting_minutes_recordings_name ? $meeting_minutes_recordings_name : 'Meeting Minutes/Recordings';
                                    echo '<a href="' . esc_url($url) . '" download>' . esc_html($link_text) . '</a>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $resource_id = get_field('meeting_resources', $event->ID);
                                $meeting_resources_name = get_field('meeting_resources_name', $event->ID); // Use your actual field key
                                if( $resource_id ) {
                                    $file_url = wp_get_attachment_url( $resource_id );
                                    $link_text = $meeting_resources_name ? $meeting_resources_name : 'Meeting Resource';
                                    echo '<a href="' . esc_url($file_url) . '" download class="download-link">' . esc_html($link_text) . '</a>';
                                }
                                ?>
                            </td>
                            <!-- Add other columns here as needed -->
                        </tr>
                        <!-- End table row -->
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </tbody>
            </table>
        </div>
        <?php
        $show_prev_link = count( $events ) > 3;
        set_query_var( 'show_prev_link', $show_prev_link );
        ?>

        <div class="tribe-events-pagination">
            <!-- Add your buttons here -->
            <button id="prev_events_button">
                <?php $this->template( 'components/icons/caret-left', [ 'classes' => [ 'tribe-events-c-nav__prev-icon-svg' ] ] ); ?>
                Previous
            </button>

            <button id="next_events_button">
                Next
                <?php $this->template( 'components/icons/caret-right', [ 'classes' => [ 'tribe-events-c-nav__next-icon-svg' ] ] ); ?>
            </button>
        </div>

        <?php $this->template( 'components/ical-link' ); ?>
        <?php $this->template( 'components/after' ); ?>
    </div>
</div>

<?php $this->template( 'components/breakpoints' ); ?>