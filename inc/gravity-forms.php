<?php
/**
 * Additional functionality for Gravity Forms.
 * This allows for submitting form content to a custom taxonomy.
 * Code stolen almost verbatim from a Gravity Forms forum.
 * Not pretty, but it gets the job done. Probably could use refactoring at some point.
 *
 * @link https://www.gravityhelp.com/forums/topic/custom-posts-and-custom-taxonomies
 *
 * @package Just_One_Tree
 */


function justonetree_gform_field_advanced_settings($position, $form_id) {

	if($position == 50){
	?>
	<li id='populate_taxonomy_settings' style='display:block;'>
		<label for='field_admin_label'>
		<?php _e( 'Populate with a Taxonomy', 'gravityforms' ); ?>
		<?php gform_tooltip( 'form_field_custom_taxonomy' ) ?>
		</label>
		<input type='checkbox' id='field_enable_populate_taxonomy' onclick='togglePopulateTaxonomy(jQuery( '#field_populate_taxonomy' ), '' );' /> Enable population with a taxonomy<br />

		<select id='field_populate_taxonomy' onchange='SetFieldProperty( 'populateTaxonomy', jQuery(this).val());' style='margin-top:10px; display:none;'>
		<option value='' style='color:#999;'>Select a Taxonomy</option>
		<?php
		$taxonomies = get_taxonomies( '', 'objects' );
		foreach($taxonomies as $taxonomy): ?>

		<option value='<?php echo $taxonomy->name; ?>'><?php echo $taxonomy->label; ?></option>

		<?php endforeach; ?>
		</select>

	</li>
	<?php
	}
}
add_action( 'gform_field_advanced_settings', 'justonetree_gform_field_advanced_settings', 10, 2);

// Action to inject supporting script to the form editor page.
function justonetree_gform_editor_scripts(){
	?>
	<script type='text/javascript'>

	jQuery(document).bind( 'gform_load_field_settings', function(event, field, form){

		var valid_types = new Array( 'select' );
		if(jQuery.inArray(field['type'], valid_types) != -1) {
		jQuery( '#populate_taxonomy_settings' ).show();
		} else {
		jQuery( '#populate_taxonomy_settings' ).hide();
		}

		var populateTaxonomy = (typeof field['populateTaxonomy'] != 'undefined' && field['populateTaxonomy'] != '' ) ? field['populateTaxonomy'] : false;

		jQuery( '#field_enable_populate_taxonomy' ).attr( 'checked', populateTaxonomy != false);
		togglePopulateTaxonomy(jQuery( '#field_populate_taxonomy' ), populateTaxonomy);

	});

	function togglePopulateTaxonomy(elem, taxonomy){

		var checked = jQuery( '#field_enable_populate_taxonomy' ).attr( 'checked' );

		if(checked){
		jQuery(elem).slideDown(function(){
			jQuery(this).val(taxonomy);
		});
		} else {
		jQuery(elem).slideUp(function(){
			jQuery(this).val(taxonomy);
		});
		}


	}

	</script>
	<?php
}
add_action( 'gform_editor_js', 'justonetree_gform_editor_scripts' );

// Filter to add a new tooltip.
add_filter( 'gform_tooltips', 'justonetree_gform_tooltips' );
function justonetree_gform_tooltips($tooltips){
	$tooltips['form_field_custom_taxonomy'] = '<h6>Populate with a Taxonomy</h6>Check this box to populate this field from a taxonomy.';
	return $tooltips;
}

// filter to populate taxonomy in designated fields
add_filter( 'gform_pre_render', 'justonetree_gform_populate_taxonomy' );
function justonetree_gform_populate_taxonomy($form){

	foreach( $form['fields'] as &$field ) {

	if( !$field['populateTaxonomy'] )
		continue;

		$taxonomy = $field['populateTaxonomy'];
		$first_choice = $field['choices'][0]['text'];
		$field['choices'] = justonetree_taxonomy_as_choices($taxonomy, $first_choice);
	}

	return $form;
}

function justonetree_taxonomy_as_choices( $taxonomy = 'categories', $first_choice = '' ) {

	$terms = get_terms($taxonomy, 'orderby=name&hide_empty=0' );
	$taxonomy = get_taxonomy($taxonomy);
	$choices = array();
	$i = 0;

	switch( $first_choice ) {

	// if no default option is specified, dynamically create based on taxonomy name
	case '':
		$choices[$i]['text'] = 'Select a {$taxonomy->labels->singular_name}';
		$choices[$i]['value'] = '';
		$i++;
	break;

	// populate the first item from the original choices array
	default:
		$choices[$i]['text'] = $first_choice;
		$choices[$i]['value'] = '';
		$i++;
	break;
	}

	foreach($terms as $term) {
		$choices[$i]['text'] = $term->name;
		$choices[$i]['value'] = $term->term_id;
		$i++;
	}

	return $choices;
}

function justonetree_gform_post_submission($entry, $form) {

	// if no post was created, return
	if(!$entry['post_id'])
	return;

	foreach($form['fields'] as $field){

	if(!$field['populateTaxonomy'])
		continue;

		$taxonomy = $field['populateTaxonomy'];
		$term_id = $entry[$field['id']];
	}

	// if we have a taxonomy and a field id, add term to post
	if($taxonomy && $term_id)
	justonetree_add_term_to_post($taxonomy, $term_id, $entry['post_id']);

}
add_action( 'gform_post_submission', 'justonetree_gform_post_submission', 10, 2);

// Add term from taxonomy to post
function justonetree_add_term_to_post($taxonomy = 'categories', $term_id, $post_id) {

	$terms = get_terms($taxonomy, array( 'hide_empty' => 0));

	foreach($terms as $term) {

	if($term->term_id == $term_id)
		$result = wp_set_object_terms($post_id, (int) $term_id, $taxonomy, false);

	}
}
