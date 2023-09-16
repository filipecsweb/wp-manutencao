<?php
/**
 * This file manages whether the maintenance page is going to be viewed or not.
 *
 * @since     1.0.0
 * @author    Filipe Seabra <filipecseabra@gmail.com>
 * @version   1.0.4
 */
if (! defined('ABSPATH'))
{
    exit;
}

class Wordpress_Manutencao_Public extends Wordpress_Manutencao_Settings {

    /**
     * Initialize the function that will turn front end visible just to logged in users
     */
    public function __construct()
    {
        $this->fswpma_maintenance_page();
    }

    /**
     * Displays HTML of the maintenance page for not logged in users and
     * prevents the maintenance page from appearing in the login page
     *
     * @return    Void
     */
    public function fswpma_maintenance_page()
    {
        /**
         * @var    array $settings Plugin saved options
         *
         * It is being used on html-maintenance-page.php, too
         */
        $settings = get_option($this->option_name);

        /**
         * @var    string $screen Current page URI
         */
        $screen = $_SERVER['REQUEST_URI'];

        /**
         * @var    string $user_ip User IP address
         */
        $user_ip = $_SERVER['REMOTE_ADDR'];

        if (is_user_logged_in())
        {
            return;
        } elseif (strpos($screen, 'wp-admin') !== false || strpos($screen, 'wp-login.php') !== false)
        {
            return;
        } else
        {
            $access = false;

            if (isset($settings['ips']) && ! empty($settings['ips']))
            {
                $ips = explode(',', $settings['ips']);
                $ips = array_map('trim', $ips);

                $access = in_array($user_ip, $ips) ? true : false;
            }

            if ($access)
            {
                return;
            } else
            {
                include_once 'html-maintenance-page.php';
            }
        }
    }
}

new Wordpress_Manutencao_Public();
