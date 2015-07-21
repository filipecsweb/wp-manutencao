<?php
/**
 * This file contains all code needed to build the options page of the plugin.
 * It is being loaded in core class.
 * 
 * @since 	1.0.0
 * @author 	Filipe Seabra <eu@filipecsweb.com.br>
 */
if(!defined('ABSPATH')){
	exit;
}

class Wordpress_Manutencao_Settings{
	/**
	 * @var 	string 	$option 	Option name
	 */
	public $option = 'fswpma_settings';

	/**
	 * @var 	string 	$option 	Page options slug
	 */
	public $page = 'fswpma_manutencao';

	public function __construct(){
		/**
		 * Add options menu
		 */
		add_action('admin_menu', array($this, 'fswpa_admin_menu'));

		/**
		 * Add plugin settings
		 */
		add_action('admin_init', array($this, 'fswpma_plugin_settings'));
	}

	/**
	 * Load menu under 'Settings'
	 */
	public function fswpa_admin_menu(){
		add_options_page(
			__('Site em manutenção', 'wp-manutencao'), 
			__('Manutenção', 'wp-manutencao'), 
			'edit_posts', 
			'fswpma_manutencao', 
			array($this, 'fswpma_manutencao_callback')
		);
	}

	/**
	 * Callback function that outputs settings page content
	 */
	public function fswpma_manutencao_callback(){
		include_once 'html-settings-page.php';	
	}

	public function fswpma_plugin_settings(){
		$option = $this->option; 	// Option name that keeps all saved options in an array
		$page = $this->page; 		// Chosen slug
		
		add_settings_section(
			'basic_options_section', // id
			__('Opções', 'wp-manutencao'), // title
			array($this, 'basic_options_section_callback'), // callback
			$page // page
		);

		add_settings_field(
			'activate',
			__('Ativar?', 'wp-manutencao'),
			array($this, 'radio_element_callback'),
			$page,
			'basic_options_section',
			array(
				'option_name'	=>	$option,
				'id'			=>	'activate',
				'type'			=>	'radio',
				'desc'	=>	__('Marque "Sim" para que o site seja visto apenas por administradores logados.')
			)
		);

		add_settings_field(
			'hmtl',
			__('HTML', 'wp-manutencao'),
			array($this, 'textarea_element_callback'),
			$page,
			'basic_options_section',
			array(
				'option_name'	=>	$option,
				'id'			=>	'html',
				'label_for'		=>	'html',
				'class'			=>	'large-text',
				'desc'			=>	'Insira a estrutura do conteúdo HTML que deve aparecer enquanto o site estiver em manutenção.'
			)
		);

		add_settings_field(
			'css',
			__('CSS', 'wp-manutencao'),
			array($this, 'textarea_element_callback'),
			$page,
			'basic_options_section',
			array(
				'option_name'	=>	$option,
				'id'			=>	'css',
				'label_for'		=>	'css',
				'class'			=>	'large-text',
				'desc'			=>	'Insira seu CSS personalizado para customizar seu conteúdo HTML.'
			)
		);
		
		register_setting($option, $option, array($this, 'validate_fswpma_settings'));
	}

	/**
	 * Basic options section callback
	 *
	 * @return 	void
	 */
	public function basic_options_section_callback(){

	}

	/**
	 * Radio element callback
	 *
	 * @return 	input type radio
	 */
	public function radio_element_callback($args){
		extract($args);

		$options = get_option($option_name);

		$options[$id] = isset($options[$id]) ? $options[$id] : '0';

		echo "<input id='$id-0' type='$type' name='".$option_name."[$id]' value='0'".checked('0', $options[$id], false)." /> N&atilde;o";
		echo "<br />";
		echo "<input id='$id-1' type='$type' name='".$option_name."[$id]' value='1'".checked('1', $options[$id], false)." /> Sim";
		echo $desc != '' ? "<br /><span class='description'>$desc</span>" : "";
	}

	/**
	 * Text area element callback
	 *
	 * @return 	textarea tag
	 */
	public function textarea_element_callback($args){
		extract($args);

		$options = get_option($option_name);

		$options[$id] = isset($options[$id]) ? $options[$id] : '';

		echo "<textarea id='$id' rows='15' class='$class' name='".$option_name."[$id]'>$options[$id]</textarea>";
		echo $desc != '' ?  "<br /><span class='description'>$desc</span>" : "";
	}

	/**
	 * Sanitize/validate options
	 *
	 * @return 	array 	Validated options
	 */
	public function validate_fswpma_settings($input){
		foreach($input as $k => $v){
			$newinput[$k] = trim($v);
		}
		return $newinput;
	}
}