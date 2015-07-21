<?php
/**
 * This file contains the HTML form for the plugin
 *
 * @since 	1.0.0
 * @author 	Filipe Seabra <eu@filipecsweb.com.br>
 */
if(!defined('ABSPATH')){
	exit;
}
?>

<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	
	<?php settings_errors(); ?>

	<form action="options.php" method="post">
	<?php 
		settings_fields('fswpma_settings');
		do_settings_sections('fswpma_manutencao');

		submit_button();
	?>
	</form>
</div>