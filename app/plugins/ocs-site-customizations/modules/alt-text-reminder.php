<?php
	/* image alt text reminder */
	class odfw_alt_text_reminder {
		private $allowed = array(
			'a' => array(
				'class' => array(),
				'href' => array(),
				'rel' => array(),
				'title' => array(),
				'target' => array()),
			'span' => array(
				'class' => array(),
				'title' => array()),
			'em' => array(),
			'strong' => array(),
			'u' => array(),
			'code' => array(),
			'sup' => array(),
			'sub' => array(),
			'cite' => array(),
			'strike' => array(),
			'br' => array()
		);
		public function __construct() {
			add_action('admin_init',array($this,'admin_init'),99,0);
		}
		public function admin_init() {
			add_filter("attachment_fields_to_edit", array($this,"alt_text_field_reminder"), 15, 1);
			add_filter( "manage_media_columns", array($this,'img_columns'),10,1);
			add_action('manage_media_custom_column',array($this,'print_img_columns'),10,2);
		}
		public function img_columns($columns) {
			$columns['image_alt'] = __('Alternate Text');
			$columns['post_excerpt'] = __('Caption');
			return $columns;
		}
		public function print_img_columns($name, $post_id) {
			$attachment = get_post($post_id);
			if(!is_object($attachment) || is_wp_error($attachment)) return;
			if(substr($attachment->post_mime_type, 0, 5) == 'image') {
				$none = '<span style="color:#dd0000;">'. __('Empty Alt Text. Please Fix!') .'</span>';
				$alt = stripslashes(get_post_meta($post_id, '_wp_attachment_image_alt', true ));
				switch($name) {
					case 'image_alt' :
						echo !empty($alt) || $alt== $attachment->post_title ? $alt : $none;
						if ( empty($alt) ) {
							//print_r($attachment);
						}
					break;

					case 'post_author' :
						echo !empty($alt) || $alt== $attachment->post_title ? $alt : $none;
					break;

					case 'post_excerpt' :
						echo !empty($alt) || $alt== $attachment->post_title ? $alt : $none;
						echo (!empty($attachment->post_excerpt)) ? trim(wptexturize(wp_kses(stripslashes($attachment->post_excerpt), $this->allowed))) : '' ;
					break;
				}
			}
		}
		public function alt_text_field_reminder($form_fields) {
			if (isset($form_fields['_wp_attachment_image_alt']) && is_array($form_fields['_wp_attachment_image_alt']) && isset($form_fields['_wp_attachment_image_alt']['helps'])) {
				$form_fields['_wp_attachment_image_alt']['helps'] = __('Alt text is <strong>mandatory</strong>!','ewpfi_lang');
				$form_fields['_wp_attachment_image_alt']['required'] = true;
			}
			return $form_fields;
		}
	}
?>
