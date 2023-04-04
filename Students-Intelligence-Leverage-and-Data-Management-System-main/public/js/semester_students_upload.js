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
        // console.log($(this).parent().parent().find('.file-upload-info'));
      var file = $(this).parent().parent().parent().find('.file-upload-default');
        var fd = new FormData();
        // console.log(file);
        var files = file[0].files;

        // Check file selected or not
        if(files.length > 0 ){
            fd.append('file',files[0]);
            fd.append('semester_id',config.semester);
            console.log(fd);
            $.ajax({
                url: '/semester/student/upload',
                type: 'post',
                data: fd,
                headers: {
                    'X-CSRF-TOKEN': config.token
                },
                contentType: false,
                processData: false,
                success: function(response){
                    if(response != 0){
                        // $("#img").attr("src",response);
                        // $(".preview img").show(); // Display image element
                        location.reload();
                        // console.log(response);
                    }else{
                        alert('File not uploaded');
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
