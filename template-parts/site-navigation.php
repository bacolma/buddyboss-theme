<nav id="site-navigation" class="main-navigation" data-menu-space="120">
    <div id="primary-navbar">
    	<?php
    	wp_nav_menu( array(
    		'theme_location' => 'header-menu',
    		'menu_id'		 => 'primary-menu',
    		'container'		 => false,
    		'fallback_cb'	 => '',
    		'menu_class'	 => 'primary-menu bb-primary-overflow', )
    	);
    	?>
        <div id="navbar-collapse">
            <a class="more-button" href="#"><i class="bb-icon-menu-dots-h"></i></a>
            <ul id="navbar-extend" class="sub-menu"></ul>
        </div>
    </div>
</nav>