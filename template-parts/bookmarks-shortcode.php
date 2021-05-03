<?php 
$bookmarks = array();
if( function_exists( 'bb_bookmarks' ) ){
    //only blog posts that are 'bookmarked'
    $bookmarks = bb_bookmarks()->get_bookmarks( array( 'object_type' => 'post_post', 'action_type' => 'bookmark' ) );
}

if ( !empty( $bookmarks ) ) {
    
    $b_q = new WP_Query( array(
        'post__in'  => $bookmarks,
    ) );
    
    if( $b_q->have_posts() ){
        while( $b_q->have_posts() ){
            $b_q->the_post();
            ?>
    
            <article <?php post_class( 'bookmarked-post'); ?>>
                <div class="post-inner-wrap">
                    <?php if ( has_post_thumbnail( ) ) { ?>
                        <a href="<?php the_permalink( ); ?>" class="entry-media entry-img">
                            <?php echo get_the_post_thumbnail( ) ?>
                        </a>
                    <?php } ?>

                    <div class="entry-content-wrap">
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_excerpt();?>
                        </div>

                        <div class="entry-meta">
                            <div class="avatar-wrap">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
                                </a>
                            </div>
                            <div class="meta-wrap">
                                <a class="post-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                    <?php the_author(); ?>
                                </a>
                                <span class="post-date" ><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_date(); ?></a></span>
                            </div>
                            <div class="push-right flex align-items-center top-meta">
                                <?php 
                                if( function_exists( 'bb_bookmarks' ) && is_user_logged_in() ){
                                    echo bb_bookmarks()->action_button( array( 
                                        'object_id' => get_the_ID(),
                                        'object_type'	 => 'post_' . get_post_type( get_the_ID() ),
                                        'action_type' => 'bookmark',

                                        'wrapper_class' => 'bookmark-link-container',
                                        'icon_class'    => 'bb-bookmark bb-icon-bookmark-small',
                                        'text_template' => '',

                                        'title_add' => __( 'Bookmark this story to read later', 'buddyboss-theme' ),
                                        'title_remove' => __( 'Remove bookmark', 'buddyboss-theme' ),
										'tooltip_pos'   => 'left',
                                    ) );
                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article><?php
        }
    }
    
    wp_reset_postdata();
}
