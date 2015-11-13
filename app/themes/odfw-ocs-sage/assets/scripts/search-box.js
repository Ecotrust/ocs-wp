function checkSearchBoxLength (){
/*
 * TODO
 * We'll want to call this on page load and on keydown.
 *
 * Should either dynamically resize the text with js [1]
 * or
 * We can set a few ranges for CSS styles. Say, default, over-30, over-45, over-60... setup a few cascading font
 * sizes in the css and hope for the best
 *
 *
 * [1] https://github.com/STRML/textFit
 * [1] http://fittextjs.com/
 * [1] http://stackoverflow.com/questions/687998/auto-size-dynamic-text-to-fill-fixed-size-container )
 */
}


$(document).ready(function() {
  // We only want to change the contents of the search box if we're on
  // a device bigger than a phone
  if ($(window).width() > 767) {
    // Grab the content of the first h1 on the page and create
    // the search box's placeholder
    var page_title = $('h1:eq(0)').hide().text(),
        $search_field = $('#search-field');

    // TODO: Should be black when it's a page title.
        // Styling :placeholder across browsers is still a finicky business.
        // Might need to use .val() and clear on focus if (val==page_title);

    // Set the placeholder
    $search_field.attr('placeholder', page_title.toUpperCase()).addClass('focused');

    //@TODO: check length of content and resize text to fit
    checkSearchBoxLength();

    // When the user clicks in the box, remove the placeholder
    $search_field.on('focus', function() {
      $(this).attr('placeholder', '').addClass('focused');
    });

    // When the user clicks out of the box, reset the placeholder if the user
    // hasn't entered in any text
    $search_field.on('blur', function() {
      var text_length = $(this).val().length;
      if (text_length === 0) {
        $(this).attr('placeholder', page_title).removeClass('focused');
      }
    });
  }


});
