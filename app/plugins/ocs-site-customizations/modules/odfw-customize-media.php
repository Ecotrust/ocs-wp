<?

/**
 *
 * Adjustments to the media uploader, editor and listings.
 *
 */




/**
 *
 * Custom Fields For Media Items
 *
 */

	/**
	 * Add Photographer Name and URL fields to media uploader
	 *
	 * @param $form_fields array, fields to include in attachment form
	 * @param $post object, attachment record in database
	 * @return $form_fields, modified form fields
	 */

	function odfw_attachment_field_credit( $form_fields, $post ) {

		$form_fields['odfw-attribution-name'] = array(
			'label' => 'Attribution Name',
			'input' => 'text',
			'value' => get_post_meta( $post->ID, 'odfw_attribution_name', true ),
			'helps' => 'If provided, photo credit will be displayed',
		);

		// $form_fields['odfw-attribution-url'] = array(
		// 	'label' => 'Attribution URL',
		// 	'input' => 'text',
		// 	'value' => get_post_meta( $post->ID, 'odfw_attribution_url', true ),
		// 	'helps' => 'Add URL, not required',
		// );


		return $form_fields;
	}

	add_filter( 'attachment_fields_to_edit', 'odfw_attachment_field_credit', 10, 2 );


	/**
	 * Save values of Photographer Name and URL in media uploader
	 *
	 * @param $post array, the post data for database
	 * @param $attachment array, attachment fields from $_POST form
	 * @return $post array, modified post data
	 */

	function odfw_attachment_field_credit_save( $post, $attachment ) {
		if( isset( $attachment['odfw-attribution-name'] ) ) {
			update_post_meta( $post['ID'], 'odfw_attribution_name', $attachment['odfw-attribution-name'] );
		}
		// if( isset( $attachment['odfw-attribution-url'] ) ) {
		// 	update_post_meta( $post['ID'], 'odfw_attribution_url', esc_url( $attachment['odfw-attribution-url'] ) );
		// }
		return $post;
	}

	add_filter( 'attachment_fields_to_save', 'odfw_attachment_field_credit_save', 10, 2 );


/**
 *
 * Allow SVG files to be uploaded
 *
 */

add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {

	// add the file extension to the array
	$existing_mimes['svg'] = 'image/svg+xml';

	// call the modified list of extensions
	return $existing_mimes;

}



/**
 *
 * Include a class to print a reminder when alt text is missing
 *
 */

include_once(ODFW_CUSTOMIZATIONS_PLUGIN_URL . '/modules/alt-text-reminder.php');

$odfw_alt_text_reminder = new odfw_alt_text_reminder;
