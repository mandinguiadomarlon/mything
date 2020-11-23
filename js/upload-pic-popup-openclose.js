//Camera icon click open/close upload popup
$(document).ready(function(){
  $("#camera").click(function(){
    $(".overlay-dark, .upload-pic-popup").toggle();
    document.getElementById("picture").value = null;
    document.getElementById("submitPic").style.display = "none";
    document.getElementById("imgPreview").src = "../content/userDefault.png";
  });

  $("#overlay-dark").click(function(){
    $(".overlay-dark, .upload-pic-popup").toggle();
    document.getElementById("picture").value = null;
    document.getElementById("submitPic").style.display = "none";
    document.getElementById("imgPreview").src = "../content/userDefault.png";
  });

  $("#close").click(function(){
    $(".overlay-dark, .upload-pic-popup").toggle();
    document.getElementById("picture").value = null;
    document.getElementById("submitPic").style.display = "none";
    document.getElementById("imgPreview").src = "../content/userDefault.png";
  });
});
