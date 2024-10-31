<?php
/**
 * Plugin Name: PHP Version Plus
 * Plugin URI: https://www.thenextjump.com/
 * Description: Display PHP version and other essential PHP.ini configuration settings on your admin dashboard.
 * Version: 1.0.0
 * Author: The Next Jump
 * Author URI: https://www.thenextjump.com
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

if (!function_exists('add_filter')) exit; // additional protection if accessed directly

class PhpVersionPlus {
	/**
	 * Register Wordpress hooks.
	 *
	 * @param none
	 * @return void
	 */
	public function register_hooks() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_pvp_dashboard_widget_scripts'));
		add_action('admin_init', array($this, 'queue_pvp_dashboard_widget'));
	}

	/**
	 * Adds the dashboard widget if it should be shown.
	 *
	 * @param none
	 * @return void
	 */
	public function queue_pvp_dashboard_widget() {
		add_action('wp_dashboard_setup', array($this, 'add_pvp_dashboard_widget'));
	}

	/**
	 * Adds dashboard widget to Wordpress.
	 *
	 * @param none
	 * @return void
	 */
	public function add_pvp_dashboard_widget() {
		wp_add_dashboard_widget('tnj-pvp-dashboard-info', 'PHP Version Plus', array($this, 'display_pvp_dashboard_widget'));
	}

	/**
	 * Displays the dashboard widget.
	 *
	 * @param none
	 * @return void
	 */
	public function display_pvp_dashboard_widget() {
		echo "<p>Loading...</p>";
	}

	/**
	 * Enqueues scripts for the dashboard if the current page is the dashboard.
	 *
	 * @param none
	 * @return void
	 */
	public function enqueue_pvp_dashboard_widget_scripts() {
		$current_screen = get_current_screen();
		if ('dashboard' === $current_screen->id) {
			wp_enqueue_script('tnj_pvp_script', plugin_dir_url( __FILE__ ).'includes/js/script.js', array('jquery'));
			wp_enqueue_style('tnj_pvp_style', plugin_dir_url( __FILE__ ).'includes/css/styles.css', __FILE__ );

			wp_localize_script('tnj_pvp_script', 'pvpObj', array(
				'phpVersion' => phpversion(),
				'phpMaxExecutionTime' => esc_html(ini_get("max_execution_time")),
				'phpMaxInputTime' => esc_html(ini_get("max_input_time")),
				'phpMemoryLimit' => esc_html(ini_get("memory_limit")),
				'phpDisplayErrors' => esc_html(ini_get("display_errors")),
				'phpLogErrors' => esc_html(ini_get("log_errors")),
				'phpLogErrorsMaxLen' => esc_html(ini_get("log_errors_max_len")),
				'phpPostMaxSize' => esc_html(ini_get("post_max_size")),
				'phpUploadMaxFilesize' => esc_html(ini_get("upload_max_filesize")),
				'phpMaxFileUploads' => esc_html(ini_get("max_file_uploads")),
				'wpMediaMaxUploadLimit' => esc_html(size_format(wp_max_upload_size()))
			));
		}
	}
}

$phpVersionPlus = new PhpVersionPlus();
$phpVersionPlus->register_hooks();