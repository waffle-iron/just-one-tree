<?php
/**
 * Sponsors CPT
 *
 * @package Just_One_Tree
 */
class JustOneTree_Sponsor {
	/**
	 * Singleton holder
	 */
	private static $__instance = null;

	/**
	 * Class variables
	 */
	private $cpt = 'sponsor';

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
	 * Add those actions to the init hook when the class is instantiated.
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'register_CPT' ) );
	}

	/**
	 * Register CPT.
	 *
	 * @action init
	 * @return null
	 */
	public function register_CPT() {
		$cpt = array(
			'labels'              => array(
				'name'                => __( 'Sponsors', 'justonetree' ),
				'singular_name'       => __( 'Sponsor', 'justonetree' ),
				'add_new'             => _x( 'Add New Sponsor', 'justonetree', 'justonetree' ),
				'add_new_item'        => __( 'Add New Sponsor', 'justonetree' ),
				'edit_item'           => __( 'Edit Sponsor', 'justonetree' ),
				'new_item'            => __( 'New Sponsor', 'justonetree' ),
				'view_item'           => __( 'View Sponsor', 'justonetree' ),
				'search_items'        => __( 'Search Sponsors', 'justonetree' ),
				'not_found'           => __( 'No sponsors found', 'justonetree' ),
				'not_found_in_trash'  => __( 'No sponsors found in Trash', 'justonetree' ),
				'parent_item_colon'   => __( 'Sponsor:', 'justonetree' ),
				'menu_name'           => __( 'Sponsors', 'justonetree' ),
			),
			'menu_icon'	      => 'dashicons-awards',
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array(
				'with_front'  => false,
				'slug'        => 'sponsors',
			),
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'editor',
				'revisions',
				'thumbnail',
			),
		);
		register_post_type( $this->cpt, $cpt );
	}
}
JustOneTree_Sponsor::get_instance();
