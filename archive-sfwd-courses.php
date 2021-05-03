<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BuddyBoss_Theme
 */
global $wp_query;

get_header();

$view = llms_page_display();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <div id="learndash-content" class="learndash-course-list">
                <form id="bb-courses-directory-form" class="bb-courses-directory" method="get" action="">
                    
                    <?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
                    <input type="hidden" name="current_page" value="<?php echo esc_attr( $paged );?>" >
                    
                    <div class="flex align-items-center bb-courses-header">
                        <h4 class="bb-title"><?php echo LearnDash_Custom_Label::get_label( 'courses' ); ?></h4>

                        <div id="courses-dir-search" class="bs-dir-search" role="search">
                            <div id="search-members-form" class="bs-search-form">
                                <label for="bs_members_search"
                                       class="bp-screen-reader-text"><?php _e( 'Search', 'buddyboss-theme' ); ?></label>
                                <input type="text" name="search" id="bs_members_search"
                                       value="<?php echo ! empty( $_GET['search'] ) ? $_GET['search'] : ''; ?>"
                                       placeholder="<?php _e( 'Search', 'buddyboss-theme' ); ?> <?php echo LearnDash_Custom_Label::get_label( 'courses' ) . '...'; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <nav class="courses-type-navs main-navs bp-navs dir-navs bp-subnavs">
                		<ul class="component-navigation courses-nav">
                            <?php 
                            $navs = array(
                                'all' => __( 'All', 'buddyboss-theme' ) . ' ' . LearnDash_Custom_Label::get_label( 'courses' ) . '<span class="count">' . buddyboss_theme()->learndash_helper()->get_all_courses_count() . '</span>',
                            );
                            
                            if ( is_user_logged_in() ) {
                                $navs[ 'my-courses' ] = __( 'My', 'buddyboss-theme' ) . ' ' . LearnDash_Custom_Label::get_label( 'courses' ) . '<span class="count">' . buddyboss_theme()->learndash_helper()->get_my_courses_count() . '</span>';
                            }
                            
                            $navs = apply_filters(  'BuddyBossTheme/Learndash/Archive/Navs', $navs );
                            
                            if ( !empty( $navs ) ) {
                                $current_nav = isset( $_GET['type'] ) && isset( $navs[ $_GET['type'] ] ) ? $_GET['type'] : 'all';
                                $base_url = get_post_type_archive_link( 'sfwd-courses' );
                                foreach ( $navs as $nav => $text ) {
                                    $selected_class = $nav == $current_nav ? 'selected' : '';
                                    $url = 'all' != $nav ? add_query_arg( array( 'type' => $nav ), $base_url ) : $base_url;
                                    printf( "<li id='courses-{$nav}' class='{$selected_class}'><a href='%s'>%s</a></li>", $url, $text );
                                }
                            } else {
                                $current_nav = 'all';
                            }
                            ?>
                            
                		</ul>
                    </nav>
                    
                    <input type="hidden" name="type" value="<?php echo esc_attr( $current_nav );?>" >
                    
                    <div class="ld-secondary-header">
                        <div class="bb-secondary-list-tabs flex align-items-center" id="subnav"
                             aria-label="Members directory secondary navigation" role="navigation">
                            <input type="hidden" id="course-order" name="order"
                                   value="<?php echo ! empty( $_GET['order'] ) ? $_GET['order'] : 'desc'; ?>"/>
                            <div class="sfwd-courses-filters flex push-right">
                                <div class="select-wrap">
                                    <select id="sfwd_prs-order-by" name="orderby">
                                        <?php echo buddyboss_theme()->learndash_helper()->print_sorting_options(); ?>
                            		</select>
                                </div>
                                
                                <?php if ( buddyboss_theme_get_option( 'learndash_course_index_show_categories_filter' ) ) : ?>
                                    <div class="select-wrap">
                                        <?php if ( '' !== trim( buddyboss_theme()->learndash_helper()->print_categories_options() ) ) { ?>
                                            <select id="sfwd_cats-order-by" name="filter-categories">
                                                <?php echo buddyboss_theme()->learndash_helper()->print_categories_options(); ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( buddyboss_theme_get_option( 'learndash_course_index_show_instructors_filter' ) ) : ?>
                                    <div class="select-wrap">
                                        <select id="sfwd_instructors-order-by" name="filter-instructors">
                                            <?php echo buddyboss_theme()->learndash_helper()->print_instructors_options();?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
	                        <?php
                                if ( function_exists( 'bp_get_template_part' ) ) {
	                                bp_get_template_part( 'common/filters/grid-filters' );
                                }
                            ?>
                    </div>

                    <div class="grid-view bb-grid">

                        <div id="course-dir-list" class="course-dir-list bs-dir-list">
							<?php if ( have_posts() ) { ?>
                                <ul class="bb-course-list bb-course-items list-view bb-list <?php echo 'list' != $view ? 'hide' : '';?>" aria-live="assertive"
                                    aria-relevant="all">
									<?php
									/* Start the Loop */
									while ( have_posts() ) :
										the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'learndash/ld30/template-course-item' );

									endwhile;
									?>
								</ul>

                                <ul class="bb-card-list bb-course-items grid-view bb-grid <?php echo 'grid' != $view ? 'hide' : '';?>" aria-live="assertive"
                                    aria-relevant="all">
									<?php
									/* Start the Loop */
									while ( have_posts() ) :
										the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'learndash/ld30/template-course-item' );

									endwhile;
									?>
								</ul>

								<div class="bb-lms-pagination"><?php
									global $wp_query;
									$big        = 999999999; // need an unlikely integer
									$translated = __( 'Page', 'buddyboss-theme' ); // Supply translatable string

									echo paginate_links( array(
										'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
										'format'             => '?paged=%#%',
										'current'            => max( 1, get_query_var( 'paged' ) ),
										'total'              => $wp_query->max_num_pages,
										'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
									) ); ?></div><?php
							} else { ?>
								<aside class="bp-feedback bp-template-notice ld-feedback info">
									<span class="bp-icon" aria-hidden="true"></span>
									<p><?php _e( 'Sorry, no courses were found.', 'buddyboss-theme' ); ?></p>
								</aside><?php
							} ?>
                        </div>
                    </div>
                </form>

            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar( 'learndash' ); ?>

<?php get_footer();