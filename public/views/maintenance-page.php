<?php
/**
 * The maintenance page HTML.
 */

defined( 'ABSPATH' ) || exit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    <link href='//fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <title><?php bloginfo( 'name' ); ?></title>

    <style>
        body {
            border: 0;
            margin: 0;
            padding: 0;
        }

        <?php echo $css; ?>
    </style>
</head>
<body>
<?php echo $html; ?>

<script><?php echo $js; ?></script>
</body>
</html>