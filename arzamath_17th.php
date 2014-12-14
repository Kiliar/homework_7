<?php
/*
Plugin Name: arzamath_17th
Description: A simple wordpress plugin template
Version: 1.0
Author: Malevany Yaroslav
License: GPL2
*/
/*
Copyright 2012  Francis Yaconiello  (email : francis@yaconiello.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('WP_Plugin_Template'))
{
	class WP_Plugin_Template
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$WP_Plugin_Template_Settings = new WP_Plugin_Template_Settings();

			// Register custom post types
			require_once(sprintf("%s/post-types/post_type_template.php", dirname(__FILE__)));
			$Post_Type_Template = new Post_Type_Template();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_plugin_template">Настройки</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	} // END class WP_Plugin_Template
} // END if(!class_exists('WP_Plugin_Template'))

if(class_exists('WP_Plugin_Template'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('WP_Plugin_Template', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_Plugin_Template', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new WP_Plugin_Template();

}



add_action( 'wp_ajax_ajax_magic', 'ajax_magic_callback' );

function ajax_magic_callback() {
    global $wpdb;
    $ajax_post_id = $_POST["ajax_post_id"];
    foreach ( $_POST as $meta => $meta_value) {
    	if ($meta != 'ajax_post_id' && $meta != 'action' ) {
    		update_post_meta($ajax_post_id, $meta, $meta_value);
    	};
    	
    };
        echo "P-f-f-f... Magic works!";

    die(); // this is required to terminate immediately and return a proper response
}

class WP_book_Widget extends WP_Widget {
     public function __construct() {
           parent::__construct(
                 'New_wp_widget',
                 'Мой Виджет',
                 array( 'description' => __( 'Просто виджет', 'text_domain' ), )
           );
     }
     public function update( $new_instance, $old_instance ) {
           $instance = array();
           $instance['title'] = strip_tags( $new_instance['title'] );
           return $instance;
     }
     public function form( $instance ) {
?>
           <p>
                 <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
                 <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
                  name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" 
                  value="<?php echo $instance['title']; ?>" />
           </p>
<?php
     }
     public function widget( $args, $instance ) {
          include(sprintf("%s/templates/widget_template.php", dirname(__FILE__)));
     }
}
add_action( 'widgets_init', function(){
     register_widget( 'WP_book_Widget' );
});
?>