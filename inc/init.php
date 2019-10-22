<?php
/**
 * @package Super Side
 */

namespace Inc;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
		return [
			Pages\Admin::class
		];
	}
	
	
	/**
	 * Loops through the classes, initialize them, 
	 * and call the register() if it exists.
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) {
			
			$service = self::instantiate( $class );
			
			if( method_exists( $service, 'register' ) ) {
				
				$service->register();
			}
		}
	}
	
	
	/**
	 * Initialize the class
	 * @param class $class  $class from the services array
	 * @return class instance . new instance of the class
	 */
	private static function instantiate( $class ) 
	{
		$service = new $class();
		
		return $service;
	}
}



//use Inc\Activate;
//use Inc\Deactivate;
//use Inc\Admin\AdminPages;
//
//if ( !class_exists( 'SuperSide' ) ) {
//
//	class SuperSide {
//		public $plugin;
//		private $entries = array();
//		private $track;
//		private $course;
//		private $lesson;
//		private $slug;
//		private $slug_cat;
//		private $sc = array ();
//		private $sc_data = array();
//		private $sc_count = array();
//
//		public function __construct() {
//			$this->plugin = plugin_basename( __FILE__ );
//			$this->create_post_type();
//			$this->set_slug();
//			$this->set_slug_cat();
//			$this->set_track();
//			$this->set_course();
//			$this->set_lesson();
//			$this->set_count();
//			$this->set_entries();
//			$this->set_side_content();
//		}
//
//		public function register() {
//			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) ); // CSS & JS
//			
//			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) ); // Admin CSS & JS
//			
//			
//			
//			add_filter("plugin_action_links_$this->plugin" , array($this, 'settings_link') );
//		}
//		
//		public function settings_link( $links ) {
//			$settings_link = '<a href="options-general.php?page=super_side">Settings</a>';
//			array_push($links, $settings_link );
//			return $links;
//		}
//		
//		
//
//		public function create_post_type() {
//			// Create "side" custom_post_type
//			add_action( 'init', array( $this, 'custom_post_type' ) );
//		}
//		
//		function activate() {
//			Activate::activate();
//		}
//		
//		function deactivate() {
//			Deactivate::deactivate();
//		}
//
//		public function uninstall() {
//			// delete CPT
//			// delete all the plugin data from the DB
//
//		}
//
//		// Create new custom post type: Side
//		public function custom_post_type() {
//
//			$labels = array(
//				'name'                  => _x( 'Side Content', 'Post Type General Name', 'text_domain' ),
//				'singular_name'         => _x( 'Side Content', 'Post Type Singular Name', 'text_domain' ),
//				'menu_name'             => __( 'Side Content', 'text_domain' ),
//				'name_admin_bar'        => __( 'Side Content', 'text_domain' ),
//				'archives'              => __( 'Item Archives', 'text_domain' ),
//				'attributes'            => __( 'Item Attributes', 'text_domain' ),
//				'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
//				'all_items'             => __( 'All Items', 'text_domain' ),
//				'add_new_item'          => __( 'Add New Item', 'text_domain' ),
//				'add_new'               => __( 'Add New', 'text_domain' ),
//				'new_item'              => __( 'New Item', 'text_domain' ),
//				'edit_item'             => __( 'Edit Item', 'text_domain' ),
//				'update_item'           => __( 'Update Item', 'text_domain' ),
//				'view_item'             => __( 'View Item', 'text_domain' ),
//				'view_items'            => __( 'View Items', 'text_domain' ),
//				'search_items'          => __( 'Search Item', 'text_domain' ),
//				'not_found'             => __( 'Not found', 'text_domain' ),
//				'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
//				'featured_image'        => __( 'Side Image', 'text_domain' ),
//				'set_featured_image'    => __( 'Set side image', 'text_domain' ),
//				'remove_featured_image' => __( 'Remove side image', 'text_domain' ),
//				'use_featured_image'    => __( 'Use as side image', 'text_domain' ),
//				'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
//				'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
//				'items_list'            => __( 'Items list', 'text_domain' ),
//				'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
//				'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
//			);
//			$args = array(
//				'label'                 => __( 'Side Content', 'text_domain' ),
//				'description'           => __( 'Side Content', 'text_domain' ),
//				'labels'                => $labels,
//				'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
//				'hierarchical'          => false,
//				'public'                => true,
//				'show_ui'               => true,
//				'show_in_menu'          => true,
//				'menu_position'         => 20,
//				'menu_icon'             => 'dashicons-align-right',
//				'show_in_admin_bar'     => true,
//				'show_in_nav_menus'     => true,
//				'can_export'            => true,
//				'has_archive'           => false,
//				'exclude_from_search'   => true,
//				'publicly_queryable'    => true,
//				'capability_type'       => 'page',
//			);
//			register_post_type( 'side', $args );
//
//		}
//
//		public function enqueue() {
//			// enqueue all our scripts
//			wp_enqueue_style( 'sidestyles', plugins_url( '/assets/superside.css', __FILE__ ) );
//			wp_enqueue_script( 'sidestyles', plugins_url( '/assets/superside.js', __FILE__ ) );
//		}
//
//		public function admin_enqueue() {
//			// enqueue all our scripts
//			wp_enqueue_style( 'sidestyles', plugins_url( '/assets/superside_admin.css', __FILE__ ) );
//			wp_enqueue_script( 'sidestyles', plugins_url( '/assets/superside_admin.js', __FILE__ ) );
//		}
//
//		// Set & Get Slug
//		private function set_slug() {
//			$this->slug = str_replace(home_url(),'',get_permalink()); // Assign slug variables
//		}
//		private function get_slug() {
//			return $this->slug;
//		}
//
//		// Set & Get Slug Cat
//		private function set_slug_cat() {
//			$this->slug_cat = explode('/', $this->slug);
//		}
//		private function get_slug_cat(){
//			return $this->slug_cat;	
//		}
//
//
//		// Set & Get Track
//		private function set_track() {
//			if(isset($this->slug_cat[2])) {
//				$this->track = $this->slug_cat[2];
//
//				// Dash and everything after
//				if (strpos($this->track, '-') !== false) {
//					$this->track = strtolower( substr($this->track, 0, strpos($this->track, "-")) );
//
//				} // end if track (if you're in the institute)
//			}	
//		}
//		private function get_track() {
//			return $this->track;
//		}
//
//		// Set & Get Course
//		private function set_course() {
//			// Run if you're in BWI area
//			if(!empty($this->track)) {
//				if(isset($this->slug_cat[4])) {
//					$this->course = $this->slug_cat[4];
//				}
//				$this->course = strtolower( substr($this->course, 0, strpos($this->course, "-")) );
//			}
//		}
//		private function get_course() {
//			return $this->course;
//		}
//
//		// Set & Get Lesson
//		private function set_lesson() {
//			// Run if you're in BWI area
//			if(!empty($this->track)) {
//				if(isset($this->slug_cat[6])) $this->lesson = $this->slug_cat[6];
//				$this->lesson = strtolower( substr($this->lesson, 0, strpos($this->lesson, "-")) );
//			}
//		}
//		private function get_lesson() {
//			return $this->lesson;
//		}
//
//		private function set_count() {
//			$this->sc_count['book'] = 1;
//			$this->sc_count['product'] = 1;
//			$this->sc_count['marketing material'] = 1;
//		}
//		private function get_count() {
//			return $this->sc_count;
//		}
//
//		// Set & Get Entries
//		private function set_entries() {
//
//			if(!empty($this->track)) { // if in BWI Area
//
//				// Create search criteria for form pull
//				$search_criteria = array(
//					'status' => 'active',
//					'field_filters' => array(
//					'mode' => 'any',
//					array(
//						'key'   => '7',
//						'value' => $this->track
//						),
//						array(
//						'key'   => '8',
//						'value' => $this->course
//						),
//						array(
//						'key'   => '9',
//						'value' => $this->lesson
//						)
//					)
//				);
//				$this->entries = GFAPI::get_entries( 1, $search_criteria );
//			}
//		}
//		private function get_entries() {
//			return $this->entries;
//		}
//
//		// Set & Get Side Content
//		private function set_side_content() {
//			// Run through entries and assign to variables
//			foreach( $this->entries as $value) {
//
//				$block_track = strtolower($value[7]);
//				$block_course = strtolower($value[8]);
//				$block_lesson = strtolower($value[9]);
//				$type = strtolower($value[3]);
//				$title = ucwords(strtolower($value[1]));
//				$desc = $value[2];
//				$link = $value[4];
//				$img_url = $value[6];
//				$ID = $value['id'];
//
//				// Check if there is content lesson specific  
//				if($block_track != '-' && $block_course != '-' && $block_lesson != '-' && $this->track == $block_track && $this->course == $block_course && $this->lesson == $block_lesson) {
//
//					$this->add_to_sc_data($title, $desc, $img_url, $link, $type , $ID);
//
//				}
//				// Check if there is content course specific
//				elseif($block_track != '-' && $block_course != '-' && $block_lesson == '-' && $this->track == $block_track && $this->course == $block_course) {
//
//					$this->add_to_sc_data($title, $desc, $img_url, $link, $type, $ID);  
//
//				}
//				// Check if there is content track specific
//				elseif($block_track != '-' && $block_course == '-' && $block_lesson == '-' && $this->track == $block_track) {
//
//					$this->add_to_sc_data($title, $desc, $img_url, $link, $type, $ID);
//
//				} // end elseif
//			}
//		}
//		private function get_side_content() {
//			return $this->sc_data;
//		}
//
//		// Collect all Side Content Data and store
//		private function add_to_sc_data($title, $desc, $img_url, $link, $type, $ID) {
//
//			if (!empty( $ID ) )  {
//				// Found content add to sc_data to later be sorted & rendered
//				$this->sc_data[$type][$this->sc_count[$type]]['id'] = $ID;
//				$this->sc_data[$type][$this->sc_count[$type]]['title'] = $title;
//				$this->sc_data[$type][$this->sc_count[$type]]['desc'] = $desc;
//				$this->sc_data[$type][$this->sc_count[$type]]['img_url'] = $img_url;
//				$this->sc_data[$type][$this->sc_count[$type]]['link'] = $link;
//
//				// Increment the associated type counter
//				$this->sc_count[$type] = $this->sc_count[$type] + 1;
//			}
//		}
//
//		// Render Product Side Content
//		// $this->sc_data[type], $heading
//		public function render_side_content($type, $heading, $max_ct = 4) {
//
//			if(is_array($this->sc_data[$type])){
//
//				echo "<h4>$heading</h4><hr>";
//				$ct = 1;
//				shuffle($this->sc_data[$type]); // Randomize order
//
//				// Display each type of content
//				foreach($this->sc_data[$type] as $value) {
//					if($ct <= $max_ct) {
//
//						$this->style_side_content($value['title'], $value['desc'], $value['link'], $value['img_url'], $ct, $value['id']); 
//
//						// increment counter
//						$ct++;
//					} else {
//						break;
//					}
//				}
//
//			} // end is array
//		}
//
//
//		// Style Side Content
//		private function style_side_content($title, $desc, $link, $img_url = FALSE, $count, $ID) {
//
//			// Shorten description
//			$desc = $this->trunc($desc, 20);
//
//			// if count is 1 (md display)
//			if($count == 1) {
//				$result = "<div class='card sc-card sc-card-md' style='width: 18rem;'>";
//
//				if($img_url != FALSE) {
//					$result .= "<a href='$link' target='_blank'><img src='$img_url' class='card-img-top' alt='$title'></a>";
//				}
//
//				$result .= "<div class='card-body'>
//								<a href='$link' target='_blank'><h5 class='card-title'>$title</h5></a>
//								<p class='card-text' style='font-size: 12px !important'>$desc</p>
//								<a href='$link' target='_blank' class='btn btn-primary'>View</a>";
//
//				// Edit button for admin
//				if(current_user_can('edit_others_pages')) {
//					$result .= "<a href='/wp-admin/admin.php?page=gf_entries&view=entry&id=1&lid=" . $ID . "&order=ASC&filter&paged=1&pos=0&field_id&operator&edit=1' target='_blank' class='btn btn-link'>Edit</a>";
//				}
//
//				$result .= "</div></div><hr/>"; 
//
//		   } // end count 1
//
//		   else {
//
//			   $desc = $this->trunc($desc, 12);
//			   $result = "<div class='media side-media'>";
//
//			   if($img_url != FALSE) {
//					$result .= "<a href='$link' target='_blank'><img src='$img_url' class='align-self-start mr-3' alt='$title'></a>";
//				}
//
//				$result .= "<div class='media-body'>
//								<a href='$link' target='_blank'><h5 class='mt-0'>$title</h5></a>
//								<p class='card-text' style='font-size: 12px !important'>$desc</p>";
//
//			   // Edit button for admin
//				if(current_user_can('edit_others_pages')) {
//					$result .= "<a href='/wp-admin/admin.php?page=gf_entries&view=entry&id=1&lid=" . $ID . "&order=ASC&filter&paged=1&pos=0&field_id&operator&edit=1' target='_blank' class='btn btn-link'>Edit</a>";
//				}
//
//			   $result .= "
//							</div>
//						</div><hr/>";
//		   }
//
//		   echo $result;
//		}
//
//		// Render Side Content Form
//		public function render_side_content_form() {
//			if(current_user_can('edit_others_pages')) {
//				echo '<h4>Quick Add</h4>';
//				gravity_form( 1, false, false, false, '', false );
//			}
//		}
//
//		// Truncate
//		private function trunc($phrase, $max_words) {
//		   $phrase_array = explode(' ',$phrase);
//		   if(count($phrase_array) > $max_words && $max_words > 0)
//				  $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
//			   return $phrase;
//		}
//	}
//
//	$superSide = new SuperSide;
//	$superSide->register();
//
//	// activation
//	register_activation_hook(__FILE__, array( $superSide, 'activate') );
//
//	// deactivate
//	register_deactivation_hook(__FILE__, array( $superSide, 'deactivate') );
//
//
//	function shortcode_superside () {
//		$superSide = new SuperSide;
//		$superSide->render_side_content('product', 'Supporting Product(s)');
//		$superSide->render_side_content('book', 'Suggested Reading');
//		$superSide->render_side_content('marketing material', 'Marketing Materials');
//		$superSide->render_side_content_form();
//	}
//	add_shortcode('superside', 'shortcode_superside');
//	
//}