<?php
/**
 * Custom fields for the tree CPT.
 * Requires the Fieldmanager plugin.
 * @link http://fieldmanager.org
 *
 * @package Just_One_Tree
 */

class JustOneTree_Tree_Fields {

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
	 * Add those actions to the init hook when the class is instantiated.
	 */
	private function __construct() {
		add_action( 'fm_post_tree', array( $this, 'add_tree_fields' ) );
	}

	/**
	 * Add custom fields for tree post type
	 *
	 * @action fm_post_project
	 * @return null
	 */
	public function add_tree_fields() {
		$contact_fields = new Fieldmanager_Group( array(
			'name' => 'contact_info',
			'children' => array(
				'name' => new Fieldmanager_Textfield( esc_html( 'Name', 'justonetree' ) ),
				'registration-type' => new Fieldmanager_Radios( array(
					'label' => esc_html( 'Type of registration', 'justonetree' ),
					'options' => array(
						'individual' => esc_html( 'Individual', 'justonetree' ),
						'organization' => esc_html( 'Organization', 'justonetree' ),
					),
				) ),
				'email' => new Fieldmanager_Textfield( esc_html( 'Email', 'justonetree' ) ),
				'mobile' => new Fieldmanager_Textfield( esc_html( 'Mobile', 'justonetree' ) ),
				'newsletter-opt-in' => new Fieldmanager_Checkbox( array(
					'label' => esc_html( 'Yes, subscribe me to campaign updates.', 'justonetree' ),
					'checked_value' => 'yes',
					'unchecked_value' => 'no',
				) ),
			),
		) );

		$tree_fields = new Fieldmanager_Group( array(
			'name' => 'tree_info',
			'children' => array(
				'number' => new Fieldmanager_Textfield( esc_html( 'Number of trees', 'justonetree' ) ),
				'address' => new Fieldmanager_Textarea( esc_html( 'Address', 'justonetree' ) ),
			),
		) );

		$contact_fields->add_meta_box( esc_html__( 'Contact Information', 'justonetree' ), $this->cpt );
		$tree_fields->add_meta_box( esc_html__( 'Tree Information', 'justonetree' ), $this->cpt );
	}

}
JustOneTree_Tree_Fields::get_instance();
