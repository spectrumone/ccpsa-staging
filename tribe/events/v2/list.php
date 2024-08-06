<?php
/**
 * View: List View for each District Council 
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

$header_classes = ['tribe-events-header'];
if (empty($disable_event_search)) {
    $header_classes[] = 'tribe-events-header--has-event-search';
}

?>
<div
    <?php tribe_classes($container_classes); ?>
    data-js="tribe-events-view"
    data-view-rest-url="<?php echo esc_url($rest_url); ?>"
    data-view-rest-method="<?php echo esc_attr($rest_method); ?>"
    data-view-manage-url="<?php echo esc_attr($should_manage_url); ?>"
    <?php foreach ($container_data as $key => $value) : ?>
        data-view-<?php echo esc_attr($key); ?>="<?php echo esc_attr($value); ?>"
    <?php endforeach; ?>
    <?php if (!empty($breakpoint_pointer)) : ?>
        data-view-breakpoint-pointer="<?php echo esc_attr($breakpoint_pointer); ?>"
    <?php endif; ?>
>
    <div class="tribe-common-l-container tribe-events-l-container">
        <?php $this->template('components/loader', ['text' => __('Loading...', 'the-events-calendar')]); ?>

        <?php $this->template('components/json-ld-data'); ?>

        <?php $this->template('components/data'); ?>

        <?php $this->template('components/before'); ?>

        <?php $this->template('components/header'); ?>

        <?php $this->template('components/filter-bar'); ?>

        <div class="table-responsive">
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
                    <?php foreach ($events as $event) : ?>
                        <?php 
                        $this->setup_postdata($event); 
                        $organizer_ids = tribe_get_organizer_ids($event->ID);
                        $organizer_classes = '';

                        if ($organizer_ids) {
                            foreach ($organizer_ids as $organizer_id) {
                                $organizer_name = tribe_get_organizer($organizer_id, 'name', false);
                                $organizer_slug = sanitize_title($organizer_name);

                                if ($organizer_slug) {
                                    $organizer_classes .= ' organizer-' . $organizer_slug;
                                }
                            }
                        }
                        ?>
                        <tr class="<?php echo esc_attr($organizer_classes); ?>">
                            <td><?php echo esc_html(tribe_get_organizer($event)); ?></td>
                            <td>
                                <?php
                                $event_date = get_post_meta($event->ID, '_EventStartDate', true); 
                                if ($event_date) {
                                    echo esc_html(date('F j, Y', strtotime($event_date)));
                                } else {
                                    echo esc_html__('Date not available', 'ccpsa');
                                }
                                ?>
                            </td>
                            <td><a href="<?php the_field('meeting_file'); ?>" target="_blank"><?php the_field('meeting_agenda_name'); ?></a></td>
                            <td><a href="<?php the_field('meeting_minutes_recordings'); ?>" target="_blank"><?php the_field('meeting_minutes_recordings_name'); ?></a></td>
                            <td><a href="<?php the_field('meeting_resources'); ?>" target="_blank"><?php the_field('meeting_resources_name'); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </tbody>

            </table>
        </div>

        <?php $this->template('list/nav'); ?>

        <?php $this->template('components/ical-link'); ?>

        <?php $this->template('components/after'); ?>

    </div>
</div>

<?php $this->template('components/breakpoints'); ?>
