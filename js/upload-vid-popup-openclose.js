//Upload video popup open/close
$(document).ready(function(){
  $("#upload-popup-toggle").click(function(){
    $(".overlay-darkk, .upload-popup").toggle();
    document.getElementById("video").value = null;
    document.getElementById("submitVid").style.display = "none";
    document.getElementById("vidPreview").src= "../content/default-video.gif";
    $("#caption").val("");
    $("#messageSuccess").fadeOut();
    $("#messageFailed").fadeOut();
  });

  $("#overlay-darkk").click(function(){
    $(".overlay-darkk, .upload-popup").toggle();
    document.getElementById("video").value = null;
    document.getElementById("submitVid").style.display = "none";
    document.getElementById("vidPreview").src="../content/default-video.gif";
    $("#caption").val("");
    $("#messageSuccess").fadeOut();
    $("#messageFailed").fadeOut();
  });

  $("#close-upload-vid").click(function(){
    $(".overlay-darkk, .upload-popup").toggle();
    document.getElementById("video").value = null;
    document.getElementById("submitVid").style.display = "none";
    document.getElementById("vidPreview").src="../content/default-video.gif";
    $("#caption").val("");
    $("#messageSuccess").fadeOut();
    $("#messageFailed").fadeOut();
  });
});
