<?php
/**
 * Plugin settings page HTML.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="wrap wp-manutencao">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <h2 class="nav-tab-wrapper">
        <a href="#general-tab" class="nav-tab nav-tab-active"><?php echo __( 'Geral', 'wc-parcelas' ); ?></a>
        <a href="#troubleshooting-tab" class="nav-tab"><?php echo __( 'Solucionar problemas', 'wc-parcelas' ); ?></a>
    </h2>

    <form action="options.php" method="post">

		<?php settings_fields( $this->option_name ); ?>

        <div id="general-tab" class="section active">
            <h3><?php echo __( 'Ative o módulo e escolha seu modo de manutenção', 'wp-manutencao' ); ?></h3>
            <h6 style="letter-spacing:0.1px;"><?php echo "&rarr; <u>" . __( 'CASO USE UM PLUGIN PARA ARMAZENAR CACHE, ENTÃO, LIMPE-O SEMPRE QUE ATIVAR OU DESATIVAR A FUNCIONALIDADE DESTE PLUGIN.', 'wp-manutencao' ) . "</u>"; ?></h6>

            <table class="form-table">
				<?php do_settings_fields( $this->page, 'fswpma_basic_section' ); ?>
            </table>

            <table class="form-table page_type">
				<?php do_settings_fields( $this->page, 'fswpma_page_type_section' ); ?>
            </table>

            <table class="form-table redirect_type">
				<?php do_settings_fields( $this->page, 'fswpma_redirect_type_section' ); ?>
            </table>
        </div>

        <div id="troubleshooting-tab" class="section">
            <p>Acesse a área oficial de suporte ao plugin e poste sua mensagem lá:</p>
            <p>
                <a href="https://wordpress.org/support/plugin/wp-manutencao/" target="_blank">https://wordpress.org/support/plugin/wp-manutencao</a>
            </p>
            <hr/>
            <p>Se este plugin é útil para você, considere fazer uma doação e me ajude a mante-lo sempre atualizado:</p>
            <p>
                <a href="https://filipeseabra.me/doar/" target="_blank">CLIQUE AQUI PARA DOAR</a>
            </p>
        </div>

		<?php submit_button(); ?>

    </form>
</div>