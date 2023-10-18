<?php
/**
 * Container class file.
 */

namespace WpManutencao\App;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use WpManutencao\App\Common\MaintenanceMode;
use WpManutencao\App\Common\Settings;
use WpManutencao\App\Common\Utils;

/**
 * PSR11 compliant dependency injection container.
 *
 * @since 1.0.6
 */
final class Container {
	/**
	 * The underlying container.
	 *
	 * @since 1.0.6
	 *
	 * @var \League\Container\Container
	 */
	private \League\Container\Container $container;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->container = new \League\Container\Container();

		$this->container->addShared( 'maintenanceMode', MaintenanceMode::class );
		$this->container->addShared( 'settings', Settings::class );
		$this->container->addShared( 'utils', Utils::class );
	}

	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param  string $id Identifier of the entry to look for.
	 * @return mixed Entry.
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function get( string $id ) {
		return $this->container->get( $id );
	}
}