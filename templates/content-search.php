<article <?php post_class(); ?>>
  <a href="<?php the_permalink(); ?>">
    <div class="blog-page-image" style="background-image: url('<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail_croped');} ?>');"></div>
  </a>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
    <?php get_template_part('templates/entry-meta'); ?>
    </a>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
    <a class="readmore" href="<?php the_permalink(); ?>">Weiterlesen...</span></a>
  </div>
</article>
