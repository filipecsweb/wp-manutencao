<?php
/**
 * Plugin main service class.
 */

namespace WpManutencao\App;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

defined( 'ABSPATH' ) || exit;

/**
 * Plugin main service class.
 *
 * @since   1.0.0
 * @version 1.0.6
 */
final class Main extends MainAbstract {
	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->init_container();
		$this->init_plugin();
	}

	/**
	 * @since 1.0.6
	 *
	 * @return void
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function init_container() {
		$container = new Container();

		$this->utils           = $container->get( 'utils' );
		$this->settings        = $container->get( 'settings' );
		$this->maintenanceMode = $container->get( 'maintenanceMode' );
	}

	public function init_plugin() {
		add_action( 'plugins_loaded', function () {
			add_action( 'init', [ $this, 'load_plugin_text_domain' ] );
			add_action( 'plugin_action_links_' . WP_MANUTENCAO_BASENAME, [ $this, 'load_plugin_action_links' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'load_admin_assets' ] );
		} );
	}

	/**
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_plugin_text_domain() {
		load_plugin_textdomain( 'wp-manutencao', false, dirname( WP_MANUTENCAO_BASENAME ) . '/languages' );
	}

	/**
	 * @since 1.0.0
	 *
	 * @param  array $links
	 * @return array
	 */
	public function load_plugin_action_links( $links ) {
		$settings_url = admin_url( 'options-general.php?page=' . wpManutencao()->settings->page );

		return array_merge( (array) $links, [
			'<a href="' . esc_url( $settings_url ) . '">' . __( 'Settings' ) . '</a>'
		] );
	}

	/**
	 * @since   1.0.0
	 * @version 1.0.6
	 *
	 * @param  string $hook_suffix The current admin page.
	 * @return void
	 */
	public function load_admin_assets( $hook_suffix ) {
		if ( $hook_suffix !== 'settings_page_' . wpManutencao()->settings->page ) {
			return;
		}

		wp_enqueue_script( WP_MANUTENCAO_SLUG . '-admin', WP_MANUTENCAO_URL . 'public/scripts/admin.js', [], WP_MANUTENCAO_VERSION, true );
		wp_enqueue_style( WP_MANUTENCAO_SLUG . '-admin', WP_MANUTENCAO_URL . 'public/styles/admin.css', false, WP_MANUTENCAO_VERSION );
	}
}