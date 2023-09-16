<?php
/**
 * This file contains all code needed to build the options page of the plugin.
 * It is being loaded in core class.
 *
 * @since     1.0.0
 * @author    Filipe Seabra <filipecseabra@gmail.com>
 * @version   1.0.4
 */
if (! defined('ABSPATH'))
{
    exit;
}

class Wordpress_Manutencao_Settings {

    /**
     * @var    string $option Option name
     */
    public $option_name = 'fswpma_settings';

    /**
     * @var    string $page Settings page slug
     */
    public $page = 'fswpma_manutencao';

    public function __construct()
    {
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
    public function fswpa_admin_menu()
    {
        add_options_page(
            __('WordPress Manutenção', 'wp-manutencao'),
            __('Manutenção', 'wp-manutencao'),
            'edit_posts',
            $this->page,
            array($this, 'fswpma_manutencao_callback')
        );
    }

    /**
     * Callback function that outputs settings page content
     */
    public function fswpma_manutencao_callback()
    {
        include_once 'html-settings-page.php';
    }

    public function fswpma_plugin_settings()
    {
        add_settings_field(
            'activate',
            __('Ativar?', 'wp-manutencao'),
            array($this, 'radio_element_callback'),
            $this->page,
            'fswpma_basic_section',
            array(
                'id'   => 'activate',
                'desc' => __('Marque "Sim" para ativar a página de manutenção e, sem seguida, escolha seu modo de manutenção.')
            )
        );

        add_settings_field(
            'maintenance_type',
            __('Modo de manutenção', 'wp-manutencao'),
            array($this, 'dropdown_element_callback'),
            $this->page,
            'fswpma_basic_section',
            array(
                'id'   => 'maintenance_type',
                'desc' => __('Escolha seu modo de manutenção', 'wp-manutencao')
            )
        );

        add_settings_field(
            'ips',
            __('Endereços de IP liberados', 'wp-manutencao'),
            array($this, 'textarea_element_callback'),
            $this->page,
            'fswpma_basic_section',
            array(
                'id'          => 'ips',
                'class'       => '',
                'placeholder' => '189.56.127.190, 198.45.200.190',
                'desc'        => __('Você pode inserir endereços de IP que continuarão vendo o site normalmente. SEPARE OS ENDEREÇOS por vírgula!<br />Basta deixar em branco para não utilizar essa opção.', 'wp-manutencao')
            )
        );

        add_settings_field(
            'hmtl',
            __('HTML', 'wp-manutencao'),
            array($this, 'textarea_element_callback'),
            $this->page,
            'fswpma_page_type_section',
            array(
                'id'          => 'html',
                'label_for'   => 'html',
                'class'       => 'large-text',
                'placeholder' => '',
                'desc'        => __('Insira seu conteúdo em HTML que deve aparecer enquanto o site estiver em manutenção.<br />Para voltar ao padrão salve sem conteúdo, e depois salve novamente.', 'wp-manutencao')
            )
        );

        add_settings_field(
            'css',
            __('CSS', 'wp-manutencao'),
            array($this, 'textarea_element_callback'),
            $this->page,
            'fswpma_page_type_section',
            array(
                'id'          => 'css',
                'label_for'   => 'css',
                'class'       => 'large-text',
                'placeholder' => '',
                'desc'        => __('Insira seu CSS para customizar seu conteúdo em HTML.<br />Para voltar ao padrão salve sem conteúdo, e depois salve novamente.', 'wp-manutencao')
            )
        );

        add_settings_field(
            'js',
            __('JavaScript', 'wp-manutencao'),
            array($this, 'textarea_element_callback'),
            $this->page,
            'fswpma_page_type_section',
            array(
                'id'          => 'js',
                'label_for'   => 'js',
                'class'       => 'large-text',
                'placeholder' => '',
                'desc'        => __('Você pode inserir conteúdo em JavaScript.<br />Para voltar ao padrão salve sem conteúdo, e depois salve novamente.')
            )
        );

        add_settings_field(
            'redirect_url',
            __('Digite a URL', 'wp-manutencao'),
            array($this, 'text_element_callback'),
            $this->page,
            'fswpma_redirect_type_section',
            array(
                'id'          => 'redirect_url',
                'label_for'   => 'redirect_url',
                'class'       => 'regular-text',
                'placeholder' => 'http://google.com',
                'desc'        => __('Digite a sua URL com http:// ou https://', 'wp-manutencao')
            )
        );

        register_setting($this->option_name, $this->option_name, array($this, 'validate_fswpma_settings'));
    }

    /**
     * Radio element callback
     */
    public function radio_element_callback($args)
    {
        extract($args);

        $options = get_option($this->option_name);

        $value = isset($options[$id]) ? $options[$id] : '0';

        echo "<input id='$id-0' type='radio' name='" . $this->option_name . "[$id]' value='0'" . checked('0', $value, false) . " /> N&atilde;o";
        echo "<br />";
        echo "<input id='$id-1' type='radio' name='" . $this->option_name . "[$id]' value='1'" . checked('1', $value, false) . " /> Sim";
        echo $desc != '' ? "<br /><span class='description'>$desc</span>" : "";
    }

    /**
     * Dropdown element callback
     */
    public function dropdown_element_callback($args)
    {
        extract($args);

        $options = get_option($this->option_name);

        $value = isset($options[$id]) ? $options[$id] : '0';

        echo "<select name='" . $this->option_name . "[$id]'>";
        echo "<option value='0' " . selected('0', $value, false) . ">" . __('Selecione...', 'wp-manutencao') . "</option>";
        echo "<option value='page' " . selected('page', $value, false) . ">" . __('Página de manutenção', 'wp-manutencao') . "</option>";
        echo "<option value='redirect' " . selected('redirect', $value, false) . ">" . __('Redirecionamento', 'wp-manutencao') . "</option>";
        echo "</select>";
    }

    /**
     * Text area element callback
     */
    public function textarea_element_callback($args)
    {
        extract($args);

        $options = get_option($this->option_name);

        if ('html' == $id)
        {
            if (isset($options[$id]) && $options[$id] != '')
            {
                $value = $options[$id];
            } else
            {
                $html = "
<div class='absolute'></div>				
<div class='container'>
	<div class='wrap'>
		<h1>" . __('Algumas melhorias estão sendo implementadas', 'wp-manutencao') . "</h1>
		<h4>" . __('Tome um café e volte em alguns instantes...', 'wp-manutencao') . "</h4>
		<h3>" . __('Obrigado', 'wp-manutencao') . "</h3>
	</div>
</div>
";

                $value = esc_textarea($html);
            }
        } elseif ('css' == $id)
        {
            if (isset($options[$id]) && $options[$id] != '')
            {
                $value = $options[$id];
            } else
            {
                $css = "
.absolute{
	background-image: url('" . WP_MANUTENCAO_URL . "public/images/coffe.gif');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center top;
	height: 100%;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0.2;					
}
.container{
	position: relative;
}
.wrap{
	padding: 2em;
	margin: 5em 0 0 0;
	text-align: center;
	font-family: 'Varela Round', sans-serif;
	max-width: 100%;
	line-height: normal;
}
";

                $value = esc_textarea($css);
            }
        } elseif ('js' == $id)
        {
            if (isset($options[$id]) && $options[$id] != '')
            {
                $value = $options[$id];
            } else
            {
                $js = "
jQuery(document).ready(function($) {

});
";

                $value = esc_textarea($js);
            }
        } else
        {
            $value = isset($options[$id]) ? $options[$id] : '';
        }

        echo "<textarea id='$id' rows='8' class='$class' placeholder='$placeholder' name='" . $this->option_name . "[$id]'>$value</textarea>";
        echo $desc != '' ? "<br /><span class='description'>$desc</span>" : "";
    }

    /**
     * Text element callback
     */
    public function text_element_callback($args)
    {
        extract($args);

        $options = get_option($this->option_name);

        $value = isset($options[$id]) ? $options[$id] : '';

        echo "<input id='$id' type='text' class='$class' placeholder='$placeholder' name='" . $this->option_name . "[$id]' value='$value' />";
        echo $desc != '' ? "<br /><span class='description'>$desc</span>" : "";
    }

    /**
     * Sanitize/validate options
     *
     * @return    array    Validated options
     */
    public function validate_fswpma_settings($input)
    {
        foreach ($input as $k => $v)
        {
            $newinput[$k] = trim($v);
        }

        return $newinput;
    }
}
