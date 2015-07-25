<?php
/**
 * This file contains html for the maintenance page
 *
 * @since 	1.0.0
 * @author 	Filipe Seabra <eu@filipecsweb.com.br>
 * @version 1.0.1
 */
if(!defined('ABSPATH')){
	exit;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>

<?php if('page' == $settings['maintenance_type']): ?>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<!-- Google font -->
		<link href='//fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css' />

		<title><?php bloginfo('name'); ?></title>

	    <style>
	    	body{
	    		border: 0;
	    		margin: 0;
	    		padding: 0;
	    	}
			<?php echo $settings['css']; ?>
	    </style>
	</head>

	<body>
		<?php echo $settings['html']; ?>
		
		<script type="text/javascript">
			<?php echo $settings['js']; ?>
		</script>		
	</body>

<?php elseif('redirect' == $settings['maintenance_type']): ?>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<title><?php bloginfo('name'); ?></title>
	</head>

	<body>
		<?php header("Location: ".$settings['redirect_url']); ?>
	</body>

<?php else: ?>
<?php die(__('Escolha um modo de manuten&ccedil;&atilde;o')); ?>

<?php endif; ?>

</html>

<?php

exit;