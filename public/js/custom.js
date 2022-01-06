
// Upload Button
$(document).ready(function () {
  var $submit = $('#uploader');
  var $file = $('#file');

  $file.change(
    function(){
      $submit.attr('disabled',($(this).val() ? false : true));
    }
  );
});

// Search Button
$(document).ready(function() {
  $('#search').attr('disabled', true); // initially button is disabled
  $('.search-input').on('keyup', function() {
    var text_value = $(".search-input").val();
    if ((!text_value.trim().length) || (text_value == "") || (text_value == null)) {
      $('#search').attr('disabled', true);
    } else {
      $('#search').attr('disabled', false);
    }
  });

});
