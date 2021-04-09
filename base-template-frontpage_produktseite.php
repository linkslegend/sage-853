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
          <video controls autoplay muted preload="none" loop="true" class="video" width="1280" height="720" poster="https://d3c68j9ltgkr9d.cloudfront.net/mobile-view-header.jpg">
              <source type="video/mp4" src="https://d3izmgt6jx3fl7.cloudfront.net/skf_industrial_seals_teaser.mp4">
              <source type="video/webm" src="https://d3izmgt6jx3fl7.cloudfront.net/skf_industrial_seals_teaser.webm">
              <source type="video/ogg" src="https://d3izmgt6jx3fl7.cloudfront.net/skf_industrial_seals_teaser.ogg">
          </video>
        <div class="mobile-header">
        <img loading="lazy" title="header image" alt="header image" src="https://d3c68j9ltgkr9d.cloudfront.net/mobile-view-header.jpg"/>
        </div>
      </div>

    	</div>
    </section>

    <div class="wrap container-fluid" role="document">
      <div class="content row">
        <div class="searchbox container-fluid"> <!-- search -->
          <div class="innersearch row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
              <form role="search" method="get" class="search-form-top" action="<?= esc_url(home_url('/')); ?>">
                  <label class="sr-only"><?php _e('Suche nach:', 'sage'); ?></label>
                        <input id="s" data-swplive="true" type="search" aria-label="suche" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
                        <button type="submit" class="search-submit btn btn-default" title="Submit Search Form"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
              <div class="contact-form-button">
                  <button class="btn btn-default Modal Popup custom-submit" href="#myModal" data-toggle="modal"><i class="fa fa-envelope-o"></i>
                  <div class="button-text">Kontakt</div></button>
                </div>
              </div>
              <div class="col-6 col-sm-3 col-md-3 col-lg-3">
              <div class="newsletter-form-button">
                    <a href="http://eepurl.com/b_IMtj" target="_blank" rel="noreferrer"><button class="btn btn-default custom-submit"><i class="fa fa-newspaper-o"></i>
                    <div class="button-text">Newsletter</div></button></a>
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
