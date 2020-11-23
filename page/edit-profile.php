<?php
  session_start();

  include('database.php');

  $id = $_SESSION['ID'];

  $sql = "SELECT * FROM tbl_users WHERE ID = '$id'";

  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="../css/home-page.css" type="text/css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Edit Profile - <?php echo $row['firstname'] ?></title>
    <script>
    <?php //User drop down list (top right) ?>
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
    <?php //Notif drop down list (top right) ?>
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
    </script>
    <style>
      *{
        margin: 0;
        padding: 0;
      }
      body{
        margin: 0;
        padding: 0;
      }
      .container {
        padding: 20px;
        margin: auto;
        margin-top: 50px;
        text-align: center;
        align-content: center;
        background: #F0F2F5;
        width: 600px;
        height: auto;
        border-radius: 5px;
      }
      .input-group {
        padding: 5px;
        margin: 5px;
        border: none;
        font-size: 15px;
      }
      .input-group:focus {
        border: none;
        outline: none;
        font-size: 18px;
      }
      label {
        padding: 5px;
        margin: 5px;
      }
      #user-icon {
        border: 1px solid #187bff;
        border-radius: 50%;
      }
    </style>
  </head>
  <body>
    <div class="overlay" id="overlay"></div>
    <div class="overlayy" id="overlayy"></div>
    <div class="nav-main-container">
      <div class="app_logo">
        <img class="logo" src="../content/filennials_logo.png" alt="Filennials logo" onclick="location.href='home.php';">
      </div>
      <div class="nav-container">
        <div class="menu">
          <li id="li-home"><a href="home.php"><span class="fas fa-home"></span></a></li>
          <li id="li-user"><a href="user-profile.php"><span class="far fa-user"></span></a></li>
          <li id="li-search"><a href="other-users.php"><span class="fas fa-search"></span></a></li>
        </div>
      </div>
      <div class="user-notif">
          <div class="notif">
            <a href="#">
              <span class="far fa-bell" id="show-notif"></span>
              <div class="notif-drop" id="notif-drop" style="display:none;">
                <p><h5>Sample text<br>
                  Pop-up for notification!!!</h5></p>
              </div>
            </a>
          </div>
          <div class="user-icon">
            <?php /*
            <a href="#">
              <?php
              if(isset($_SESSION['ID'])) {
                if($_SESSION['no_pic'] == 1) {
                  echo "<img src='../content/userDefault.png' id='userPic' alt='User Pic'>";
                }
                else {
                  echo "<img src='../user_picture_uploads/".$_SESSION['profile_pic_path']."' id='userPic' alt='User Pic'>";
                }
              }
              ?>
            </a> */ ?>
            <li style="font-size:25px;"><a href="#"><span style="color:rgba(0, 0, 0, 0.7);" class="fas fa-chevron-circle-down"></span></a></li>
            <div class="account-drop" id="account-drop" style="display:none;">
              <div class="go-to-profile" style="margin-top:10px;" onclick="location.href='edit-profile.php';">
                <p><span class="material-icons-outlined">person</span>Edit Profile</p>
              </div>
              <div class="logout" id="logout" onclick="location.href='logout.php';">
                <p style="margin-bottom:10px;"><span class="material-icons">logout</span>Log Out</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="container">
      <h5>Edit Profile</h5>
      <form class="form-group" action="" method="post">
        <table class="table">
          <tr>
            <td><label for="firstname">First name</label></td>
            <td><input class="input-group" type="text" name="firstname" value="<?php echo $row['firstname'] ?>"></td>
          </tr>
          <tr>
            <td><label for="lastname">Last name</label></td>
            <td><input class="input-group" type="text" name="lastname" value="<?php echo $row['lastname'] ?>"></td>
          </tr>
          <tr>
            <td><label for="email">Email</label></td>
            <td><input class="input-group" type="email" name="email" value="<?php echo $row['email'] ?>"></td>
          </tr>
          <tr>
            <td><label for="birthday">Birthday</label></td>
            <td><input class="input-group" type="date" name="birthday" value="<?php echo $row['birthday'] ?>"></td>
          </tr>
          <tr>
            <td><label for="mobile">Last name</label></td>
            <td><input class="input-group" type="text" name="mobile" value="<?php echo $row['mobilenumber'] ?>"></td>
          </tr>
        </table>
        <input class="btn btn-outline-primary" type="submit" name="editProfile" value="Update">
      </form>
    </div>
  </body>
</html>
