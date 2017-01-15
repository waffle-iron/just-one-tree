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
		add_action( 'init', array( $this, 'register_CPT' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
	}
	/**
	 * Register our custom post type and related taxonomies.
	 *
	 * @action init
	 * @return null
	 */
	public function register_CPT() {
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
				'editor',
			),
		);
		register_post_type( $this->cpt, $cpt );
	}

	public function register_taxonomies() {
		$neighborhood_labels = array(
			'name'                       => _x( 'Neighborhood', 'Taxonomy General Name', 'justonetree' ),
			'singular_name'              => _x( 'Neighborhood', 'Taxonomy Singular Name', 'justonetree' ),
			'menu_name'                  => __( 'Neighborhoods', 'justonetree' ),
			'all_items'                  => __( 'All Neighborhoods', 'justonetree' ),
			'new_item_name'              => __( 'New Neighborhood', 'justonetree' ),
			'add_new_item'               => __( 'Add New Neighborhood', 'justonetree' ),
			'edit_item'                  => __( 'Edit Neighborhood', 'justonetree' ),
			'update_item'                => __( 'Update Neighborhood', 'justonetree' ),
			'view_item'                  => __( 'View Neighborhood', 'justonetree' ),
			'separate_items_with_commas' => __( '', 'justonetree' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'justonetree' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'justonetree' ),
			'popular_items'              => __( 'Popular Neighborhoods', 'justonetree' ),
			'search_items'               => __( 'Search Neighborhoods', 'justonetree' ),
			'not_found'                  => __( 'Not Found', 'justonetree' ),
			'no_terms'                   => __( 'No items', 'justonetree' ),
			'items_list'                 => __( 'Neighborhoods list', 'justonetree' ),
			'items_list_navigation'      => __( 'Neighborhoods list navigation', 'justonetree' ),
		);
		$neighborhood_args = array(
			'labels'                     => $neighborhood_labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
		);
		register_taxonomy( 'neighborhood', array( $this->cpt ), $neighborhood_args );
	}
}
JustOneTree_Tree::get_instance();
