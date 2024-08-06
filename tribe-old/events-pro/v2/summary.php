<?php
/**
 * View: Summary View
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/summary.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 6.2.0
 * @since   6.1.2 Changing our nonce verification structures.
 * @since 6.2.0 Defer header rendering to the components/header template.
 *
 * @var array    $events               The array containing the events.
 * @var array    $events_by_date       An array containing the events indexed by date.
 * @var string   $rest_url             The REST URL.
 * @var string   $rest_method          The HTTP method, either `POST` or `GET`, the View will use to make requests.
 * @var int      $should_manage_url    Int containing if it should manage the URL.
 * @var bool     $disable_event_search Boolean on whether to disable the event search.
 * @var string[] $container_classes    Classes used for the container of the view.
 * @var array    $container_data       An additional set of container `data` attributes.
 * @var string   $breakpoint_pointer   String we use as pointer to the current view we are setting up with breakpoints.
 */

use Tribe__Date_Utils as Dates;

$header_classes = [ 'tribe-events-header' ];
if ( empty( $disable_event_search ) ) {
	$header_classes[] = 'tribe-events-header--has-event-search';
}
?>

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
		<?php $this->template( 'components/loader', [ 'text' => __( 'Loading...', 'tribe-events-calendar-pro' ) ] ); ?>

		<?php $this->template( 'components/json-ld-data' ); ?>

		<?php $this->template( 'components/data' ); ?>

		<?php $this->template( 'components/before' ); ?>

		<?php $this->template( 'components/header' ); ?>

		<div class="tribe-events-pro-summary">

		<table class="tribe-events-calendar-list">
            <thead>
                <tr>
                    <th>Type of Meeting</th>
                    <th>Date of Meeting</th>
                    <th>Meeting Notice / Agendas</th>
                    <th>Meeting Minutes / Recordings</th>
                    <th>Meeting Resources</th> <!-- New header for Meeting Resources -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $events as $event ) : ?>
                    <?php $this->setup_postdata( $event ); ?>

                    <!-- Begin table row for each event -->
                    <tr>
                        <td>
                            <?php 
                            $event_tags = get_the_terms( $event->ID, 'post_tag' );
                            if ( ! empty( $event_tags ) && ! is_wp_error( $event_tags ) ) {
                                $tag_links = array();
                                foreach ( $event_tags as $tag ) {
                                    $tag_links[] = esc_html( $tag->name );
                                }
                                echo implode( ', ', $tag_links ); // Display tags separated by commas.
                            }
                            ?>
                        </td>
                        <td>
                            <?php 
                            // Get the start date.
                            echo esc_html( tribe_get_start_date($event->ID, false, 'F j, Y') ); 
                            // Get the start time.
                            echo ' ' . esc_html( tribe_get_start_time($event->ID) ); 
                            // Get the event location name.
                            echo ' at ' . esc_html( tribe_get_venue($event->ID) );
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

		<?php $this->template( 'summary/nav' ); ?>

		<?php $this->template( 'components/ical-link' ); ?>

		<?php $this->template( 'components/after' ); ?>

	</div>
</div>

<?php $this->template( 'components/breakpoints' ); ?>
