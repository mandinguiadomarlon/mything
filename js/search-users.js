//Search other user list function
$(document).ready(function(){
  $("#search-user").keyup(function(){
    var name = $(this).val();
    $.post('search-users.php', {name:name}, function(data){
      if(name == ""){
        $("#search-result").css({'display':'none'});
      }
      else {
        $("#search-result").css({'display':'block'});
        $("#search-result").html(data);
      }
    });
  });
});
