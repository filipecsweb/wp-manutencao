<?php
/**
 * This file contains html for the maintenance page.
 *
 * @since     1.0.0
 * @author    Filipe Seabra <filipecseabra@gmail.com>
 * @version   1.0.4
 */
if (! defined('ABSPATH'))
{
    exit;
}

if ('page' == $settings['maintenance_type']): ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link href='//fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <title><?php bloginfo('name'); ?></title>

    <style>
        body {
            border: 0;
            margin: 0;
            padding: 0;
        }

        <?php echo $settings['css']; ?>
    </style>
</head>
<body>
<?php echo $settings['html']; ?>

<script type="text/javascript"><?php echo $settings['js']; ?></script>
</body>
</html>
<?php elseif ('redirect' == $settings['maintenance_type']):
    header("Location: " . $settings['redirect_url']);
else:
    wp_die(__('Escolha um modo de manutenção', 'wp-manutencao'));
endif;

exit;
