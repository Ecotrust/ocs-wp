$(document).ready(function() {
  // We only want to change the contents of the search box if we're on
  // a device bigger than a phone
  if ($(window).width() > 767) {
    // Grab the content of the first h1 on the page and create
    // the search box's placeholder
    var first_h1 = $('h1').text();
    var page_title = "[Conserve] [" + first_h1 + "]";

    // Set the placeholder
    $('#search-field').attr('placeholder', page_title.toUpperCase());

    // When the user clicks in the box, remove the placeholder
    $('#search-field').on('focus', function() {
      $(this).attr('placeholder', '');
    });

    // When the user clicks out of the box, reset the placeholder if the user
    // hasn't entered in any text
    $('#search-field').on('blur', function() {
      var text_length = $(this).val().length;
      if (text_length === 0) {
        $(this).attr('placeholder', page_title);
      }
    });
  }
});
