<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <script async src="https://use.fontawesome.com/b20ad1bea8.js"></script>
  <script type="text/javascript">
if (!('IntersectionObserver' in window)) {
    var script = document.createElement("script");
    script.src = "https://raw.githubusercontent.com/w3c/IntersectionObserver/master/polyfill/intersection-observer.js";
    document.getElementsByTagName('head')[0].appendChild(script);
}
</script>

<!-- Lozad.js -->
<script src="https://cdn.jsdelivr.net/npm/lozad"></script>
<!--tiny slider-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.helper.ie8.js"></script><![endif]-->


  <?php if (is_page ( 'Kontakt' ))  { ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDKylyJ1FlCxe7J3rf55wMKFPfUA3MR7Jg"></script>
  <?php } elseif (is_page ( 'unsere-standorte' ))  {  ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDKylyJ1FlCxe7J3rf55wMKFPfUA3MR7Jg"></script>
  <?php } ?>
  <?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['sometextarea'].''); ?>

</head>
