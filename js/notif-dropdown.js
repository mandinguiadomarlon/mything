//Notif drop down list (top right)
$(document).ready(function(){
  $("#show-notif").click(function(){
    var x = document.getElementById('overlay');
    var y = document.getElementById('account-drop');

    $(".overlayy, .notif-drop").toggle();

    x.style.display = "none";
    y.style.display = "none";
  });

  $("#overlayy").click(function(){
    var x = document.getElementById('overlay');
    var y = document.getElementById('account-drop');

    $(".overlayy, .notif-drop").toggle();

    x.style.display = "none";
    y.style.display = "none";
  });
});
