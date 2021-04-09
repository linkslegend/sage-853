<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#2594cc">

  <link rel="dns-prefetch" href="//maps.google.com">
  <link rel="dns-prefetch" href="//googletagmanager.com">
  <link rel="dns-prefetch" href="//use.fontawesome.com">

  <link rel="icon" href="/wp-content/themes/sage-853/images/icons/favicon.ico">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="#2594cc">
  <meta name="apple-mobile-web-app-title" content="<?php get_bloginfo( 'name' ); ?>">
  
  <link rel="apple-touch-icon" href="/wp-content/themes/sage-853/images/icons/apple-touch-icon.png">

  <link rel="apple-touch-icon" sizes="152x152" href="/wp-content/themes/sage-853/images/icons/touch-icon-ipad.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/sage-853/images/icons/touch-icon-iphone-retina.png">
  <link rel="apple-touch-icon" sizes="167x167" href="/wp-content/themes/sage-853/images/icons/touch-icon-ipad-retina.png">

  <!-- iPhone X (1125px x 2436px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" href="/wp-content/themes/sage-853/images/icons/apple-launch-1125x2436.png">
  <!-- iPhone 8, 7, 6s, 6 (750px x 1334px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" href="/wp-content/themes/sage-853/images/icons/apple-launch-750x1334.png">
  <!-- iPhone 8 Plus, 7 Plus, 6s Plus, 6 Plus (1242px x 2208px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3)" href="/wp-content/themes/sage-853/images/icons/apple-launch-1242x2208.png">
  <!-- iPhone 5 (640px x 1136px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="/wp-content/themes/sage-853/images/icons/apple-launch-640x1136.png">
  <!-- iPad Mini, Air (1536px x 2048px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" href="/wp-content/themes/sage-853/images/icons/apple-launch-1536x2048.png">
  <!-- iPad Pro 10.5" (1668px x 2224px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" href="/wp-content/themes/sage-853/images/icons/apple-launch-1668x2224.png">
  <!-- iPad Pro 12.9" (2048px x 2732px) -->
  <link rel="apple-touch-startup-image" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" href="/wp-content/themes/sage-853/images/icons/apple-launch-2048x2732.png">

  <link rel="manifest" href="/wp-content/themes/sage-853/manifest.json">

  <script>
    // register service worker:
            if ('serviceWorker' in navigator) {
              window.addEventListener('load', function() {
                navigator.serviceWorker.register('/serviceworker.js').then(function(registration) {
                  // Registration was successful
                  console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                  // registration failed :(
                  console.log('ServiceWorker registration failed: ', err);
                });
              });
            }
  </script>

  <?php wp_head(); ?>

  <script defer type="text/javascript">
  if (!('IntersectionObserver' in window)) {
      var script = document.createElement("script");
      script.src = "https://raw.githubusercontent.com/w3c/IntersectionObserver/master/polyfill/intersection-observer.js";
      document.getElementsByTagName('head')[0].appendChild(script);
  }
  </script>

  <?php if (is_page ( 'Kontakt' ))  { ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDKylyJ1FlCxe7J3rf55wMKFPfUA3MR7Jg"></script>
  <?php } elseif (is_page ( 'unsere-standorte' ))  {  ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDKylyJ1FlCxe7J3rf55wMKFPfUA3MR7Jg"></script>
  <?php } ?>
  <?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['sometextarea'].''); ?>

</head>
