<?php get_template_part('templates/page', 'header'); ?>

<?php 
  //the query
  $the_query = new WP_Query(array(
    'category_name' => 'blog,blog-2'
  ));
?>

<?php if ($the_query->have_posts()) : ?>

<?php $count = 1; while ($the_query->have_posts()) : $the_query->the_post(); $count++; ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php else: ?>

<div class="alert alert-warning">
    <?php _e('Tut uns leid – hier liegt anscheinend ein Fehler vor', 'sage'); ?>
  </div>
<?php endif; ?>

<?php the_posts_navigation(); ?>
