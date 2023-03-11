<?php
/* Custom search form */
?>
<div class="search-container">
<form class="search" role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="input-group mb-3">
  <input type="text"
  value="<?php echo get_search_query() ?>" name="s"
  title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />

  <button type="submit" class="btn btn-primary">Zoeken</button>
</form>
</div>