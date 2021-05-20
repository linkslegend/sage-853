<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

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
        </div>
        <div class="main-cont container-fluid">
          <div class="row">
            <main class="main">
              <?php include Wrapper\template_path(); ?>
              <?php include "./../../datenschutz-content.php"; ?>
            </main><!-- /.main -->
            <?php if (Setup\display_sidebar()) : ?>
            <aside class="sidebar">
              <?php include Wrapper\sidebar_path(); ?>
            </aside><!-- /.sidebar -->
          </div>
        </div>
          <?php endif; ?>
        </div>
      </div><!-- /.content -->
    </div><!-- /.wrap -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>