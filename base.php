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
    <!--
    <section id="slider-header" class="pageimage-header">
      <div class="container-fluid">
        <div class="pageimage">
          <img src="<?php echo $image_test ?>"/>
          <h1>Fachartikel</h1>
        </div>
      </div>
    </section>
    -->

    <?php } elseif ( is_search() ) {  ?>
    <section id="slider-header" class="pageimage-header">
      <div class="container-fluid">
          <div class="pageimage">
            <img loading="lazy" src="<?php echo $image_test ?>"/>
            <h1>Suche: <?php echo get_search_query(); ?></h1>
          </div>
      </div>
    </section>

    <?php } elseif ( is_archive() ) {  ?>
    <section id="slider-header" class="pageimage-header">
      <div class="container-fluid">
          <div class="pageimage">
            <img loading="lazy" src="<?php echo $image_test ?>"/>
            <h1>Fachbegriff: <?php single_tag_title(); ?></h1>
          </div>
      </div>
    </section>

    <?php } else {  ?>
    <section id="slider-header" class="pageimage-header">
      <div class="container-fluid">
        <div class="pageimage">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail();
            } else { ?>
              <img loading="lazy" src="<?php echo $image_test ?>"/><?php
            }
            ?>
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
    </section>
    <?php } ?>

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

    <?php if ( is_page( 'chemikalienbestaendigkeit' ) ) {?>
      <!-- Start Tabelle Modal -->
      <div aria-hidden="true" role="dialog" tabindex="-1" id="skftabelle1" class="modal fade testclass">
          <div class="modal-dialog" style="max-width:100%">
              <div class="modal-content">
              <button aria-hidden="true" data-dismiss="modal" class="close contact-form-close" type="button">x</button>
              <div class="download-pdf"><!--<a target="_blank" href="http://bit.ly/skf-chemlist">PDF</a> | --><a target="_blank" href="https://www.skf.com/binaries/pub12/Images/Table%20p32-33%20w%20-%20EN_tcm_12-157943.png">Vollbildansicht</a></div>
                  <div class="modal-body">
                    <h2>Tabelle 1 - Hydraulic fluids and seal material compatibility</h2>
                    <!-- echo file_get_contents('http://www.skf.com/pages/jsp/catalogue-table.jsp?id=tcm:49-6862'); -->
                    <img loading="lazy" width="100%" alt="Hydraulic fluids and seal material compatibility" src="https://www.skf.com/binaries/pub12/Images/Table%20p32-33%20w%20-%20EN_tcm_12-157943.png">
                    <small>
                      <ul>
                        <li>1) Ethylene-propylene rubber for reference only – not common for hydraulic cylinders</li>
                        <li>2)For filled PTFE, compatibility of filler must be considered separately (e.g. bronze not recommended for water-based fluids).</li>
                        <li>3)Exposure to water-based fluids or moisture causes swelling.</li>
                        <li>4)Contact SKF</li>
                      </ul>
                    </small>
                  </div>
                </div><!-- /.modal-body -->
              </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
      </div><!-- End modal -->

      <!-- Start Tabelle 2 Modal -->
      <div aria-hidden="true" role="dialog" tabindex="-1" id="skftabelle2" class="modal fade testclass">
          <div class="modal-dialog">
              <div class="modal-content">
              <button aria-hidden="true" data-dismiss="modal" class="close contact-form-close" type="button">x</button>
              <div class="download-pdf"><a target="_blank" href="http://bit.ly/skf-dichtlipp">PDF</a></div>
                  <div class="modal-body">
                    <!-- echo file_get_contents('http://skf.com/pages/jsp/catalogue-table.jsp?id=tcm:49-6863'); -->
                  </div>
                </div><!-- /.modal-body -->
              </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
      </div><!-- End modal -->
    <?php } ?>

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>

  </body>
</html>
