<?php
/**
 * Content for a single resume.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-single-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( resume_manager_user_can_view_resume( $post->ID ) ) : ?>

    <div class="resume-meta-wrap">
        <ul class="meta">
			<?php do_action( 'single_resume_meta_start' ); ?>
            
            <li class="candidate-title"><?php the_candidate_title(); ?></li>
            
            <li class="candidate-location"><?php the_candidate_location(); ?></li>

			<li class="date-posted" itemprop="datePosted"><date><?php printf( __( 'Updated %s ago', 'buddyboss-theme' ), human_time_diff( get_the_modified_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>

			<?php do_action( 'single_resume_meta_end' ); ?>
		</ul>
    </div>
    
    <div class="entry-content-job">
        <div class="entry-secondary">
            <div class="single-job-sidebar">
                <div class="resume-aside">
        			<div class="bb-candidate-photo"><?php the_candidate_photo(); ?></div>
                    <div class="bb-candidate-data">
                        <?php get_job_manager_template( 'contact-details.php', array( 'post' => $post ), 'buddyboss-theme', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
                        <h3><?php echo __( 'Profile &amp; Portfolio', 'buddyboss-theme' ); ?></h3>
                        <?php the_resume_links(); ?>
                        <?php if ( get_the_resume_category() ) : ?>
            				<p class="resume-category"><?php the_resume_category(); ?></p>
            			<?php endif; ?>
                        <?php do_action( 'single_resume_start' ); ?>
                    </div>
        		</div>
            </div>
        </div>
        <div class="entry-primary">
        
            <div class="single-resume-content">
                
                <?php the_candidate_video(); ?>
        
        		<div class="resume_description">
        			<?php echo apply_filters( 'the_resume_description', get_the_content() ); ?>
        		</div>
        
        		<?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
        			<h2><?php _e( 'Experience', 'buddyboss-theme' ); ?></h2>
        			<dl class="resume-manager-experience">
        			<?php
        				foreach( $items as $item ) : ?>
        
        					<dt>
                                <h3><?php echo '<strong class="employer">' . esc_html( $item['employer'] ) . '</strong>'; ?></h3>
        						<span class="sub-date"><?php echo '<span class="bb_job_title">' . esc_html( $item['job_title'] ) . '</span> - '; ?><?php echo esc_html( $item['date'] ); ?></span>						
        					</dt>
        					<dd>
        						<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
        					</dd>
        
        				<?php endforeach;
        			?>
        			</dl>
        		<?php endif; ?>
                
                <?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
        			<h2><?php _e( 'Education', 'buddyboss-theme' ); ?></h2>
        			<dl class="resume-manager-education">
        			<?php
        				foreach( $items as $item ) : ?>
        
        					<dt>
                                <h3><?php echo '<strong class="qualification">' . esc_html( $item['qualification'] ) . '</strong>'; ?></h3>
        						<span class="sub-date"><?php echo '<span class="bb_location">' . esc_html( $item['location'] ) . '</span>'; ?></span>
                                <div class="sub-date"><?php echo esc_html( $item['date'] ); ?></div>						
        					</dt>
        					<dd>
        						<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
        					</dd>
        
        				<?php endforeach;
        			?>
        			</dl>
        		<?php endif; ?>
                
                <?php if ( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) ) ) && is_array( $skills ) ) : ?>
        			<h2><?php _e( 'Skills', 'buddyboss-theme' ); ?></h2>
        			<ul class="resume-manager-skills">
        				<?php echo '<li>' . implode( '</li><li>', $skills ) . '</li>'; ?>
        			</ul>
        		<?php endif; ?>
        
        		<?php get_job_manager_template( 'contact-details.php', array( 'post' => $post ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
        
        		<?php do_action( 'single_resume_end' ); ?>
        	</div>
            
        </div>
    </div>
<?php else : ?>

	<?php get_job_manager_template_part( 'access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

<?php endif; ?>
