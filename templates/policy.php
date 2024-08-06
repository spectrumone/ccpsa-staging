<?php /* Template Name: Policy Template */

get_header();
?>

	<main id="primary" class="site-main policy-page">

		<?php
		while ( have_posts() ) : the_post(); ?>

            <?php get_template_part('subheader'); ?>

                <!-- Agency Initiating Policy Proposal Section -->
                <div class="container">
                    <div class="row">
                        <h2>Agency Initiating Policy Proposal</h2>
                        <div class="col-md-7">
                            <p><?php echo wp_kses_post ( get_field('agency_policy_proposal') ); ?></p>
                        </div>
                    </div>

                    <!-- Content / Table -->
                    <div class="row">
                        <p><?php the_content(); ?></p>
                    </div>

                </div>

                <!-- What policies is the Commission working on? Section -->        
                <div class="policy-commission">        
                    <div class="container">

                        <div class="row">
                            <div class="col-md-7">
                                <h2>What policies is the Commission working on?</h2>
                                <p><?php echo wp_kses_post ( get_field('policies_commission') ); ?></p>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 32px;">
                            <div class="col-md-6">
                                <h5>Policies Introduced and Received by the Commission</h5>
                                <p><?php echo wp_kses_post ( get_field('policies_introduced') ); ?></p>
                            </div>

                            <div class="col-md-6">
                                <!-- <h5>Polices Received by the Commission</h5> -->
                                <p><?php echo wp_kses_post ( get_field('policies_received') ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>    

                <!-- Generic Policy Timeline -->
                <div class="policy-timeline">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Policymaking Process</h2>
                                <p><?php echo wp_kses_post ( get_field('generic_policy_timeline') ); ?></p>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 32px;">
                            <div class="col-md-6">
                                <ol start="1">
                                    <?php
                                    $count = 0; // Initialize counter
                                    if (have_rows('policy_timeline_list')):
                                        while (have_rows('policy_timeline_list')) : the_row();
                                            $sub_value = get_sub_field('description');
                                            $count++; // Increment counter
                                            ?>
                                            <li><?php echo $sub_value; ?></li>
                                            <?php
                                            if ($count % 4 == 0 && $count < 8) {
                                                echo '</ol></div><div class="col-md-6"><ol start="' . ($count + 1) . '">';
                                            }
                                        endwhile;
                                    endif;
                                    ?>
                                </ol>
                            </div>
                        </div>
                        
                    </div>   
                </div>
            
                <!-- Sub-footer -->
                <div class="sub-footer">
                    <div class="container">
                        <div class="row">
                            <p>CCPSA uses national best practice methods to engage impacted communities in Policy development, including consultation with subject matter experts. Prior to the adoption of any Policy, proposed changes shall be published on the Commission's website for at least 30 days prior to adoption with an explanation of the policy and the policy changes.</p>  

                            <p>To submit comments or questions about policies CCPSA is working on, please email <a href="mailto:CommunityCommissionPublicComment@cityofchicago.org">CommunityCommissionPublicComment@cityofchicago.org</a></p>           
                        </div>
                    </div>
                </div>


		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
