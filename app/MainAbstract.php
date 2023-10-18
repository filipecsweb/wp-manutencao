<?php

namespace WpManutencao\App;

use WpManutencao\App\Common\MaintenanceMode;
use WpManutencao\App\Common\Settings;
use WpManutencao\App\Common\Utils;

defined( 'ABSPATH' ) || exit;

abstract class MainAbstract {
	/**
	 * @since 1.0.6
	 *
	 * @var null|Settings
	 */
	public ?Settings $settings = null;

	/**
	 * @since 1.0.6
	 *
	 * @var null|MaintenanceMode
	 */
	public ?MaintenanceMode $maintenanceMode = null;

	/**
	 * @since 1.0.6
	 *
	 * @var null|Utils
	 */
	public ?Utils $utils = null;
}