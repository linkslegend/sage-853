<header>
<!-- Call to action Top -->
<div id="myAlert" class="alert hidden" data-alert="alert" >
    <a class="close in" id="cookie-message-close" data-dismiss="alert" href="#">&times;</a>
    <div class="alert-content">
      <a href="https://skf.de/dichtungen">SKF Dichtungen</a> Individuelle Dichtungslösungen für optimale Systemleistung
    </div>
</div>

<nav class="navbar navbar-expand-md" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="col-md-3">
    	<a class="navbar-brand" href="#">
        <img class="standard" src="/wp-content/uploads/<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['logo1'].''); ?>" alt="<?php bloginfo('name'); ?>" itemprop="logo">
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
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary_navigation',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker()
		) );
        ?>
      </div>
    </div>
  </div>
</nav>
</header>
