<?php
/**
 * Searchform template for iGuru
 *
 * @package      WordPress
 * @subpackage   iGuru
 * @since        1.0
 * @version      1.0
 */

$id = uniqid('search-form-');

?>
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" 
	  class="search-form">
	<input type="text" id="<?php echo esc_attr($id); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'iguru' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<input class="search-button" type="submit" value="<?php esc_attr_e( 'Search', 'iguru' ); ?>">
	<i class="search__icon"></i>
</form>