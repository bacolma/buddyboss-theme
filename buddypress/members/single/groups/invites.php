<?php
/**
 * BuddyPress - Members Single Group Invites
 *
 * @since 3.0.0
 * @version 3.1.0
 */
?>

<h2 class="screen-heading group-invites-screen"><?php esc_html_e( 'Group Invites', 'buddyboss-theme' ); ?></h2>

<?php bp_nouveau_group_hook( 'before', 'invites_content' ); ?>

<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_loggedin_user_id() ) ) : ?>

	<ul id="groups-list" class="invites item-list bp-list item-list groups-list" data-bp-list="groups_invites">

		<?php
		while ( bp_groups() ) :
			bp_the_group();
		?>

			<li <?php bp_group_class( array( 'item-entry' ) ); ?> data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups">
				<div class="list-wrap">

					<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
						<div class="item-avatar">
							<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( bp_nouveau_avatar_args() ); ?></a>
						</div>
					<?php endif; ?>

					<div class="item">

						<div class="item-block">

							<h2 class="list-title groups-title"><?php bp_group_link(); ?></h2>

							<p class="item-meta group-details">
	                            <?php $inviter = bp_groups_get_invited_by(); ?>
	                            <?php if ( ! empty( $inviter ) ) : ?>
	                                <?php
	                                //@todo NO HTML in text domain please
									$member = new BP_Groups_Member( bp_displayed_user_id(), bp_get_group_id() );
	                                printf( __( 'Invited by <a href="%s">%s</a> &middot; <span class="last-activity">%s</span>', 'buddyboss-theme' ), $inviter['url'], $inviter['name'], bp_core_time_since( $member->date_modified ) );
	                                ?>
	                            <?php endif; ?>
							</p>

							<p class="desc item-meta invite-message">
								<?php echo bp_groups_get_invite_messsage_for_user( bp_displayed_user_id(), bp_get_group_id() ); ?>
							</p>

						</div>

						<?php bp_nouveau_group_hook( '', 'invites_item' ); ?>

						<?php
						bp_nouveau_groups_invite_buttons(
							array(
								'container'      => 'ul',
								'button_element' => 'button',
							)
						);
						?>

					</div>


				</div>
			</li>

		<?php endwhile; ?>
	</ul>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'member-invites-none' ); ?>

<?php endif; ?>

<?php
bp_nouveau_group_hook( 'after', 'invites_content' );
