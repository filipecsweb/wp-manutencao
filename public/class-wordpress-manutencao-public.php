<?php
/**
 * This file manages whether the maintenance page is going to be viwed or not
 * @since 	1.0.0
 * @author 	Filipe Seabra
 */
if(!defined('ABSPATH')){
	exit;
}

class Wordpress_Manutencao_Public{
	/**
	 * Initialize the function that will turn front end visible just to logged in users
	 */
	public function __construct(){
		$this->fswpma_maintenance_page();
	}

	/**
	 * Displays HTML of the maintenance page for not logged in users and
	 * prevents the maintenance page from appearing in the login page
	 *
	 * @return 	Void
	 */
	public function fswpma_maintenance_page(){		
		$screen = $_SERVER['REQUEST_URI'];

		if(is_user_logged_in()){
			return;
		}
		elseif(strpos($screen, 'wp-admin') || strpos($screen, 'wp-login.php')){
			return;
		}
		else{
			include_once 'html-maintenance-page.php';
		}

		return;
	}
}

new Wordpress_Manutencao_Public();