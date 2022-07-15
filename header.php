<?php $fav_icons = get_field('fav_icons', 'options'); ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php if($fav_icons['fav_icon_png']) : ?>
<link rel="icon" href="<?php echo $fav_icons['fav_icon_png']; ?>?ver=<?php echo THEME_VERSION; ?>" type="image/png">
<?php endif; if($fav_icons['apple_touch_icon']) : ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fav_icons['apple_touch_icon']; ?>?ver=<?php echo THEME_VERSION; ?>">
<?php endif; ?>
<link rel="preload" href="<?php echo TEMPLATE_DIRECTORY_URL; ?>/assets/fonts/MontserratAlternatesRegular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="<?php echo TEMPLATE_DIRECTORY_URL; ?>/assets/fonts/MontserratAlternatesSemiBold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo TEMPLATE_DIRECTORY_URL; ?>/assets/css/styles.min.css?ver=<?php echo THEME_VERSION; ?>">
<meta name="theme-color" content="#ef5d9e">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>