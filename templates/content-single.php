<?php while (have_posts()) : the_post(); ?>
    <!-- LazyLoaded using JS -->
    <img class="img-fluid top lozad"
    data-src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('single-post-thumb');} ?>"
    src="https://d1zczzapudl1mr.cloudfront.net/preloader/loader_750x300.gif"
    >
    <!-- Loaded when JS is disabled -->
    <noscript><img class="img-fluid top" src="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('single-post-thumb');} ?>"></noscript>

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