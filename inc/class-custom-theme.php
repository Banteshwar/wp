<?php
/**
 * The file that defines the core theme class
 *
 * @link       http://www.thehtmlcoder.com
 * @since      1.0.0
 *
 * @package    wpt_custom_theme
 * @author     Vineet Verma <vineet@thehtmlcoder.com>
 */
class THC_Custom_Theme{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wpt_Custom_Theme_Loader    $loader    Maintains and registers all hooks for the theme.
	 */
	protected $loader;

	/**
	 * The Name of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $theme_name    The Name of this theme.
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
	 * Define the core functionality of the theme.
	 *
	 * Set the theme name and the theme version that can be used throughout the theme.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $theme_name, $version ) {

		$this->theme_name = $theme_name;
		$this->version = $version;

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this theme.
	 *
	 * Include the following files that make up the theme:
	 *
	 * - Wpt_Ultimate_Crm_Loader. Orchestrates the hooks of the theme.
	 * - Wpt_Ultimate_Crm_i18n. Defines internationalization functionality.
	 * - Wpt_Ultimate_Crm_Admin. Defines all hooks for the admin area.
	 * - Wpt_Ultimate_Crm_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core theme.
		 */
		require_once 'class-custom-theme-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the public area.
		 */
		require_once 'public/class-theme-public.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once 'admin/class-theme-admin.php';


		$this->loader = new Wpt_Custom_Theme_Loader();

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		//$theme_admin = new Wpt_Custom_Theme_Admin( $this->get_theme_name(), $this->get_version() );

		//$this->loader->add_action( 'admin_enqueue_scripts', $theme_admin, 'enqueue_styles' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$theme_public = new THC_Public( $this->get_theme_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $theme_public, 'theme_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $theme_public, 'theme_scripts' );
		$this->loader->add_action( 'wp_head', $theme_public, 'theme_head' );
		$this->loader->add_action( 'after_setup_theme', $theme_public, 'theme_setup' );
		$this->loader->add_filter( 'wp_resource_hints', $theme_public, 'thc_resource_hints', 10, 2 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the theme.
	 */
	public function get_theme_name() {
		return $this->theme_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the theme.
	 *
	 * @since     1.0.0
	 * @return    Wpt_Ultimate_Crm_Loader    Orchestrates the hooks of the theme.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the theme.
	 */
	public function get_version() {
		return $this->version;
	}

}

?>