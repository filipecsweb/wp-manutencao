<?php
/**
 * This file contains the HTML form for the plugin
 *
 * @since 	1.0.0
 * @author 	Filipe Seabra <eu@filipecsweb.com.br>
 * @version 1.0.2
 */
if(!defined('ABSPATH')){
	exit;
}
?>

<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	
	<form action="options.php" method="post">

		<?php settings_fields($this->option_name); ?>
	
		<table class="form-table">
			<h3><?php echo __('Ative o módulo e escolha seu modo de manutenção', 'wp-manutencao'); ?></h3>
			<?php do_settings_fields($this->page, 'fswpma_basic_section'); ?>
		</table>

		<table class="form-table page_type">
			<?php do_settings_fields($this->page, 'fswpma_page_type_section'); ?>
		</table>
		
		<table class="form-table redirect_type">
			<?php do_settings_fields($this->page, 'fswpma_redirect_type_section'); ?>
		</table>

		<?php submit_button(); ?>

	</form>

	<div class="fs_rodape">
		<p><?php echo __('Achou a ferramenta útil? Faça uma doação... assim você ajuda com a manutenção e criação de todos os projetos gratuitos.', 'woocommerce-parcelas'); ?></p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="QM6NM5RMLQ9L4">
			<input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Doe para FilipeCS Web">
			<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
		</form>
		<hr />
		<?php echo '<a class="button-secondary" href="//filipecsweb.com.br/?p=43" target="_blank">' . __('Bugs e Sugestões', 'woocommerce-parcelas') . '</a>'; ?>
	</div>
</div>