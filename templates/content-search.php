<article <?php post_class(); ?>>
  <div class="article-inner">
    <div class="image-container">
    <a class="blog-page-image normal-image" style="background-image: url('<?php the_post_thumbnail_url('thumbnail_croped'); ?>');" href="<?php the_permalink(); ?>"></a>
    <div class="tag-container" id="tag-container">
      <?php $posttags = get_the_tags();
        if ($posttags) {
          foreach($posttags as $tag) {
            echo '<div class="tags-inner"><a class="tags" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></div>';
          } } else {
            echo '';
          } ?>
      </div>
    </div>
    <div class="content-inner row">
      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
        <?php get_template_part('templates/entry-meta'); ?>
        </a>
      </header>
      <div class="entry-summary">
        <?php the_excerpt(); ?>
      </div>
        <a class="readmore" href="<?php the_permalink(); ?>">Weiterlesen...</span></a>
    </div>
  </div>
</article>