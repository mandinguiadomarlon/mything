<?php
  include 'upload-picture.php';
  include 'get-user-data.php';
  include 'database.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="../css/user-profile.css" type="text/css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/edit-logout-dropdown.js" type="text/javascript"></script>
    <script src="../js/notif-dropdown.js" type="text/javascript"></script>
    <script src="../js/upload-pic-popup-openclose.js" type="text/javascript"></script>
    <title><?php echo $_SESSION['firstname'] ?> - MyThing</title>
    <script>
    <?php //Upload image preview function ?>
    var loadFile = function(event){
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('imgPreview');
        output.src = reader.result;
      };
      if(event.target.files[0]){
      reader.readAsDataURL(event.target.files[0]);
      }
      var x = document.getElementById('submitPic');
      x.style.display = "block";
    };
    </script>
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
          <li id="li-user" class="active"><a href="user-profile.php"><span class="far fa-user"></span></a></li>
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
            <a href="#"><span class="fas fa-chevron-circle-down"></span></a>
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

      <?php //USER PROFILE INFO ?>
      <div class="feed">
        <div class="home-feed-user">
          <?php
          if(isset($_SESSION['ID'])) {
            if($_SESSION['no_pic'] == 1) {
              echo "<img src='../content/userDefault.png' id='home-feed-pic' alt='User Pic'>";
              }
              else {
                echo "<img src='../user_picture_uploads/".$pic_path."' id='home-feed-pic' alt='User Pic'>";
                }
              }
            ?>
          <div class="cam-icon">
            <span id="camera" class="fas fa-camera"></span>
          </div>
        </div>
        <div class="home-feed-followers" >
          <?php
            $userID = $_SESSION['ID'];
            $sql = "SELECT * FROM tbl_vid_uploads WHERE userID = '$userID'";

            $result = mysqli_query($conn, $sql);

            $post = mysqli_num_rows($result);
           ?>
          <li><b style="padding-right:5px;font-size:18px;">0</b>followers</li>
          <li><b style="padding-right:5px;font-size:18px;">0</b>following</li>
          <li><b style="padding-right:5px;font-size:18px;"><?php echo $post ?></b>posts</li>
        </div>
        <div class="full-name">
          <li style="margin-left:20px"><strong><?php echo $_SESSION['firstname'] ?></strong></li>
          <li><strong><?php echo $_SESSION['lastname'] ?></strong></li>
        </div>
      </div>

        <?php //USER VID UPLOADS CONTAINER ?>
        <div class="user-vid-feed">
          <div class="vid-list">
            <?php
            $folder = '../user_video_uploads/';
            $userID = $_SESSION['ID'];

            $sql = "SELECT * FROM tbl_vid_uploads WHERE userID = '$userID'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
              $videoPath = $row['vid_path'];
              $vidid = $row['vidID'];
              echo "<ul style='display:inline;'";
              echo "<li>";
              echo "<video id='$vidid' src='".$folder."".$videoPath."' controls></video>";
              echo "</li>";
              echo "</ul>";
            }
            ?>
          </div>
        </div>

        <?php //UPLOAD PROFILE PICTURE CONTAINER ?>
        <div class="overlay-dark" id="overlay-dark"></div>
        <div class="upload-pic-popup" style="display:none;">
          <p><span id="close" class="material-icons">close</span></p>
          <div class="upload-pic">
            <form id="form-upload-pic" class="" action="user-profile.php" method="post" enctype="multipart/form-data">
                <h4 class="text-center" style="padding:10px;">Upload Profile Picture</h4>
                  <?php if(!empty($msg)): ?>
                    <div class="alert <?php echo $msg_class; ?>">
                      <?php echo $msg; ?>
                    </div>
                  <?php endif; ?>
                  <p class="upload-pic-msg"></p>
                  <div class="img-container">
                    <img id="imgPreview" src="../content/userDefault.png">
                  </div>
                <input id="picture" type="file" name="picture" value="" accept="image/*" onchange="loadFile(event)" style="margin-bottom:20px;"><br>
                <input id="submitPic" type="submit" name="submitPic" value="UPLOAD" style="display:none;">
            </form>
          </div>
        </div>
  </body>
</html>
