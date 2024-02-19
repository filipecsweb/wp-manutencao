<?php
/**
 * Service class for controlling the front-end side.
 */

namespace WpManutencao\App\Common;

defined( 'ABSPATH' ) || exit;

/**
 * @since   1.0.0
 * @version 1.0.6
 */
class MaintenanceMode {
	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'template_redirect', [ $this, 'fswpma_maintenance_page' ], defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : - 2147483647 );
	}

	/**
	 * Displays HTML of the maintenance page for not logged-in users and
	 * prevents the maintenance page from appearing in the login page.
	 *
	 * @since   1.0.0
	 * @version 1.0.6
	 *
	 * @return void
	 */
	public function fswpma_maintenance_page() {
		if ( empty( wpManutencao()->settings->getOption( 'activate' ) ) ) {
			return;
		}

		if (
			is_user_logged_in() ||
			false !== stripos( wp_login_url(), $_SERVER['SCRIPT_NAME'] )
		) {
			return;
		}

		if ( ! empty( wpManutencao()->settings->getOption( 'ips' ) ) ) {
			$ips = explode( ',', wpManutencao()->settings->getOption( 'ips' ) );
			$ips = array_map( 'trim', $ips );
			if ( in_array( wpManutencao()->utils->getTheUserIp(), $ips, true ) ) {
				return;
			}
		}

		// At this point all conditions are met.
		nocache_headers();

		if ( 'redirect' === wpManutencao()->settings->getOption( 'maintenance_type' ) ) {
			wp_redirect( wpManutencao()->settings->getOption( 'redirect_url' ), 302, WP_MANUTENCAO_SLUG );

			exit;
		}

		if ( 'page' === wpManutencao()->settings->getOption( 'maintenance_type' ) ) {
			wpManutencao()->utils->loadTemplate( 'maintenance-page', wpManutencao()->settings->getOptions() );

			exit;
		}

		wp_die( __( 'Escolha um modo de manutenção.', 'wp-manutencao' ) );
	}
}