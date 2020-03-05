<header class="top-header">

<nav class="navbar navbar-expand-md" role="navigation">
  <div class="container-fluid">
    <div class="header-inner bg-grey w-100">
    <!--<ul class="small-top-menu">
      <li><a href="mailto:<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['email'].''); ?>"><?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['email'].''); ?></a></li>
    </ul>-->
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="col-md-3">
    	<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <!--<img class="standard logo" src="/wp-content/uploads/<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['logo1'].''); ?>" alt="<?php bloginfo('name'); ?>" itemprop="logo">-->
      <img class="standard logo" src="/wp-content/uploads/<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['logo1'].''); ?>" alt="<?php bloginfo('name'); ?>" itemprop="logo">
        
      </a>
      <button class="navbar-toggle collapsed hamburger" id="hamburger-1" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="line"></span>
                  <span class="line"></span>
                  <span class="line"></span>
      <span class="tcon-visuallyhidden sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
      </button>
      </div>
      <div class="col-md-9">
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div id="menu-inner" class="menu-inner">
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary_navigation',
            'depth'             => 2,
            'container'         => 'div',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker()
		) );
        ?>
        </div>
        <div class="menu-inner-bottom d-xl-none d-lg-none d-md-none">
        <a href="mailto:<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['email'].''); ?>">
          <button class="btn btn-default"><i class="fa fa-envelope" aria-hidden="true"></i>
            <div class="button-text"><?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['email'].''); ?></div>
         </button>
        </a>

        <span itemprop="telephone"><a href="tel:+49-7142-593-0">
          <button class="btn btn-default mt-3 mb-4"><i class="fa fa-phone-square" aria-hidden="true"></i>
            <div class="button-text">+49-7142-593-0</div>
         </button>
        </a></span>

          <ul>
            <li>Robert-Bosch-Straße 11</li>
            <li>74321 Bietigheim-Bissingen</li>
          </ul>
        </div>

      </div>
      </div>
    </div>
  </div>
</nav>
</header>

<!-- Call to action Top -->
<div id="myAlert" class="" data-alert="alert" >
  <div class="container-fluid">
    <div class="myAlert-inner">
      <a class="close in" id="cookie-message-close" data-dismiss="alert" href="#">&times;</a>
      <div class="alert-content">
        <?php include "/home/master/header-content.php"; ?>
      </div>
    </div>
    </div>
</div>