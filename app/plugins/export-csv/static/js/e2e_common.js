/**
  * This function is used to validate form data
  */
  function validate_form() {
    var post_type = jQuery("input[name=e2e_post_type]:checked").val();
    if (typeof(post_type) == 'undefined') {
      alert ('Please select a selection criteria');
      return false;
    }
    var ext = jQuery("input[name=ext]:checked").val();
    if (typeof(ext) == 'undefined') {
      alert ('Please select an extension');
      return false;
    }
    return true;
  }