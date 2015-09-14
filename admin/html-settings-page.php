<?php
/**
 * This file contains the HTML form for the plugin
 *
 * @since 	1.0.0
 * @author 	Filipe Seabra <eu@filipecsweb.com.br>
 * @version 1.0.3
 */
if(!defined('ABSPATH')){
	exit;
}
?>

<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	
	<form action="options.php" method="post">

		<?php settings_fields($this->option_name); ?>
        
        <h3><?php echo __('Ative o módulo e escolha seu modo de manutenção', 'wp-manutencao'); ?></h3>
        <h6 style="letter-spacing:0.1px;"><?php echo "&rarr; <u>" . __('CASO USE UM PLUGIN PARA ARMAZENAR CACHE, ENTÃO, LIMPE-O SEMPRE QUE ATIVAR OU DESATIVAR A FUNCIONALIDADE DESTE PLUGIN.', 'wp-manutencao') . "</u>"; ?></h6>
		
        <table class="form-table">			
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

	<div class="section">
        <p><?php echo __('Colabore com o desenvolvimento de plugins gratuitos fazendo uma doação:') ?></p>
        <iframe style="width:100%; max-width:100%; height:30px;" src="//filipecsweb.com.br/plugin-footer.html" frameborder="0" scrolling="no"></iframe>

        <?php echo '<a class="button-secondary" href="//filipecsweb.com.br/?p=43" target="_blank">' . __('Bugs e Sugestões', 'woocommerce-parcelas') . '</a>'; ?>
    </div>
</div>