<article <?php post_class(); ?>>
<div class="left">
  <div class="blog-page-image">
    <img class="img-thumbnail img-fluid Lozad" data-src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail_croped');} ?>" src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail_croped');} ?>">
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
</article>
