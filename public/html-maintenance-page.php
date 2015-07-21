<?php
/**
 * This file contains html for the maintenance page
 *
 * @since 	1.0.0
 * @author 	Filipe Seabra <eu@filipecsweb.com.br>
 */
if(!defined('ABSPATH')){
	exit;
}

$settings = new Wordpress_Manutencao_Settings();

$options = get_option($settings->option);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<title><?php bloginfo('name'); ?></title>

    <style>
		<?php echo $options['css']; ?>
    </style>
</head>

<body>
	<?php echo $options['html']; ?>
</body>

</html>

<?php

exit;