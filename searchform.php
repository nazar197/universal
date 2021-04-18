<form class="search-form" role="search" id="searchform" action="<?php echo home_url( '/' ) ?>" >
	<input class="search-input" type="text" placeholder="<?php _e('Search', 'universal-theme') ?>" value="<?php echo get_search_query() ?>" name="s" id="s" required/>
  <button type="submit" id="searchsubmit"></button>
</form>