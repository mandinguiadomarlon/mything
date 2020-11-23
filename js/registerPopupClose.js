$(document).ready(function(){
  $("#close").click(function(){
    $(".overlay, .register_popup").fadeToggle();
  });

  $("#overlay").click(function(){
    $(".overlay, .register_popup").fadeToggle();
  });
});
