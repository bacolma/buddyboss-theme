<?php

/**
 * bbPress Helper Functions
 *
 */

namespace BuddyBossTheme;

if ( !class_exists( '\BuddyBossTheme\BBPressHelper' ) ) {

    Class BBPressHelper {

        protected $_is_active = false;

        /**
         * Constructor
         */
        public function __construct () {
            add_action( 'bbp_init', array( $this, 'set_active' ) );

            //add_action( 'bbp_template_before_single_forum', array( $this, 'action_bbp_template_before_single_forum' ) );

	        add_action( 'bbp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	        add_action( 'bbp_enqueue_scripts', array( $this, 'localize_reply_ajax_script' ) );
	        add_action( 'bbp_ajax_reply', array( $this, 'ajax_reply' ) );
	        add_action( 'bbp_new_reply_post_extras', array( $this, 'new_reply_post_extras' ), 99 );
	        add_action( 'bbp_edit_reply_post_extras', array( $this, 'edit_reply_post_extras' ), 99 );
	        add_filter( 'bbp_get_reply_to_link', array( $this, 'reply_to_link' ), 10, 3 );

        }

        public function get_oembed_reply_content( $content ) {
            global $wp_embed;
	        // Check is ajax request
	        if ( wp_doing_ajax() && bbp_use_autoembed() && is_a( $wp_embed, 'WP_Embed' ) ) {
                add_filter( 'buddyboss_theme_get_oembed_reply_content', array( $wp_embed, 'autoembed' ), 2 );
                $content = apply_filters( 'buddyboss_theme_get_oembed_reply_content', $content );
	        }
	        return $content;
        }

        public function set_active(){
            $this->_is_active = true;
        }

        public function is_active(){
            return $this->_is_active;
        }

        // add new topic if forums sidebar is not active
        public function action_bbp_template_before_single_forum() {
            if ( ( !is_active_sidebar( 'forums' ) || bp_is_groups_component() ) && bbp_is_single_forum() && !bbp_is_forum_category() && ( bbp_current_user_can_access_create_topic_form() || bbp_current_user_can_access_anonymous_user_form() ) ) { ?>

                <div class="bbp_before_forum_new_post">
                    <a href="#new-post" data-modal-id="bbp-topic-form" class="button full btn-new-topic"><i class="bb-icon-edit-square"></i> <?php _e( 'New discussion', 'buddyboss-theme' ); ?></a>
                </div>

            <?php
            }
        }

	    public function enqueue_scripts() {
		    if ( bbp_is_single_topic() || ( function_exists( 'bp_is_group' ) && bp_is_group() ) ) {
			    $minified_js = buddyboss_theme_get_option( 'boss_minified_js' );
			    $minjs = $minified_js ? '.min' : '';
			    wp_enqueue_script( 'buddyboss-bbpress-reply-ajax', get_template_directory_uri() . '/assets/js/plugins/bbp-reply-ajax' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
		    }
	    }

	    public function localize_reply_ajax_script() {
		    if ( bbp_is_single_topic() || ( function_exists( 'bp_is_group' ) && bp_is_group() ) ) {
			    ob_start();
			    bbp_get_template_part( 'form', 'reply' );
			    $reply_form_html = ob_get_clean();
			    wp_localize_script( 'buddyboss-bbpress-reply-ajax', 'bbpReplyAjaxJS', array(
				    'bbp_ajaxurl'          => bbp_get_ajax_url(),
				    'generic_ajax_error'   => __( 'Something went wrong. Refresh your browser and try again.', 'buddyboss-theme' ),
				    'is_user_logged_in'    => is_user_logged_in(),
				    'reply_nonce'          => wp_create_nonce( 'reply-ajax_' . get_the_ID() ),
				    'topic_id'             => bbp_get_topic_id(),
				    'reply_form_html'      => $reply_form_html,
				    'threaded_reply'       => bbp_allow_threaded_replies(),
				    'threaded_reply_depth' => bbp_thread_replies_depth(),
			    ) );
		    }
	    }

	    /**
	     * Ajax handler for reply submissions
	     *
	     * This is attached to the appropriate bbPress ajax hooks, so it is fired
	     * on any bbPress ajax submissions with the 'action' parameter set to
	     * 'reply'
	     */
	    public function ajax_reply() {
		    $action = $_POST['bbp_reply_form_action'];
		    if ( 'bbp-new-reply' == $action ) {
			    bbp_new_reply_handler( $action );
		    } elseif ( 'bbp-edit-reply' == $action ) {
			    bbp_edit_reply_handler( $action );
		    }
	    }

	    /**
	     * New replies
	     *
	     * @param $reply_id
	     */
	    public function new_reply_post_extras( $reply_id ) {
		    if ( ! bbp_is_ajax() ) {
			    return;
		    }
		    $this->reply_ajax_response( $reply_id, 'new' );
	    }
	    /**
	     * Editing an existing reply
	     *
	     * @param $reply_id
	     */
	    public function edit_reply_post_extras( $reply_id ) {
		    if ( ! bbp_is_ajax() ) {
			    return;
		    }
		    $this->reply_ajax_response( $reply_id, 'edit' );
	    }

	    /**
	     * Generate an ajax response
	     *
	     * Sends the HTML for the reply along with some extra information
	     *
	     * @param $reply_id
	     * @param $type
	     */
	    private function reply_ajax_response( $reply_id, $type ) {
		    $reply_html = $this->get_reply_html( $reply_id );
		    $extra_info = array(
			    'reply_id'     => $reply_id,
			    'reply_type'   => $type,
			    'reply_parent' => (int) $_REQUEST['bbp_reply_to'],
			    'tags'         => $this->bb_get_topic_tags( (int) $_REQUEST['bbp_topic_id'] ),
		    );
		    bbp_ajax_response( true, $reply_html, -1, $extra_info );
	    }
	    /**
	     * Uses a bbPress template file to generate reply HTML
	     *
	     * @param $reply_id
	     * @return string
	     */
	    private function get_reply_html( $reply_id ) {
		    ob_start();
		    $reply_query = new \WP_Query( array( 'p' => (int) $reply_id, 'post_type' => bbp_get_reply_post_type() ) );
		    $bbp              = bbpress();
		    $bbp->reply_query = $reply_query;
		    if ( function_exists( 'bp_media_forums_embed_attachments' ) ) {
			    add_filter( 'bbp_get_reply_content', 'bp_media_forums_embed_attachments', 999, 2 );
		    }
		    if ( function_exists( 'bp_media_forums_embed_gif' ) ) {
			    add_filter( 'bbp_get_reply_content', 'bp_media_forums_embed_gif', 999, 2 );
		    }

		    add_filter( 'bbp_get_reply_content', array( $this, 'get_oembed_reply_content' ), 99, 1 );

		    // Add mentioned to be clickable
		    add_filter( 'bbp_get_reply_content', 'bbp_make_mentions_clickable' );

		    while ( bbp_replies() ) : bbp_the_reply();
			    bbp_get_template_part( 'loop', 'single-reply' );
		    endwhile;
		    $reply_html = ob_get_clean();
		    if ( function_exists( 'bp_media_forums_embed_attachments' ) ) {
			    remove_filter( 'bbp_get_reply_content', 'bp_media_forums_embed_attachments', 999, 2 );
		    }
		    if ( function_exists( 'bp_media_forums_embed_gif' ) ) {
			    remove_filter( 'bbp_get_reply_content', 'bp_media_forums_embed_gif', 999, 2 );
		    }
		    return $reply_html;
	    }

	    /**
         * Reply to link
         *
	     * @param $retval
	     * @param $r
	     * @param $args
	     */
	    public function reply_to_link( $retval, $r, $args ) {

		    // Get the reply to use it's ID and post_parent
		    $reply = bbp_get_reply( bbp_get_reply_id( (int) $r['id'] ) );

		    // Bail if no reply or user cannot reply
		    if ( empty( $reply ) || ! bbp_current_user_can_access_create_reply_form() )
			    return;

		    // Build the URI and return value
		    $uri = remove_query_arg( array( 'bbp_reply_to' ) );
		    $uri = add_query_arg( array( 'bbp_reply_to' => $reply->ID ) );
		    $uri = wp_nonce_url( $uri, 'respond_id_' . $reply->ID );
		    $uri = $uri . '#new-post';

		    // Only add onclick if replies are threaded
		    if ( bbp_thread_replies() ) {

			    // Array of classes to pass to moveForm
			    $move_form = array(
				    $r['add_below'] . '-' . $reply->ID,
				    $reply->ID,
				    $r['respond_id'],
				    $reply->post_parent
			    );

			    // Build the onclick
			    $onclick  = ' onclick="return addReply.moveForm(\'' . implode( "','", $move_form ) . '\');"';

			    // No onclick if replies are not threaded
		    } else {
			    $onclick  = '';
		    }

		    $modal = 'data-modal-id-inline="new-reply-'.$reply->post_parent.'"';

		    // Add $uri to the array, to be passed through the filter
		    $r['uri'] = $uri;
		    $retval   = $r['link_before'] . '<a href="' . esc_url( $r['uri'] ) . '" class="bbp-reply-to-link"' . $modal . $onclick . '>' . esc_html( $r['reply_text'] ) . '</a>' . $r['link_after'];

		    return $retval;
        }

	    public function bb_get_topic_tags( $topic_id )  {

		    $new_terms = array();

		    // Topic exists
		    if ( !empty( $topic_id ) ) {

			    // Topic is spammed so display pre-spam terms
			    if ( bbp_is_topic_spam( $topic_id ) ) {
				    $new_terms = get_post_meta( $topic_id, '_bbp_spam_topic_tags', true );

				    // Topic is not spam so get real terms
			    } else {
				    $terms     = array_filter( (array) get_the_terms( $topic_id, bbp_get_topic_tag_tax_id() ) );
				    $new_terms = wp_list_pluck( $terms, 'name' );
			    }
		    }

		    $html_li  = '';
		    $html     = '';
		    if ( $new_terms ) {
			    foreach ( $new_terms as $tag ) {
				    $html_li .= '<li><a href="' . bbp_get_topic_tag_link( $tag ) . '">' . $tag . '</a></li>';
			    }

                $html = '<ul> ' .rtrim( $html_li, ',' ) . '</ul>';
		    }
		    return $html;
	    }
    }
}
