<?php
/**
 * This file contains the code that displays the pager.
 * 
 * @since 2.5.4
 * 
 * @package LearnDash
 */

/**
* Available Variables:
* $pager_context	: (string) value defining context of pager output. For example 'course_lessons' would be the course template lessons listing.   
* $pager_results    : (array) query result details containing 
* $href_query_arg	: query string parameter to use. 
* $href_val_prefix  : prefix added to value. default is empty ''.
* results<pre>Array
* (
*    [paged] => 1
*    [total_items] => 30
*    [total_pages] => 2
* )
*/
?>
<?php
if ( ( isset( $pager_results ) ) && ( !empty( $pager_results ) ) ) {
	if ( !isset( $pager_context ) ) $pager_context = '';
	if ( !isset( $href_val_prefix ) ) $href_val_prefix = '';

	// Generic wrappers. These can be changes via the switch below
	$wrapper_before = '<div class="buddypress-wrap learndash-pager learndash-pager-'. $pager_context .'">';
	$wrapper_after = '</div>';

	if ( $pager_results['total_pages'] > 1 ) {
		if ( ( ! isset( $href_query_arg ) ) || ( empty( $href_query_arg ) ) ) {
			switch( $pager_context ) {
				case 'course_lessons':
					$href_query_arg = 'ld-lesson-page';
					break;

				case 'course_lesson_topics':
					$href_query_arg = 'ld-topic-page';
					break;

				case 'profile':
					$href_query_arg = 'ld-profile-page';
					break;

				case 'course_content':
					$href_query_arg = 'ld-courseinfo-lesson-page';
					break;
				
				// These are just here to show the existing different context items. 	
				case 'course_info_registered':
				case 'course_info_courses':
				case 'course_info_quizzes':
				case 'course_navigation_widget':
				case 'course_navigation_admin':
				case 'course_list':
				default:
					break;
			}
		}
		
		$pager_left_disabled = '';
		$pager_left_class = '';
		if ( $pager_results['paged'] == 1 ) {
			$pager_left_disabled = ' disabled="disabled" ';
			$pager_left_class = 'disabled';
		} 
		$prev_page_number = ( $pager_results['paged'] > 1 ) ? $pager_results['paged'] - 1 : 1;

		$pager_right_disabled = '';
		$pager_right_class = '';
		if ( $pager_results['paged'] == $pager_results['total_pages'] ) {
			$pager_right_disabled = ' disabled="disabled" ';
			$pager_right_class = 'disabled';
		}
		$next_page_number = ( $pager_results['paged'] < $pager_results['total_pages'] ) ? $pager_results['paged'] + 1 : $pager_results['total_pages'];

		echo $wrapper_before;

		$range = 2;

		$showitems = ($range * 2)+1;

		$paged = $pager_results['paged'];

		$pages = $pager_results['total_pages'];

		if(1 != $pages)
		{ ?>
		
		<div class='bp-pagination bottom'>
			<div class='bp-pagination-links bottom'>
				<p class='pag-data'>
		
				<?php
					if($paged > 1 && $showitems < $pages) echo "<a data-paged='".($paged - 1)."'>←</a>";

					for ($i=1; $i <= $pages; $i++)
					{
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
						{
							echo ($paged == $i)? "<span class='page-numbers current'>".$i."</span>":"<a data-paged='".$i."' class='inactive' >".$i."</a>";
						}
					}

					if ($paged < $pages && $showitems < $pages) echo "<a data-paged='".($paged + 1 )."'>&rarr;</a>";
				}?>

				</p>
			</div>
		</div>

		<?php
		echo $wrapper_after;

	}
}
