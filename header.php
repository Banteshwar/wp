<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    <?php
    if ( (is_home()) or (is_front_page()) ) {
    echo bloginfo('name');
    } elseif (is_404()) {
    echo '404 Not Found';
    } elseif (is_category()) {
    echo 'Category:'; wp_title('');
    } elseif (is_search()) {
    echo 'Search Results';
    } elseif ( is_day() || is_month() || is_year() ) {
    echo 'Archives:'; wp_title('');
    } else {
    echo wp_title('');
    }
    ?>
    </title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?> >
