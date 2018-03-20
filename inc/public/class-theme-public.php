<?php

/**
 * The public-facing functionality of the theme.
 *
 * @link       http://www.thehtmlcoder.com
 * @since      1.0.0
 *
 * @package    thc_custom_setup
 * @author     Vineet Verma <vineet@thehtmlcoder.com>
 */
class THC_Public {

	/**
	 * The ID of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $theme_name    The ID of this theme.
	 */
	private $theme_name;

	/**
	 * The version of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this theme.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $theme_name       	The name of the theme.
	 * @param      string    $version    		The version of this theme.
	 */
	public function __construct( $theme_name, $version ) {

		$this->theme_name = $theme_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function theme_styles() {

		wp_enqueue_style( 'coral-fonts', $this->thc_fonts_url(), array(), null );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3', 'all' );
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.5.2', 'all' );
		wp_enqueue_style( 'bxslider', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css', array(), '4.2.12', 'all' );
		wp_enqueue_style( $this->theme_name.'', get_stylesheet_uri() , array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function theme_scripts() {

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.4', true );
		wp_enqueue_script( 'bxslider', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array( 'jquery' ), '4.2.12', true );
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( $this->theme_name, get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Add action to the wp_head
	 *
	 * @since    1.0.0
	 */
	public function theme_head(){

		echo '		
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		';

	}

	/**
	 * Custom Theme Setup
	 *
	 * @since    1.0.0
	 */
	public function theme_setup() {

		// Register Nav Menu
		$locations = array(
			'Primary Menu' => __( 'Theme Primary Navigation Menu', $this->theme_name ),
			'Footer Menu' => __( 'Theme Footer Navigation Menu', $this->theme_name )
		);
		register_nav_menus( $locations );

		// Adding Post Thumbnail Support
		add_theme_support( 'post-thumbnails' );
		//add_image_size( 'featured', 636, 320, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		// add_theme_support( 'post-formats', array(
		// 	'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		// ) );

	}


	public function thc_fonts_url() {

		$fonts_url = '';

		$roboto = _x( 'on', 'Roboto Font: on or off', 'thc' );

		if ( 'off' !== $roboto ) {
			$font_families = array();

			$font_families[] = 'Roboto Slab:400,700';
			$font_families[] = 'Roboto:400,500,700';

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}

	function thc_resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}

	function hook_me(){

	}

	

}
