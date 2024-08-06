<?php 
function district_council_events_list() {
    global $post;

    $organizer_name = get_field('organizer_name', $post->ID);

    if ( empty( $organizer_name ) ) {
        return '<p>' . __( 'Organizer name not provided.', 'ccpsa' ) . '</p>';
    }

    ob_start();

    $events = tribe_get_events( array(
        'posts_per_page' => -1, 

    ) );

    if ( empty( $events ) ) {
        return '<p>' . __( 'No upcoming events found.', 'ccpsa' ) . '</p>';
    }

    $filtered_events = array_filter( $events, function( $event ) use ( $organizer_name ) {
        $organizers = tribe_get_organizer_ids( $event->ID );
        foreach ( $organizers as $organizer_id ) {
            if ( get_the_title( $organizer_id ) === $organizer_name ) {
                return true;
            }
        }
        return false;
    });

    // Limit events to 5
    $filtered_events = array_slice($filtered_events, 0, 5);

    if ( empty( $filtered_events ) ) {
        return '<p>' . __( 'No events found for the specified organizer.', 'ccpsa' ) . '</p>';
    }

    ?>
    <div class="tribe-common-l-container tribe-events-l-container">
        <div class="table-responsive">

        <?php tribe_get_template_part('components/filter-bar'); ?>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th><?php _e('Type of Meeting', 'ccpsa'); ?></th>
                        <th><?php _e('Date of Meeting', 'ccpsa'); ?></th>
                        <th><?php _e('Meeting Notice / Agendas', 'ccpsa'); ?></th>
                        <th><?php _e('Meeting Minutes / Recordings', 'ccpsa'); ?></th>
                        <th><?php _e('Meeting Resources', 'ccpsa'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $filtered_events as $event ) : ?>
                        <?php setup_postdata( $event ); ?>
                        <tr>
                            <td><?php echo esc_html( tribe_get_organizer( $event ) ); ?></td>
                            <td>
                                <?php
                                $event_date = get_post_meta( $event->ID, '_EventStartDate', true ); 

                                if ( $event_date ) {
                                    echo esc_html( date( 'F j, Y', strtotime( $event_date ) ) );
                                } else {
                                    echo esc_html__( 'Date not available', 'ccpsa' );
                                }
                                ?>
                            </td>
                            <td><a href="<?php the_field('meeting_file', $event->ID); ?>" target="_blank"><?php the_field('meeting_agenda_name', $event->ID); ?></a></td>
                            <td><a href="<?php the_field('meeting_minutes_recordings', $event->ID); ?>" target="_blank"><?php the_field('meeting_minutes_recordings_name', $event->ID); ?></a></td>
                            <td><a href="<?php the_field('meeting_resources', $event->ID); ?>" target="_blank"><?php the_field('meeting_resources_name', $event->ID); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php

    return ob_get_clean();
}

add_shortcode('district_council_events', 'district_council_events_list');
?>
