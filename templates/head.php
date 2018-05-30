<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <script async src="https://use.fontawesome.com/b20ad1bea8.js"></script>

  <?php if (is_page ( 'Kontakt' ))  { ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDKylyJ1FlCxe7J3rf55wMKFPfUA3MR7Jg"></script>
  <?php } elseif (is_page ( 'unsere-standorte' ))  {  ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDKylyJ1FlCxe7J3rf55wMKFPfUA3MR7Jg"></script>
  <?php } ?>
  <?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['sometextarea'].''); ?>

</head>
