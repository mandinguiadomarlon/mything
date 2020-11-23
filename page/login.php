<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@300&family=Staatliches&display=swap" rel="stylesheet">
  <link href="../css/style_login.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/registerToggle.js" type="text/javascript"></script>
  <script src="../js/registerPopupClose.js" type="text/javascript"></script>
  <title>Login or Register - MyThing</title>
  <script>
    $(document).ready(function(){
      $("#reg_form").submit(function(e){
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var birthday = $("#birthday").val();
        var gender = $("input[name=gender]:checked").val()
        var mobilenumber = $("#mobilenumber").val();
        var submit = $("#btn-submit").val();
        $(".form-message").load("register.php", {
          username: username,
          password: password,
          email: email,
          firstname: firstname,
          lastname: lastname,
          birthday: birthday,
          gender: gender,
          mobilenumber: mobilenumber,
          submit: submit
        });
      });
    });
    $(document).ready(function(){
      $("#log_form").submit(function(e){
        e.preventDefault();
        var username = $("#log_username").val();
        var password = $("#log_password").val();
        var submit = $("#btn-login").val();
        $(".log-message").load("validate_login.php", {
          username: username,
          password: password,
          submit: submit
        });
      });
    });
    $(document).ready(function(){
      $("#firstname").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
        $('#firstname').html(inputValue);
      });
    });
    $(document).ready(function(){
      $("#lastname").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
        $('#lastname').html(inputValue);
      });
    });
  </script>
</head>
<body>
  <div class="overlay" id="overlay"></div>
  <div class="container">
    <?php //<img src="../content/filennials_logo.png" alt="Filennials logo"> ?>
    <h2 style="font-family:Grandstander;font-size:35px;">Login</h2>
    <form action="validate_login.php" id="log_form" name="form2" method="post">
      <p class="log-message"></p>
      <div class="login_inputs">
        <input type="text" id="log_username" name="log_username" placeholder="Username">
      </div>
      <div class="login_inputs">
        <input type="password" id="log_password" name="log_password" placeholder="Password">
      </div>
      <input id="btn-login" type="submit" name="submit" value="Log In">
    </form>
    <div class="signUp">
      <p>Don't have an account?</p><p><a id="popSignUp">Sign Up</a></p>
    </div>
    <img class="drop" src="../content/drop02.png" alt="drop">
  </div>
  <div class="register_popup" id="register_popup">
    <span id="close" class="material-icons">close</span>
    <div class="registration_info">
      <form id="reg_form" name="form1" action="register.php" method="post">
        <p class="form-message"></p>
        <div class="form-group">
        <table>
          <tr>
            <td><input class="form-control" id="firstname" type="text" name="firstname" placeholder="First name" ></td>
            <td><input class="form-control" id="lastname" type="text" name="lastname" placeholder="Last name" ></td>
          </tr>
          <tr>
            <td>
              <div class="r_gender">
                <label for="r1"><input class="form-control" type="radio" name="gender" value="Male" checked >Male</label>
                <label for="r2"><input class="form-control" type="radio" name="gender" value="Female" >Female</label>
                <label for="r3"><input class="form-control" type="radio" name="gender" value="Other" >Other</label>
              </div>
            </td>
            <td><input class="form-control" type="date" id="birthday" name="birthday" ></td>
          </tr>
          <tr>
            <td><input class="form-control" type="text" id="mobilenumber" name="mobilenumber" placeholder="Mobile number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
            <td></td>
          </tr>
          <tr>
            <td><input class="form-control" type="email" id="email" name="email" placeholder="Email" ></td>
            <td></td>
          </tr>
          <tr>
            <td><input class="form-control" type="text" id="username" name="username" placeholder="Username" ></td>
            <td><input class="form-control" type="password" id="password" name="password" placeholder="Password" ></td>
          </tr>
        </table>
        <button id="btn-submit" class="btn_register" type="submit" name="submit">REGISTER</button>
      </div>
      </form>
    </div>
  </div>
</body>
</html>
