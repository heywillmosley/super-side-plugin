<?php
/**
 * @package Super Side
 */

namespace Inc\Pages;

class Admin
{	
	public function register() {
		
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) ); // Settings Menu
	}
	
	public function add_admin_pages() {
		add_menu_page('Super Side', 'Super Side', 'manage_options', 'super_side', array( $this, 'admin_index'), 'dashicons-slides', 110 );
	}

	public function admin_index() {
		require_once PLUGIN_PATH . 'templates/admin.php';
	}
}