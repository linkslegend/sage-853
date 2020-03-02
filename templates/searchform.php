<form role="search" method="get" class="search-form test" action="<?= esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Suche nach:', 'sage'); ?></label>
  <div class="input-group">
    <input id="s" data-swplive="true" type="search" aria-label="suche" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default" title="Submit Search Form"><i class="fa fa-search"></i><div class="test"><?php _e('Suche', 'sage'); ?></div></button>
    </span>
  </div>
</form>
