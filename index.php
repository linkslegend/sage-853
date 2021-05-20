<?php get_template_part('templates/page', 'header'); ?>

<?php 
  //the query
  $the_query = new WP_Query(array(
    'category_name' => 'blog,blog-2'
  ));
?>

<?php if ($the_query->have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<?php $count = 1; while ($the_query->have_posts()) : $the_query->the_post(); $count++; ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
