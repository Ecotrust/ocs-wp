$(document).ready(function() {
  var first_h1 = $('h1').text();
  var page_title = "[CONSERVE] [" + first_h1 + "]";

  $('#search-field').attr('placeholder', page_title);

  $('#search-field').on('focus', function() {
    $(this).attr('placeholder', '');
  });

  $('#search-field').on('blur', function() {
    var text_length = $(this).val().length;
    if (text_length === 0) {
      $(this).attr('placeholder', page_title);
    }
  });
});
