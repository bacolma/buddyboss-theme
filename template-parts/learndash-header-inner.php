<div class="ld-course-navigation">
    <?php
    $parent_course_data = learndash_get_setting( $post, 'course' );
    $parent_course = get_post( $parent_course_data );
    $parent_course_link = $parent_course->guid;
    $parent_course_title = $parent_course->post_title;
    ?>
    <div class="course-entry-title">
        <a title="<?php echo $parent_course_title; ?>" href="<?php echo $parent_course_link; ?>"><?php echo $parent_course_title; ?></a>    
    </div>
</div>