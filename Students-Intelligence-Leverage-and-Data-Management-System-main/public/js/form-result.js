(function($) {
  'use strict';
  $(function() {
    $('.file-upload-info').on('click', function() {
      $(this).prop('disabled', true);
      var file = $(this).parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
    $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().find('.file-upload-default');
        var fd = new FormData();
        var files = $file[0].files;

        // Check file selected or not
        if(files.length > 0 ){
            fd.append('file',files[0]);

            $.ajax({
                url: '/result/upload',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response != 0){
                        $("#img").attr("src",response);
                        $(".preview img").show(); // Display image element
                    }else{
                        alert('file not uploaded');
                    }
                },
            });
        }else{
            alert("Please select a file.");
        }
      // file.trigger('click');
    });
  });
})(jQuery);
