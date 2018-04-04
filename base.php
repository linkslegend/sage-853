<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!-- Script to pull images -->
<?php
  $image_test = get_post_meta($post->ID, 'banner', true);
  if ($image_test == '' ){
      $image_test = 'https://d3c68j9ltgkr9d.cloudfront.net/skf-slider-' . rand(1,19) . '.jpg';
  }else{
      $image_test = get_post_meta($post->ID, 'banner', true);
  }
  $image_text = get_post_meta($post->ID, 'image_text', true);
  if ($image_text == ''){
  	$image_text = get_the_title($ID);
  }else{
  	$image_text = get_post_meta($post->ID, 'image_text', true);
  }
?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <!-- Frontpage Slider -->
    <?php if ( is_home() || is_single() ) {?>
    <section id="slider-header" class="pageimage-header pageimage" style="background-image: url(<?php echo $image_test ?>);">
    <div class="pageimage-overlay"></div>
    <div class="container pageimage-content"><h1>Fachartikel</h1></div>
    </section>

    <?php } elseif ( is_search() ) {  ?>
    <section id="slider-header" class="pageimage-header pageimage" style="background-image: url(<?php echo $image_test ?>);">
    <div class="pageimage-overlay"></div>
    <div class="container pageimage-content"><h1>Suche: <?php echo get_search_query(); ?></h1></div>
    </section>

    <?php } elseif ( is_archive() ) {  ?>
    <section id="slider-header" class="pageimage-header pageimage" style="background-image: url(<?php echo $image_test ?>);">
    <div class="pageimage-overlay"></div>
    <div class="container pageimage-content"><h1>Fachbegriff: <?php single_tag_title(); ?></h1></div>
    </section>

    <?php } else {  ?>

      <section id="slider-header" class="pageimage-header pageimage" style="background-image: url(<?php echo $image_test ?>);">
      <div class="pageimage-overlay"></div>
      <div class="container pageimage-content"><h1><?php the_title(); ?></h1></div>
      </section>
    <?php } ?>

    <div class="wrap container-fluid" role="document">
      <div class="content row">
        <div class="searchbox container-fluid"> <!-- search -->
          <div class="innersearch row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-8">
              <form role="search" method="get" class="search-form-top" action="<?= esc_url(home_url('/')); ?>">
                  <label class="sr-only"><?php _e('Suche nach:', 'sage'); ?></label>
                        <input id="s" data-swplive="true" type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
                        <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <div class="col-6 col-sm-3 col-md-3 col-lg-2">
              <div class="contact-form-button">
                  <button class="btn btn-default Modal Popup custom-submit" href="#myModal" data-toggle="modal"><i class="fa fa-envelope-o"></i>
                  <div class="button-text">Kontakt</div></button>
                </div>
              </div>
              <div class="col-6 col-sm-3 col-md-3 col-lg-2">
              <div class="newsletter-form-button">
                    <button class="btn btn-default Modal Popup custom-submit" href="#myModal2" data-toggle="modal"><i class="fa fa-newspaper-o"></i>
                    <div class="button-text">Newsletter</div></button>
              </div>
              </div>
            </div>
          </div> <!-- /. search -->
        <div class="main-cont container-fluid">
          <div class="row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        </div>
      </div>
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
