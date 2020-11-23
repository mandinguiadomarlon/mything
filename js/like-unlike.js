$(document).ready(function(){
  //DEFAULT LIKE CLASS
  $(".like").click(function(e){
    e.preventDefault();
    e.stopPropagation();
    //console.log("like");
    var postid = $(this).attr('id');


    if($("#"+postid).hasClass('like'))
    {
      $("#"+postid).removeClass('like').addClass('unlike');
    }

    if($(this).find('span').hasClass('far'))
    {
      $(this).find('span').removeClass('far').addClass('fas');
    }

    $(this).off();

    $.post('like.php', {postid:postid}, function(data){
      $("#postLikes" + postid).html(data);
    });
  });
  //DYNAMICALLY ADDED UNLIKE CLASS
  $(document.body).on('click', '.unlike', function(e){
    e.preventDefault();
    e.stopPropagation();
    //console.log("unlike");

    var postid = $(this).attr('id');

    if($("#"+postid).hasClass('unlike'))
    {
      $("#"+postid).removeClass('unlike').addClass('like');
    }

    if($(this).find('span').hasClass('fas'))
    {
      $(this).find('span').removeClass('fas').addClass('far');
    }

    $(this).off();

    $.post('unlike.php', {postid:postid}, function(data){
      $("#postLikes" + postid).html(data);
    });
  });
  //DYNAMICALLY ADDED LIKE CLASS
  $(document.body).on('click', '.like', function(e){
    e.preventDefault();
    e.stopPropagation();
    //console.log("plike");
    var postid = $(this).attr('id');

    if($("#"+postid).hasClass('like'))
    {
      $("#"+postid).removeClass('like').addClass('unlike');
    }

    if($(this).find('span').hasClass('far'))
    {
      $(this).find('span').removeClass('far').addClass('fas');
    }

    $(this).off();

    $.post('like.php', {postid:postid}, function(data){
      $("#postLikes" + postid).html(data);
    });
  });
});
