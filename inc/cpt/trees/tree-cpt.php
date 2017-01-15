<?php
/**
 * Lemon Trees CPT
 *
 * @package Just_One_Tree
 */
class JustOneTree_Tree {
	/**
	 * Singleton holder
	 */
	private static $__instance = null;
	/**
	 * Class variables
	 */
	private $cpt = 'tree';
	/**
	 * Instantiate the singleton
	 */
	public static function get_instance() {
		if ( ! is_a( self::$__instance, __CLASS__ ) ) {
			self::$__instance = new self;
		}
		return self::$__instance;
	}
	/**
	 *
	 */
	private function __construct() {
		// Universal
		add_action( 'init', array( $this, 'action_init' ) );
	}
	/**
	 * Register post type plus additional, related rewrite rules
	 *
	 * @action init
	 * @return null
	 */
	public function action_init() {
		$cpt = array(
			'labels'              => array(
				'name'                => __( 'Lemon Trees', 'justonetree' ),
				'singular_name'       => __( 'Lemon Tree', 'justonetree' ),
				'add_new'             => _x( 'Add New Lemon Tree', 'justonetree', 'justonetree' ),
				'add_new_item'        => __( 'Add New Lemon Tree', 'justonetree' ),
				'edit_item'           => __( 'Edit Lemon Tree', 'justonetree' ),
				'new_item'            => __( 'New Lemon Tree', 'justonetree' ),
				'view_item'           => __( 'View Lemon Tree', 'justonetree' ),
				'search_items'        => __( 'Search Lemon Trees', 'justonetree' ),
				'not_found'           => __( 'No trees found', 'justonetree' ),
				'not_found_in_trash'  => __( 'No trees found in Trash', 'justonetree' ),
				'parent_item_colon'   => __( 'Lemon Tree:', 'justonetree' ),
				'menu_name'           => __( 'Lemon Trees', 'justonetree' ),
			),
			'menu_icon'	      => 'dashicons-palmtree',
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array(
				'with_front' => false,
				'slug'       => 'trees',
			),
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'thumbnail',
				'page-attributes',
				'editor',
				'excerpt'
			),
		);
		register_post_type( $this->cpt, $cpt );
	}
}
JustOneTree_Tree::get_instance();
