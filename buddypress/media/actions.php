<?php
/**
 * BuddyBoss - Media Actions
 *
 * @since BuddyBoss 1.0.0
 */
?>

<?php if ( bp_is_my_profile() || ( bp_is_group() && ( bp_is_group_media() && groups_can_user_manage_media( bp_loggedin_user_id(), bp_get_current_group_id() ) ) || ( bp_is_group_albums() && groups_can_user_manage_albums( bp_loggedin_user_id(), bp_get_current_group_id() ) ) ) ) : ?>

	<header class="bb-member-photos-header bb-photos-actions">
		<div class="bb-photos-meta">
			<a data-balloon="<?php _e( 'Delete', 'buddyboss-theme' ); ?>" data-balloon-pos="up" class="bb-delete" id="bb-delete-media" href="#"><i class="bb-icon-trash-small"></i></a>
			<a data-balloon="<?php _e( 'Select All', 'buddyboss-theme' ); ?>" data-balloon-pos="up" class="bb-select" id="bb-select-deselect-all-media" href="#"><i class="bb-icon-check"></i></a>
		</div>
	</header>

<?php endif; ?>
