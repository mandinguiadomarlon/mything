//Upload video function
$(document).ready(function(){
  $("#form-vid-upload").on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url: "upload-vid.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function() {
        $("#messageSuccess").fadeOut();
        $("#messageFailed").fadeOut();
      },
      success: function(data) {
        if(data == 'invalid') {
          $("#messageFailed").html("There was an error uploading your video!").fadeIn();
          $("#messageSuccess").fadeOut();
        }
        else if (data == 'big') {
          $("#messageFailed").html("File is too big!").fadeIn();
          $("#messageSuccess").fadeOut();
        }
        else if (data == 'type') {
          $("#messageFailed").html("Cannot upload file of this type!").fadeIn();
          $("#messageSuccess").fadeOut();
        }
        else {
          $("#messageSuccess").html("Your video was uploaded successfully!").fadeIn();
          $("#messageFailed").fadeOut();
        }
      }
    });
  });
});
