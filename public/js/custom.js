$(document).ready(function(){
  var $submit = $('#uploader');
  var $file = $('#fileInput');

  $file.change(
      function(){
          $submit.attr('disabled',($(this).val() ? false : true));
      }
  );
});  