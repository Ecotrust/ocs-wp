<?php

namespace Roots\Sage\Utils;

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', __NAMESPACE__ . '\\get_search_form');



/*

<?php

// Stick this on the relavant template to get generate the code of all of the fields associated with the page.
// @TODO integrate it with the field generator https://github.com/willthemoor/cmb2-metabox-generator

function tagMaker($tag, $close = false, $class="") {
	$theTag = isset($tag) ? $tag : "div";

	$spcr = "&nbsp;&nbsp;&nbsp;&nbsp;";

	if ( $close ) {
		// formatting hackeries
		$out = $tag != 'section' && $tag != 'h2'  ? $spcr : "";
		$out .= "&lt;/" . $tag . "&gt;";
		$out .= "<br />";
	} else {
		$out = "<br />";
		$out .= $tag != 'section' ? $spcr : "";
		$out .= "&lt;" . $tag;
		$out .= $class != '' ? ' class="' . $class .'"' : '';
		$out .= "&gt;";
	}

	return $out;

}

function cmbTagMaker($field, $group=false){

	$h = function($tag) { return htmlspecialchars($tag); };

	$out = "";
	$spcr = "&nbsp;&nbsp;&nbsp;&nbsp;";

	$fieldID = $field['id'];
	$fieldType = isset($field['type']) ? $field['type'] : "type-not-set";
	$fieldName = isset($field['name']) ? $field['name'] : "no-name";

	// @TODO don't need title fields showing up
	// @TODO or output as a header?
	// if ( $fieldType == "title" ) { return; }

	switch ( $fieldType ) {
		case "wysiwyg":
			$tag = "div";
			$esc = "wpautop";
			break;
		case "url":
			$tag = "p";
			$esc = "esc_url";
			break;
		case "email":
			$tag = "p";
			$esc = "is_email";
			break;
		case "group":
			$tag = "div";
			$esc = "esc_html";
			break;
		// p and esc_html will do for everything else. For now.
			// @TODO other things that return an array like multi checks.
		default:
			$tag = "p";
			$esc = "esc_html";
	}


	//@TODO pull the_field to before the HTML and only output the HTML if it's not empty
	$getString  = '<br />' . $spcr . $spcr;
	$getString .= $h("<?php ") . "\$the_field = get_post_meta( get_the_ID(), '" . $fieldID   . "', true );";
	$getString .= '<br />' . $spcr . $spcr;


	//start the output
	$out .= tagMaker('section', false, 'cmb2-wrap-'.$fieldType . " " . $fieldID );
	$out .= tagMaker('h2')  . $fieldName . tagMaker('h2', true);
	$out .= tagMaker($tag, false, 'cmb2-'.$fieldType);
	$out .= $getString;

	if( $fieldType=="group" ) {
		//@TODO Print out: if ( !empty (blah) ) {} First
		$out .= '<br />' . $spcr . $spcr;
		// if it's a group, we need to output a php loop, not just an echo
		$out .= "foreach(\$the_field as \$entries => \$entry ) { " . $h('?>');
		$out .= '<br />' . $spcr . $spcr . $spcr;

		// this uses the cmb object to determine the fields to look up within group loop
		foreach($field['fields'] as $key => $entry){
			$out .= $h("<p><?php ") . "echo \$entry['" . $key . "'];" . $h("?></p>");
			$out .= '<br />' . $spcr . $spcr . $spcr;
		}
		$out .= '<br />' . $spcr . $spcr;
		// end the printed foreach loop
		$out .= $h("<?php ") . "} " . $h("?>") . "<br />";
	}else{
		$out .= 'echo ' . $esc . '( $the_field ); ' . $h("?>") . '<br />';
	}


	$out .= tagMaker($tag, true);
	$out .= tagMaker('section', true);
	$out .= "<br /><br />";
	return $out;

}

// OK, Let's get to it.
// Retrieve a CMB2 instance
$cmb = cmb2_get_metabox( 'coa_meta_coa' );
$cmb_fields = $cmb->meta_box['fields'];

echo "<pre>";
foreach($cmb_fields as $name=>$value) {
	echo cmbTagMaker($value);
}
echo "</pre>";


?>


*/
