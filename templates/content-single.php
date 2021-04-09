<?php while (have_posts()) : the_post(); ?>
    <!-- LazyLoaded using JS -->
    <img loading="lazy" class="img-fluid top"
    src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('single-post-thumb');} ?>"
    >
    <article <?php post_class(); ?>>
    <header>
      <?php get_template_part('templates/entry-meta'); ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>