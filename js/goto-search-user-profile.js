//GO to user profile when username is clicked
$(document).ready(function(){
  $('.post-user').click(function(){
    var userid = $(this).attr('id');

    var form = document.createElement("form");
    form.method = 'post';
    form.action = 'other-users.php';
    var input = document.createElement('input');
    input.type = "text";
    input.name = "userid";
    input.style.display = "none";
    input.value = userid;
    document.body.appendChild(form);
    form.appendChild(input);
    form.submit();
  });

  $('.post-pic').click(function(){
    var userid = $(this).attr('id');

    var form = document.createElement("form");
    form.method = 'post';
    form.action = 'other-users.php';
    var input = document.createElement('input');
    input.type = "text";
    input.name = "userid";
    input.style.display = "none";
    input.value = userid;
    document.body.appendChild(form);
    form.appendChild(input);
    form.submit();
  });
});
