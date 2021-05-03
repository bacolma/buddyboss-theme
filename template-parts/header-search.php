<div class="header-search-wrap">
	<div class="container">
		<?php
		add_filter( 'search_placeholder', 'buddyboss_search_input_placeholder_text' );
		get_search_form();
		remove_filter( 'search_placeholder', 'buddyboss_search_input_placeholder_text' );
		?>
		<a href="#" class="close-search"><i class="bb-icon-close-circle"></i></a>
	</div>
</div>