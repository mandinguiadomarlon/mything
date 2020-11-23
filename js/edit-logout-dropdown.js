//User drop down list (top right)
$(document).ready(function(){
  $(".user-icon").click(function(){
    var x = document.getElementById('overlayy');
    var y = document.getElementById('notif-drop');

    $(".overlay, .account-drop").toggle();

    x.style.display = "none";
    y.style.display = "none";
  });

  $("#overlay").click(function(){
    var x = document.getElementById('overlayy');
    var y = document.getElementById('notif-drop');

    $(".overlay, .account-drop").toggle();

    x.style.display = "none";
    y.style.display = "none";
  });
});
