<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<title><?php echo get_bloginfo('name'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	wp_head();
?>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/css/uikit.min.css" />
<!-- Own openlayer -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.0.0/css/ol.css" type="text/css">
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.0.0/build/ol.js"></script>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList"></script>
<!-- Own CSS -->
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/base/global.css" />
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/cards/cards.css" />
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/cards/crew.css" />
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/components/timeline.css" />
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/components/navigation.css" />
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/components/map.css" />
<link rel="stylesheet" href="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/styles/theme.css" />

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/js/uikit-icons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/is-in-viewport/3.0.4/isInViewport.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/is-in-viewport/3.0.4/isInViewport.js.map"></script>
<!-- Own JS -->
<script src="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/scripts/navigation.js"></script>
<script src="https://www.therapiezimmer.ch/wp-content/themes/wptheme.therapiezimmer.ch/assets/src/scripts/map.js"></script>
</head>
<body class="ct-body uk-flex uk-flex-column <?php echo join(' ', get_body_class()); ?>">