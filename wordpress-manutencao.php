<?php
/**
 * Plugin Name: WordPress Manutenção
 * Plugin Uri: https://wordpress.org/plugins/wp-manutencao/
 * Description: Coloque seu site em manutenção ou redirecione-o para uma URL. Administradores logados podem ver o site. É possível liberar acesso a IPs.
 * Author: Filipe Seabra
 * Author URI: https://filipeseabra.me/
 * Version: 1.0.7
 * Text Domain: wp-manutencao
 * Domain Path: /languages/
 */

use WpManutencao\App\Main;

defined( 'ABSPATH' ) || exit;

try {
	if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		throw new Exception( sprintf( 'The autoload file was not found. File: "%s".', __DIR__ . '/vendor/autoload.php' ) );
	}

	require_once __DIR__ . '/vendor/autoload.php';
} catch ( Exception $e ) {
	error_log( $e->getMessage() );

	return;
}

define( 'WP_MANUTENCAO_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_MANUTENCAO_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_MANUTENCAO_BASENAME', plugin_basename( __FILE__ ) );
define( 'WP_MANUTENCAO_VERSION', '1.0.7' );
define( 'WP_MANUTENCAO_SLUG', 'wp-manutencao' );

/**
 * @since 1.0.6
 *
 * @return Main
 */
function wpManutencao(): ?Main {
	static $object = null;
	if ( ! isset( $object ) ) {
		$object = new Main();
	}

	return $object;
}

wpManutencao();