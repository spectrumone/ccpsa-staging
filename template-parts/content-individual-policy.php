
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ccpsa
 */

?>

<?php get_template_part('subheader'); ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Introduction Details -->
            <div class="intro-content">
                <div class="container">   

                    <h2><?php the_field('subtitle'); ?></h2>

                    <?php 
                    // $alt_text = get_the_title();
                    // echo get_the_post_thumbnail(null, 'full', array('alt' => $alt_text));
                    ?>
                    
                    <br>

                    <h6>Introduced by:</h6>
                    <p class="introduced_by"><?php the_field('introduced_by'); ?></p>

                    <h6 style="margin-top: 32px !important;">Submitted to:</h6>
                    <p class="submitted_by" style="margin: 0px !important;"><?php the_field('submitted_by'); ?></p>

                    <h6 style="margin-top: 32px !important;">Date of Introduction:</h6>
                    <p class="date_of_introduction" style="margin: 0px !important;"><?php the_field('date_of_introduction'); ?></p>

                    <h6 style="margin-top: 32px !important;">Policy Description:</h6>
                    <p class="policy-description" style="margin-bottom: 32px !important;"><?php the_field('policy-description'); ?></p>
                    
                    <a class="feedback" href="<?php echo esc_url( get_field('provide_feedback_on_cpds_policy') ); ?>">Provide feedback on CPD's Policy</a>
                </div>
            </div><!-- .intro-content -->

            <div class="current-policy-content">
                <div class="container">
                    <h3>Current Policy</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>

                    <div class="row">
                        <?php the_field('current_policy_table'); ?>
                    </div>

                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'policy-status')" id="defaultOpen">Policy Status</button>
                        <button class="tablinks" onclick="openCity(event, 'documents')">Documents</button>
                        <button class="tablinks" onclick="openCity(event, 'media')">Media</button>
                    </div>

                    <div id="policy-status" class="tabcontent">
                        <h3>Policy Status</h3>
                        <p class="policy_status_description"><?php the_field('policy_status_description'); ?></p>
                    </div>

                    <div id="documents" class="tabcontent">
                        <div class="row">
                            <?php the_field('documents_table'); ?>
                        </div>
                    </div>

                    <div id="media" class="tabcontent">
                        <div class="row">
                            <div class="col-md-6">
                                <?php the_field('webinar_video_embed'); ?>
                            </div>

                            <div class="col-md-6">
                                <h6><?php the_field('webinar_title'); ?></h6>
                                <?php the_field('webinar_description'); ?>
                            </div>
                        </div>
                    </div>
                </div> 
            </div><!-- .current-policy-content -->

            <!-- Script for 3 tabs under Current Policy -->
            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
            </script>
        </article><!-- #post-<?php the_ID(); ?> -->



<?php
get_footer();
?>
