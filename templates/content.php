<article <?php post_class(); ?>>
  <div class="row">
<div class="left">
  <div class="blog-page-image">
    <!-- LazyLoaded using JS -->
    <img class="img-thumbnail img-fluid lozad"
    src="https://d1zczzapudl1mr.cloudfront.net/preloader/loader_350x200.gif"
    data-src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail_croped');} ?>"
    >
    <!-- Loaded when JS is disabled -->
    <noscript><img class="img-fluid top" src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail_croped');} ?>"></noscript>
  </div>
</div>
  <div class="right">
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
    <?php get_template_part('templates/entry-meta'); ?>
    </a>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
    <a class="readmore" href="<?php the_permalink(); ?>">Weiterlesen...</span></a>
  </div>
</div>
</div>
</article>
