
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
$(document).ready(function(){
  var $submit = $('#search');
  var $file = $('.search-input');

  $file.change(
    function(){
      $submit.attr('disabled',($(this).val() ? false : true));
    }
  );
});
