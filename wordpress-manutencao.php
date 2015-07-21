<?php
/**
 * Plugin Name: WordPress Manutenção
 * Plugin Uri:
 * Author: Filipe Seabra
 * Author URI: //filipecsweb.com.br/
 * Version: 1.0.0
 * Description: Adiciona opção para colocar seu site WordPress em manutenção, fora do ar, etc. A partir daí apenas administradores logados podme ver o site e desabilitar o modo de manutenção.
 * License: GPLv2 or later
 * License URI: //www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-manutencao
 * Domain Path: /languages
 */
if(!defined('ABSPATH')){
	exit;
}

define('WP_MANUTENCAO_PATH', plugin_dir_path(__FILE__));
define('WP_MANUTENCAO_URL', plugin_dir_url(__FILE__));
define('WP_MANUTENCAO_VERSION', '1.0.0');
define('PLUGIN_NAME', 'wordpress-manutencao');

/**
 * The code that runs during plugin activation.
 * This action is documented in 'includes/wordpress-manutencao-activator.php'.
 */
function wordpress_manutencao_activate(){
	require_once WP_MANUTENCAO_PATH.'includes/class-wordpress-manutencao-activator.php';
	Wordpress_Manutencao_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This actions is documented in 'includes/wordpress-manutencao-deactivator.php'.
 */
function wordpress_manutencao_deactivate(){
	require_once WP_MANUTENCAO_PATH.'includes/class-wordpress-manutencao-deactivator.php';
	Wordpress_Manutencao_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'wordpress_manutencao_activate');
register_deactivation_hook(__FILE__, 'wordpress_manutencao_deactivate');

if(!class_exists('WP_Manutencao')):
	/**
	 * The core plugin class
	 *
	 * @since 	1.0.0
	 * @author 	Filipe Seabra <eu@filipcsweb.com.br>
	 */
	class WP_Manutencao{
		/**
		 * Instance of this class
		 *
		 * @var 	object
		 */
		protected static $instance = null;

		/**
		 * Initialize plugin actions and filters
		 */
		public function __construct(){
			/**
			 * Add plugin text domain
			 */
			add_action('init', array($this, 'load_plugin_text_domain'));

			/**
			 * Add plugin action links
			 */
			add_action('plugin_action_links_'.plugin_basename(__FILE__), array($this, 'load_plugin_action_links'));	

			/**
			 * Load include files
			 */
			$this->includes();
		}

		public static function get_instance(){
			// If the single instance hasn't been set, set it now.
			if(null == self::$instance){
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Load plugin text domain
		 */
		function load_plugin_text_domain(){
			load_plugin_textdomain('wp-manutencao', false, dirname(plugin_basename(__FILE__)).'/languages/');
		}

		/**
		 * Load plugin action action links
		 *
		 * @param 	array 	$links
		 * @return 	array 	$links 	new custom links
		 */
		function load_plugin_action_links($links){
			$settings_url = admin_url('options-general.php?page=fswpma_manutencao');

			$links[] = '<a href="'.esc_url($settings_url).'">'.__('Settings').'</a>';

			return $links;
		}

		/**
		 * Includes
		 */
		private function includes(){
			include_once 'admin/class-wordpress-manutencao-settings.php';

			$settings = new Wordpress_Manutencao_Settings();

			$options = get_option($settings->option);
			
			if(isset($options['activate']) && $options['activate']){
				include_once 'public/class-wordpress-manutencao-public.php';
			}			
		}		
	}
endif;

add_action('plugins_loaded', array('WP_Manutencao', 'get_instance'));