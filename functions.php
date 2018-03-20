<?php 


	// Setup Theme Functionality
	function run_thc_theme() {

		require_once 'inc/class-custom-theme.php';
		$theme = new THC_Custom_Theme( 'jonathan', '1.0' );
		$theme->run();

	}
	run_thc_theme();

	



?>