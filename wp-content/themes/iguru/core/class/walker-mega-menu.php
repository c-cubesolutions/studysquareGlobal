<?php

defined( 'ABSPATH' ) || exit;

/**
* iGuru Mega Menu Walker
*
*
* @class        iGuru_Mega_Menu_Waker
* @version      1.0
* @category     Class
* @author       WebGeniusLab
*/

if ( ! class_exists( 'iGuru_Mega_Menu_Waker' )){

    class iGuru_Mega_Menu_Waker extends Walker_Nav_Menu {

        public function style_helper(){
            $style = '';

            if (!empty($this->wgl_megamenu_background_image)){
                $style .= "background-image:url(".esc_attr($this->wgl_megamenu_background_image).");";
                
                if (!empty($this->wgl_megamenu_background_repeat)){
                    $style .= "background-repeat:".esc_attr($this->wgl_megamenu_background_repeat).";";
                }
                if (!empty($this->wgl_megamenu_background_pos_x)){
                    $style .= "background-position-x:".esc_attr($this->wgl_megamenu_background_pos_x).";";
                }
                if (!empty($this->wgl_megamenu_background_pos_y)){
                    $style .= "background-position-y:".esc_attr($this->wgl_megamenu_background_pos_y).";";
                }            
            }

            if (!empty($this->wgl_megamenu_min_height)){
                $style .= "min-height:".esc_attr((int) $this->wgl_megamenu_min_height)."px;";
            }            

            if (!empty($this->wgl_megamenu_width)){
                $style .= "max-width:".esc_attr((int) $this->wgl_megamenu_width)."px;";
            }            

            if (!empty($this->wgl_megamenu_padding_left)){
                $style .= "padding-left:".esc_attr((int) $this->wgl_megamenu_padding_left)."px;";
            }            
            if (!empty($this->wgl_megamenu_padding_right)){
                $style .= "padding-right:".esc_attr((int) $this->wgl_megamenu_padding_right)."px;";
            }

            $style = !empty($style) ? " style='".$style."'" : "";
            return $style;
        }

        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);

            switch (true) {
                case $depth === 0 && $this->wgl_megamenu_type == 'links':
                    $output .= "$indent<ul class=\"mega-menu sub-menu sub-menu-columns\"".$this->style_helper().">";
                    break;                
                case $depth === 1 && $this->wgl_megamenu_type == 'links' :
                    $output .= "$indent<ul class=\"mega-menu sub-menu sub-menu-columns-item\">";
                    break;                
                case $depth === 0 && ( $this->wgl_megamenu_type == 'sub-posts' || $this->wgl_megamenu_type == 'sub-hor-posts' ):
                    $output .= "$indent<ul class=\"mega-menu sub-menu sub-menu mega-cat-more-links\"".$this->style_helper().">";
                    break; 
                default:
                    $output .= "$indent<ul class=\"sub-menu menu-sub-content\">";
                    break;
            }
        }


        /**
         * Ends the list of after the elements are added.
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        /**
         * Check Active Mega Menu
         * @return void
         */
        public function check_mega_menu_activate($depth){
            return $depth === 0 && !empty( $this->wgl_megamenu_type ) && $this->wgl_megamenu_type != 'disable';
        }        

        /**
        * Check Active Mega Menu Cat Filters
        * @return void
        */
        public function check_mega_menu_categories($item){
            return ( $this->wgl_megamenu_type == 'sub-posts' || $this->wgl_megamenu_type == 'sub-hor-posts' ) &&  $item->object == 'category';
        }
        /**
         * Start the element output.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {  
            $indent    = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            $class_names = $value = '';

            $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( " " , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            $a_class = $item_output = $data_attr = '';
            if ( $depth === 0 ) { 
                $array = array('type', 'columns', 'posts_count', 'min_height', 'width', 'padding_left', 'padding_right', 'hide_headings', 'background_image', 'background_repeat', 'background_pos_x', 'background_pos_y');
                foreach ($array as $key => $value) {
                    $this->{'wgl_megamenu_'.$value} = get_post_meta( $item->ID, 'wgl_megamenu_'.$value, true );
                }
            }

            if ( $this->check_mega_menu_activate($depth) ) {
                $class_names .= ' mega-menu';

                if ( $this->check_mega_menu_categories($item) ) {

                    $class_names .= ' mega-cat ';
                    if ( !empty( $item->object_id ) ) {
                        $data_attr = " data-id='".$item->object_id."'";
                        $this->wgl_megamenu_posts_count = !empty($this->wgl_megamenu_posts_count) ? $this->wgl_megamenu_posts_count : 4;
                        $data_attr .= " data-posts-count='".$this->wgl_megamenu_posts_count."'";
                    }
                    $columns     = ( !empty($this->wgl_megamenu_columns) ? $this->wgl_megamenu_columns :  1 );
                    $class_names  .= ' mega-columns-'.$columns.'col ';

                }
                elseif ( $this->wgl_megamenu_type == 'links' ) {

                    $columns     = ( !empty($this->wgl_megamenu_columns) ? $this->wgl_megamenu_columns :  1 );
                    $class_names  .= ' mega-menu-links mega-columns-'.$columns.'col ';
                }
            }

            if ( $depth === 1 && $this->wgl_megamenu_type == 'links' ) {
                if ( !empty($this->wgl_megamenu_hide_headings) ) {
                    $class_names .= ' hide-mega-headings';
                }
            }

            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr($id) . '"' : '';

			$output .= $indent.'<li'. $id.$class_names.$data_attr.'>';

			$atts = array();
			$atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
			$atts['target'] = !empty($item->target)     ? $item->target     : '';
			$atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
			$atts['href']   = !empty($item->url)        ? $item->url        : '';

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( !empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			if ( !empty($args->before) ) $item_output = $args->before;

			$item_output .= '<a'.$a_class . $attributes .'>';

			$menu_item = apply_filters( 'the_title', $item->title, $item->ID );

			$item_output .= $args->link_before . $menu_item . $args->link_after;
			$item_output .= '<i class="menu-item__plus"></i>';
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
        
        /**
         * @return array
         */
        public function get_term_link( $term, $tax = null ) {
            if ( empty($term) ) {
                return;
            }

            return get_term_link( $term, $tax );

        }

        /**
         * Ends the element output, if needed.
         */
        public function end_el( &$output, $item, $depth = 0, $args = array() ) {

            if ( $this->check_mega_menu_activate($depth) ) {

                if ( $this->check_mega_menu_categories($item) ) {

                    $class = '';
                    $has_cat = true;

                    $query_args = array(
                        'child_of'  => $item->object_id,
                    );

                    $sub_cat = get_categories( $query_args );

                    if ( count($sub_cat) == 0){
                        $has_cat  = false ;
                    }
                    $class .= $this->wgl_megamenu_type == 'sub-hor-posts' ? ' horizontal-posts' : ' vertical-posts';
                    $cat_type     = $this->wgl_megamenu_type == 'sub-hor-posts' ? ' cats-horizontal' : ' cats-vertical';

                    $output .= "<div class='mega-menu-container'".$this->style_helper().">";

                    if ((bool) $has_cat ) {
                        $output .= "<ul class='mega-menu sub-menu mega-cat-sub-categories".esc_attr($cat_type)."'>";
                        $this->wgl_megamenu_posts_count = !empty($this->wgl_megamenu_posts_count) ? $this->wgl_megamenu_posts_count : "";
                        $output .= "<li class='menu-item is-active is-uploaded' data-id='".esc_attr($item->object_id)."' data-posts-count='".esc_attr($this->wgl_megamenu_posts_count)."'><a href='# class='mega-sub-cat'>". esc_html__( 'All', 'iguru' ) ."</a></li>";
                        foreach( $sub_cat as $category ) {
                            $cat_link = $this->get_term_link( $category->term_id, 'category' );
                            $output  .= "<li class='menu-item' data-id='".$category->term_id."' data-posts-count='".esc_attr($this->wgl_megamenu_posts_count)."'><a href='".esc_url($cat_link)."' class='mega-sub-cat'>".$category->name."</a></li>";
                        }

                        $output .=  "</ul>";
                    }
                    $output .= "<div class='mega-cat-content".esc_attr($class)."'><div class='mega-ajax-content clearfix'></div></div>";
                }
                
                if ( $this->wgl_megamenu_type != 'links' ) {
                    $output .= "</div>";
                }
            }

            $output .= "</li>";
        }

    } // Walker_Nav_Menu


    /*-----------------------------------------------------------------------------------*/
    /* WebGeniusLab menu fields
    /*-----------------------------------------------------------------------------------*/
    add_action( 'wp_nav_menu_item_custom_fields', 'iguru_add_megamenu_fields', 10, 4 );
    function iguru_add_megamenu_fields( $item_id, $item, $depth, $args ) {
        
        ?>
    
        <div class="clear"></div>
        <br />
        <strong><?php esc_html_e( 'iGuru Mega Menu Settings:', 'iguru' ); ?></strong> <em><?php esc_html_e( '(Only for Main Menu)', 'iguru' ); ?></em>
        <div class="clear"></div>
        <div class='wgl_accordion_wrapper collapsible close widget_class'>
            <div class='wgl_accordion_heading'>
                <span class='wgl_accordion_title'><?php esc_html_e( 'WGL Mega Menu Settings', 'iguru' ); ?></span>
                <span class='wgl_accordion_button'></span>
            </div>
        <div class='wgl_accordion_body' style='display: none'>
            <div class="wgl-mega-menu-type">
                <p class="field-megamenu-type description description-wide">
                    <label for="edit-menu-item-megamenu-type-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Enable The Mega Menu?', 'iguru' ); ?>
                        <select id="edit-menu-item-megamenu-type-<?php echo esc_attr( $item_id ) ?>" class="widefat code edit-menu-item-megamenu-type" name="menu-item-wgl-megamenu-type[<?php echo esc_attr( $item_id ) ?>]">
                            <option value=""><?php esc_attr_e( 'Disable', 'iguru' ); ?></option>
                            <?php  if ( $item->object == 'category' ) {  ?>
                            <option value="sub-posts" <?php selected( $item->wgl_megamenu_type, 'sub-posts' ); ?>><?php esc_html_e( 'Posts - Vertical Sub-Categories Filter', 'iguru' ); ?></option>
                            <option value="sub-hor-posts" <?php selected( $item->wgl_megamenu_type, 'sub-hor-posts' ); ?>><?php esc_html_e( 'Posts - Horizontal Sub-Categories Filter', 'iguru' ); ?></option>
                            <?php } ?>
                            <option value="links" <?php selected( $item->wgl_megamenu_type, 'links' ); ?>><?php esc_html_e( 'Mega Menu Columns', 'iguru' ); ?></option>
                        </select>
                    </label>
                </p>

                <?php if ( $item->object == 'category' ) {  ?>              
                    <p class="field-megamenu-posts-count description description-wide">
                        <label for="edit-menu-item-megamenu-posts-count-<?php echo esc_attr( $item_id ) ?>">
                            <?php esc_html_e( 'Posts Count', 'iguru' ); ?>
                            <input type="text" id="edit-menu-item-megamenu-posts-count-<?php echo esc_attr( $item_id ) ?>"  class="input-sortable widefat code edit-menu-item-custom" name="menu-item-wgl-megamenu-posts-count[<?php echo esc_attr( $item_id ) ?>]" value="<?php echo esc_html($item->wgl_megamenu_posts_count); ?>">
                        </label>
                    </p>               
                <?php } ?>

                <p class="field-megamenu-columns description description-wide">
                    <label for="edit-menu-item-megamenu-columns-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Number of Mega Menu Columns', 'iguru' ); ?>
                        <select id="edit-menu-item-megamenu-columns-<?php echo esc_attr( $item_id ) ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-wgl-megamenu-columns[<?php echo esc_attr( $item_id ) ?>]">
                            <option value=""></option>
                            <option value="2" <?php selected( $item->wgl_megamenu_columns, '2' ); ?>>2</option>
                            <option value="3" <?php selected( $item->wgl_megamenu_columns, '3' ); ?>>3</option>
                            <option value="4" <?php selected( $item->wgl_megamenu_columns, '4' ); ?>>4</option>
                            <option value="5" <?php selected( $item->wgl_megamenu_columns, '5' ); ?>>5</option>
                        </select>
                    </label>
                </p>

                <p class="field-megamenu-background-image description description-wide col-6">
                    <label for="edit-menu-item-megamenu-background-image-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Background Image', 'iguru' );?>
                        <input type="text" class="iguru_media_url widefat code edit-menu-item-megamenu-background-image" name="menu-item-wgl-megamenu-background-image[<?php echo esc_attr( $item_id ) ?>]" id="edit-menu-item-megamenu-background-image-<?php echo esc_attr( $item_id ) ?>" value="<?php echo esc_attr($item->wgl_megamenu_background_image); ?>">    
                    </label>
                    <a href="#" class="button iguru_media_upload"><?php esc_html_e('Upload', 'iguru'); ?></a>
                </p>

                <p class="field-megamenu-background-repeat description description-wide col-6">
                    <label for="edit-menu-item-megamenu-background-repeat-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Background Repeat', 'iguru' ); ?>
                        <select id="edit-menu-item-megamenu-background-repeat-<?php echo esc_attr( $item_id ) ?>" class="widefat code edit-menu-item-megamenu-background-repeat" name="menu-item-wgl-megamenu-background-repeat[<?php echo esc_attr( $item_id ) ?>]">
                            <option value="no-repeat" <?php selected( $item->wgl_megamenu_background_repeat, 'no-repeat' ); ?>><?php esc_html_e( 'No Repeat', 'iguru' ); ?></option>
                            <option value="repeat" <?php selected( $item->wgl_megamenu_background_repeat, 'repeat' ); ?>><?php esc_html_e( 'Repeat', 'iguru' ); ?></option>
                            <option value="repeat-x" <?php selected( $item->wgl_megamenu_background_repeat, 'repeat-x' ); ?>><?php esc_html_e( 'Repeat X', 'iguru' ); ?></option>
                            <option value="repeat-y" <?php selected( $item->wgl_megamenu_background_repeat, 'repeat-y' ); ?>><?php esc_html_e( 'Repeat Y', 'iguru' ); ?></option>
                        </select>
                    </label>
                </p>     
                <div class="clear"></div>
                <p class="field-megamenu-background-pos-x description description-wide col-6">
                    <label for="edit-menu-item-megamenu-background-pos-x-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Background Position X', 'iguru' ); ?>
                        <select id="edit-menu-item-megamenu-background-pos-x-<?php echo esc_attr( $item_id ) ?>" class="widefat code edit-menu-item-megamenu-background-pos-x" name="menu-item-wgl-megamenu-background-pos-x[<?php echo esc_attr( $item_id ) ?>]">
                            <option value="right" <?php selected( $item->wgl_megamenu_background_pos_x, 'right' ); ?>><?php esc_html_e( 'Right', 'iguru' ); ?></option>
                            <option value="center" <?php selected( $item->wgl_megamenu_background_pos_x, 'center' ); ?>><?php esc_html_e( 'Center', 'iguru' ); ?></option>
                            <option value="left" <?php selected( $item->wgl_megamenu_background_pos_x, 'left' ); ?>><?php esc_html_e( 'Left', 'iguru' ); ?></option>
                        </select>
                    </label>
                </p>            

                <p class="field-megamenu-background-pos-y description description-wide col-6">
                    <label for="edit-menu-item-megamenu-background-pos-y-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Background Position Y', 'iguru' ); ?>
                        <select id="edit-menu-item-megamenu-background-pos-y-<?php echo esc_attr( $item_id ) ?>" class="widefat code edit-menu-item-megamenu-background-pos-y" name="menu-item-wgl-megamenu-background-pos-y[<?php echo esc_attr( $item_id ) ?>]">
                            <option value="top" <?php selected( $item->wgl_megamenu_background_pos_y, 'top' ); ?>><?php esc_html_e( 'Top', 'iguru' ); ?></option>
                            <option value="center" <?php selected( $item->wgl_megamenu_background_pos_y, 'center' ); ?>><?php esc_html_e( 'Center', 'iguru' ); ?></option>
                            <option value="bottom" <?php selected( $item->wgl_megamenu_background_pos_y, 'bottom' ); ?>><?php esc_html_e( 'Bottom', 'iguru' ); ?></option>
                        </select>
                    </label>
                </p>
                <div class="clear"></div>
                <p class="field-megamenu-min-height description description-wide col-6">
                    <label for="edit-menu-item-megamenu-min-height-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Min Height', 'iguru' ); 
                        ?>
                        <input type="text" id="edit-menu-item-megamenu-min-height-<?php echo esc_attr( $item_id ) ?>"  class="input-sortable widefat code edit-menu-item-custom" name="menu-item-wgl-megamenu-min-height[<?php echo esc_attr( $item_id ) ?>]" value="<?php echo esc_attr($item->wgl_megamenu_min_height); ?>">
                    </label>
                </p>            

                <p class="field-megamenu-width description description-wide col-6">
                    <label for="edit-menu-item-megamenu-width-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Max Width', 'iguru' ); 
                        ?>
                        <input type="text" id="edit-menu-item-megamenu-width-<?php echo esc_attr( $item_id ) ?>"  class="input-sortable widefat code edit-menu-item-custom" name="menu-item-wgl-megamenu-width[<?php echo esc_attr( $item_id ) ?>]" value="<?php echo esc_attr($item->wgl_megamenu_width); ?>">
                    </label>
                </p>           
                 <div class="clear"></div>
                 <p class="field-megamenu-padding-left description description-wide col-6">
                    <label for="edit-menu-item-megamenu-padding-left-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Padding Left', 'iguru' ); 
                        ?>
                        <input type="text" id="edit-menu-item-megamenu-padding-left-<?php echo esc_attr( $item_id ) ?>"  class="input-sortable widefat code edit-menu-item-custom" name="menu-item-wgl-megamenu-padding-left[<?php echo esc_attr( $item_id ) ?>]" value="<?php echo esc_attr($item->wgl_megamenu_padding_left); ?>">
                    </label>
                </p>            
                <p class="field-megamenu-padding-right description description-wide col-6">
                    <label for="edit-menu-item-megamenu-padding-right-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Padding Right', 'iguru' ); 
                        ?>
                        <input type="text" id="edit-menu-item-megamenu-padding-right-<?php echo esc_attr( $item_id ) ?>"  class="input-sortable widefat code edit-menu-item-custom" name="menu-item-wgl-megamenu-padding-right[<?php echo esc_attr( $item_id ) ?>]" value="<?php echo esc_attr($item->wgl_megamenu_padding_right); ?>">
                    </label>
                </p>
                <div class="clear"></div>
                <p class="field-megamenu-hide-headings description description-wide">
                    <label for="edit-menu-item-megamenu-hide-headings-<?php echo esc_attr( $item_id ) ?>">
                        <?php esc_html_e( 'Hide Mega Menu headings?', 'iguru' );?>
                        <input type="checkbox" id="edit-menu-item-megamenu-hide-headings-<?php echo esc_attr( $item_id ) ?>" class="widefat code edit-menu-item-megamenu-hide-headings" name="menu-item-wgl-megamenu-hide-headings[<?php echo esc_attr( $item_id ) ?>]" value="true" <?php checked( $item->wgl_megamenu_hide_headings, 'true' ); ?>>
                    </label>
                </p>
            </div><!-- .wgl-mega-menu-type-->
        </div>
        </div>
    <?php }


    // Save The custom Fields
    add_action('wp_update_nav_menu_item', 'iguru_custom_nav_update', 10, 3);
    function iguru_custom_nav_update( $menu_id, $item_id, $args ) {

        $fields = array(
            'menu-item-wgl-megamenu-type',
            'menu-item-wgl-megamenu-columns',
            'menu-item-wgl-megamenu-posts-count',
            'menu-item-wgl-megamenu-min-height',
            'menu-item-wgl-megamenu-width',
            'menu-item-wgl-megamenu-padding-left',
            'menu-item-wgl-megamenu-padding-right',
            'menu-item-wgl-megamenu-hide-headings',
            'menu-item-wgl-megamenu-background-image',
            'menu-item-wgl-megamenu-background-repeat',
            'menu-item-wgl-megamenu-background-pos-x',
            'menu-item-wgl-megamenu-background-pos-y',
        );

        foreach( $fields as $field ) {
            $save   = str_replace( 'menu-item-', '', $field);
            $save   = str_replace( '-', '_', $save);

            if ( !empty($_REQUEST[ $field ][ $item_id ] ) ) {
                $val = $_REQUEST[ $field ][ $item_id ];
                update_post_meta( $item_id, $save, $val );
            }
            else{
                delete_post_meta( $item_id, $save );
            }
        }

    }


    add_filter( 'wp_edit_nav_menu_walker', 'iguru_custom_nav_edit_walker',10,2 );
    function iguru_custom_nav_edit_walker($walker,$menu_id){
        return 'iGuru_Mega_Menu_Edit_Walker';
    }

    /**
     * Navigation Menu API: Walker_Nav_Menu_Edit class
     *
     * @package WordPress
     * @subpackage Administration
     * @since 4.4.0
     */

    /**
     * Create HTML list of nav menu input items.
     *
     * @since 3.0.0
     *
     * @see Walker_Nav_Menu
     */
    class iGuru_Mega_Menu_Edit_Walker extends Walker_Nav_Menu {
        /**
         * Starts the list before the elements are added.
         *
         * @see Walker_Nav_Menu::start_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {}

        /**
         * Ends the list of after the elements are added.
         *
         * @see Walker_Nav_Menu::end_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {}

        /**
         * Start the element output.
         *
         * @see Walker_Nav_Menu::start_el()
         * @since 3.0.0
         *
         * @global int $_wp_nav_menu_max_depth
         *
         * @param string $output Used to append additional content (passed by reference).
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         * @param int    $id     Not used.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $_wp_nav_menu_max_depth;
            $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

            ob_start();
            $item_id = esc_attr( $item->ID );
            $removed_args = array(
                'action',
                'customlink-tab',
                'edit-menu-item',
                'menu-item',
                'page-tab',
                '_wpnonce',
            );

            $original_title = false;
            if ( 'taxonomy' == $item->type ) {
                $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
                if ( is_wp_error( $original_title ) )
                    $original_title = false;
            } elseif ( 'post_type' == $item->type ) {
                $original_object = get_post( $item->object_id );
                $original_title = get_the_title( $original_object->ID );
            } elseif ( 'post_type_archive' == $item->type ) {
                $original_object = get_post_type_object( $item->object );
                if ( $original_object ) {
                    $original_title = $original_object->labels->archives;
                }
            }

            $classes = array(
                'menu-item menu-item-depth-' . $depth,
                'menu-item-' . esc_attr( $item->object ),
                'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
            );

            $title = $item->title;

            if ( !empty( $item->_invalid ) ) {
                $classes[] = 'menu-item-invalid';
                /* translators: %s: title of menu item which is invalid */
                $title = sprintf( esc_html__( '%s (Invalid)', 'iguru' ), $item->title );
            } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
                $classes[] = 'pending';
                /* translators: %s: title of menu item in draft status */
                $title = sprintf( esc_html__('%s (Pending)', 'iguru'), $item->title );
            }

            $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

            $submenu_text = '';
            if ( 0 == $depth )
                $submenu_text = 'style="display: none;"';

            ?>
            <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
                <div class="menu-item-bar">
                    <div class="menu-item-handle">
                        <span class="item-title">
                            <span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo !empty($submenu_text) ? $submenu_text : ''; ?>><?php esc_html_e( 'sub item', 'iguru' ); ?></span></span>
                        <span class="item-controls">
                            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                            <span class="item-order hide-if-js">
                                <a href="<?php
                                    echo esc_url(wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-up-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    ));
                                ?>" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up', 'iguru' ) ?>">&#8593;</a>
                                |
                                <a href="<?php
                                    echo esc_url(wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-down-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    ));
                                ?>" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down', 'iguru'  ) ?>">&#8595;</a>
                            </span>
                            <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" href="<?php
                                echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? esc_url(admin_url( 'nav-menus.php' )) : esc_url(add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                            ?>" aria-label="<?php esc_attr_e( 'Edit menu item', 'iguru'  ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Edit', 'iguru' ); ?></span></a>
                        </span>
                    </div>
                </div>

                <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
                    <?php if ( 'custom' == $item->type ) : ?>
                        <p class="field-url description description-wide">
                            <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                                <?php esc_html_e( 'URL', 'iguru' ); ?><br />
                                <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                            </label>
                        </p>
                    <?php endif; ?>
                    <p class="description description-wide">
                        <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Navigation Label', 'iguru' ); ?><br />
                            <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                        </label>
                    </p>
                    <p class="field-title-attribute field-attr-title description description-wide">
                        <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Title Attribute', 'iguru' ); ?><br />
                            <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                        </label>
                    </p>
                    <p class="field-link-target description">
                        <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                            <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                            <?php esc_html_e( 'Open link in a new tab', 'iguru' ); ?>
                        </label>
                    </p>
                    <p class="field-css-classes description description-thin">
                        <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'CSS Classes (optional)', 'iguru' ); ?><br />
                            <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                        </label>
                    </p>
                    <p class="field-xfn description description-thin">
                        <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Link Relationship (XFN)', 'iguru' ); ?><br />
                            <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                        </label>
                    </p>
                    <p class="field-description description description-wide">
                        <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Description', 'iguru' ); ?><br />
                            <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                            <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'iguru'); ?></span>
                        </label>
                    </p>
                    <?php
                        /*-----------------------------------------------------------------------------------*/
                        /* WebGeniusLab Mega Menu
                        /*-----------------------------------------------------------------------------------*/
                        do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
                    ?>

                    <fieldset class="field-move hide-if-no-js description description-wide">
                        <span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move', 'iguru' ); ?></span>
                        <button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'iguru' ); ?></button>
                        <button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'iguru' ); ?></button>
                        <button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
                        <button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
                        <button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'iguru' ); ?></button>
                    </fieldset>

                    <div class="menu-item-actions description-wide submitbox">
                        <?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
                            <p class="link-to-original">
                                <?php
                                $allowed_html = array(
                                    'a' => array(
                                        'href' => true,
                                    ),
                                );
                                printf( wp_kses( __('Original: %s', 'iguru'), $allowed_html ), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                            </p>
                        <?php endif; ?>
                        <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                        echo esc_url(wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'delete-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                admin_url( 'nav-menus.php' )
                            ),
                            'delete-menu_item_' . $item_id
                        )); ?>"><?php esc_html_e( 'Remove', 'iguru' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                            ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'iguru'); ?></a>
                    </div>

                    <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
                    <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                    <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                    <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                    <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                    <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
                </div><!-- .menu-item-settings-->
                <ul class="menu-item-transport"></ul>
            <?php
            $output .= ob_get_clean();
        }

    } // Walker_Nav_Menu_Edit
}