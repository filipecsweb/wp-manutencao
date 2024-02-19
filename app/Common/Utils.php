<?php
/**
 * Service class for utilities.
 */

namespace WpManutencao\App\Common;

defined( 'ABSPATH' ) || exit;

class Utils {
	/**
	 * @since 1.0.6
	 *
	 * @param  string $template_name Template name.
	 * @param  array  $args          Arguments.
	 * @return void
	 */
	public function loadTemplate( string $template_name, array $args = [] ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		include WP_MANUTENCAO_PATH . 'public/views/' . $template_name . '.php';
	}

	/**
	 * @since 1.0.6
	 *
	 * @return string
	 */
	public function getTheUserIp() {
		$ip = '';
		if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}

		return $ip ?: '';
	}

	/**
	 * @since 1.0.6
	 *
	 * @param  string $path Full image filename.
	 * @return string|false
	 */
	public function getBase64FromFile( $path ) {
		if ( ! file_exists( $path ) ) {
			return false;
		}

		$mimeType = mime_content_type( $path );
		if ( ! $mimeType ) {
			return false;
		}

		$base64 = base64_encode( file_get_contents( $path ) );

		return 'data:' . $mimeType . ';base64,' . $base64;
	}
}