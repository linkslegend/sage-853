<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

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

    <section id="slider-header">
    	<div class="bannercontainer">
<div class="video-container" id="video">
  <video class="Lozad" autoplay loop="true" width="1280" height="720" muted poster="https://img.youtube.com/vi/WywY3aiINyA/maxresdefault.jpg">
      <source type="video/mp4" src="https://d3izmgt6jx3fl7.cloudfront.net/skf_bg_video2.mp4">
      <source type="video/webm" src="https://d3izmgt6jx3fl7.cloudfront.net/skf_bg_video2.webm">
      <source type="video/ogg" src="https://d3izmgt6jx3fl7.cloudfront.net/skf_bg_video2.ogg">
    </video>
</div>

    	</div>
    </section>

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

        <main class="main-cont container-fluid">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
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
