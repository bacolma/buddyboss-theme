<?php 
$author_box = buddyboss_theme_get_option( 'blog_author_box' );

if ( is_single() && !is_related_posts() && is_singular('post') ) : ?>
	<div class="post-author-info">
		<div class="show-support">
			<?php if ( function_exists( 'bb_bookmarks' ) ) { ?>
				<h6><?php _e( 'Show your support', 'buddyboss-theme' ); ?></h6>
				<p><?php printf( '<span class="authors-avatar vcard table-cell">Liking shows how much you appreciated %1$s’s story.</span>', get_the_author() ); ?></p>
			<?php } ?>

			<div class="flex author-post-meta">
                <?php 
                if ( is_user_logged_in() ) { ?>
        				<?php
        				if ( function_exists( 'bb_bookmarks' ) ) {
        					echo bb_bookmarks()->action_button( array(
        						'object_id'		 => get_the_ID(),
        						'object_type'	 => 'post_' . get_post_type( get_the_ID() ),
        						'action_type'	 => 'like',
        						'wrapper_class'	 => 'bb-like-wrap',
        						'icon_class'	 => 'bb-icon-like',
        						'title_add'		 => __( 'Like this entry', 'buddyboss-theme' ),
        						'title_remove'	 => __( 'Remove like', 'buddyboss-theme' ),
        					) );
        				}
        				?>
                <?php } ?>
                <span class="pa-share-fix push-left"></span>

                <?php 
                if ( comments_open() || get_comments_number() ) { ?>
                    <a data-balloon-pos="up" data-balloon="<?php _e('Comments', 'buddyboss-theme'); ?>" href="#comments" class="push-right"><i class="bb-icon-comment"></i></a>
                <?php } ?>
                
               <?php if (is_singular('post') ) : ?>
				   <div class="author-box-share-wrap">
					   <a href="#" class="bb-share"><i class="bb-icon-share-small"></i></a>
					   <div class="bb-share-container bb-share-author-box">
						  <div class="bb-shareIcons"></div>
					   </div>
				    </div>
				<?php endif; ?>

                
				<?php
				if ( function_exists( 'bb_bookmarks' ) && is_user_logged_in() ) {
					echo bb_bookmarks()->action_button( array(
						'object_id'		 => get_the_ID(),
						'object_type'	 => 'post_' . get_post_type( get_the_ID() ),
						'action_type'	 => 'bookmark',
						'wrapper_class'	 => 'bookmark-link-container',
						'icon_class'	 => 'bb-bookmark bb-icon-bookmark-small',
						'text_template'	 => '',
						'title_add'		 => __( 'Bookmark this story to read later', 'buddyboss-theme' ),
						'title_remove'	 => __( 'Remove bookmark', 'buddyboss-theme' ),
					) );
				}
				?>
			</div>
		</div>
        <?php if ( !empty( $author_box ) ) :
		$description = get_the_author_meta( 'description' );
		$user_link = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( get_the_author_meta( 'ID' ) ) : get_author_posts_url( get_the_author_meta( 'ID' ) );
		$class = empty( $description ) ? 'align-items-center' : '';
		?>
		<div class="post-author-details <?php echo $class; ?>">
			<a href="<?php echo $user_link; ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
			</a>
			<div class="author-desc-wrap">
				<a class="post-author" href="<?php echo $user_link; ?>"><?php the_author(); ?></a>
				<?php if( !empty($description) ) { ?>
					<div class="author-desc"><?php the_author_meta( 'description' ); ?></div>
				<?php } ?>
			</div>
		</div>
        <?php endif; ?>
	</div><!--.post-author-info-->
<?php endif; ?>
