<?php
/**
 * Plugin Name: WordPress Manutenção
 * Plugin Uri: https://wordpress.org/plugins/wp-manutencao/
 * Description: Coloque seu WordPress em manutenção ou redirecione-o para uma URL. Apenas administradores logados verão o site. É possível liberar acesso a IPs
 * Version: 1.0.4
 * Author: Filipe Seabra
 * Author URI: http://seusobrinho.com.br
 * Requires at least: 4.3
 * Tested up to: 4.8
 * Text Domain: wp-manutencao
 * Domain Path: /languages/
 */

if (! defined('ABSPATH'))
{
    exit;
}

define('WP_MANUTENCAO_PATH', plugin_dir_path(__FILE__));
define('WP_MANUTENCAO_URL', plugin_dir_url(__FILE__));
define('WP_MANUTENCAO_VERSION', '1.0.4');
define('WP_MANUTENCAO_SLUG', 'wp-manutencao');

/**
 * The code that runs during plugin activation.
 * This action is documented in 'includes/wordpress-manutencao-activator.php'.
 */
function wordpress_manutencao_activate()
{
    require_once WP_MANUTENCAO_PATH . 'includes/class-wordpress-manutencao-activator.php';
    Wordpress_Manutencao_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This actions is documented in 'includes/wordpress-manutencao-deactivator.php'.
 */
function wordpress_manutencao_deactivate()
{
    require_once WP_MANUTENCAO_PATH . 'includes/class-wordpress-manutencao-deactivator.php';
    Wordpress_Manutencao_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'wordpress_manutencao_activate');
register_deactivation_hook(__FILE__, 'wordpress_manutencao_deactivate');

if (! class_exists('WP_Manutencao')):
    /**
     * The core plugin class
     *
     * @since     1.0.0
     * @author    Filipe Seabra <eu@filipcsweb.com.br>
     */
    class WP_Manutencao {

        /**
         * Instance of this class
         *
         * @var    object
         */
        protected static $instance = null;

        /**
         * @var    string $page Settings page slug
         */
        public $page = 'fswpma_manutencao';

        /**
         * Initialize plugin actions and filters
         */
        public function __construct()
        {
            /**
             * Add plugin text domain
             */
            add_action('init', array($this, 'load_plugin_text_domain'));

            /**
             * Add plugin action links
             */
            add_action('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'load_plugin_action_links'));

            /**
             * Add admin JavaScript and StyleSheet
             */
            add_action('admin_enqueue_scripts', array($this, 'enqueue_javascript_stylesheet'));

            /**
             * Load include files
             */
            $this->includes();
        }

        public static function get_instance()
        {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance)
            {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Load plugin text domain
         */
        public function load_plugin_text_domain()
        {
            load_plugin_textdomain('wp-manutencao', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }

        /**
         * Load plugin action action links
         *
         * @param    array $links
         *
         * @return    array    $links    new custom links
         */
        public function load_plugin_action_links($links)
        {
            $settings_url = admin_url('options-general.php?page=' . $this->page);

            $links[] = '<a href="' . esc_url($settings_url) . '">' . __('Settings') . '</a>';

            return $links;
        }

        /**
         * Load admin JavaScript and StyleSheet
         */
        public function enqueue_javascript_stylesheet($hook)
        {
            if ('settings_page_' . $this->page != $hook)
            {
                return;
            } else
            {
                wp_enqueue_script(WP_MANUTENCAO_SLUG . '-admin', WP_MANUTENCAO_URL . 'admin/js/wp-manutencao-admin.js', array('jquery'), WP_MANUTENCAO_VERSION, false);

                wp_enqueue_style(WP_MANUTENCAO_SLUG . '-admin', WP_MANUTENCAO_URL . 'admin/css/wp-manutencao-admin.css', false, WP_MANUTENCAO_VERSION);
            }
        }

        /**
         * Includes
         */
        private function includes()
        {
            include_once 'admin/class-wordpress-manutencao-settings.php';

            $settings = new Wordpress_Manutencao_Settings();

            $options = get_option($settings->option_name);

            if (isset($options['activate']) && $options['activate'])
            {
                include_once 'public/class-wordpress-manutencao-public.php';
            }
        }
    }
endif;

add_action('plugins_loaded', array('WP_Manutencao', 'get_instance'));