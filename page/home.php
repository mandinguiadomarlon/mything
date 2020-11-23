<?php
  include 'upload-picture.php';
  include 'get-user-data.php';
  include 'database.php';

  if(!isset($_SESSION['username'])){
    header('location:login.php');
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home - MyThing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="../css/home-page.css" type="text/css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/edit-logout-dropdown.js" type="text/javascript"></script>
    <script src="../js/notif-dropdown.js" type="text/javascript"></script>
    <script src="../js/upload-vid-popup-openclose.js" type="text/javascript"></script>
    <script src="../js/upload-vid.js" type="text/javascript"></script>
    <script src="../js/search-users.js" type="text/javascript"></script>
    <script src="../js/goto-search-user-profile.js" type="text/javascript"></script>
    <script src="../js/like-unlike.js" type="text/javascript"></script>
    <script>
      <?php //Like/Unlike icon change
      /*$(document).ready(function(){
        $("#btnlike").click(function(){
          var icon = $("#btnlike");
          if(icon.hasClass('far')) {
            icon.removeClass('far').addClass('fas')

          }
          else {
            icon.addClass('far').removeClass('fas')
          }
        });
      });*/ ?>
      <?php //Upload video preview function ?>
      var loadFileVid = function(){
        var reader = new FileReader();
        reader.onload = function(){
          var output = document.getElementById('vidPreview');
          output.src = reader.result;
        };
        if(event.target.files[0]){
          reader.readAsDataURL(event.target.files[0]);
        }
        var x = document.getElementById('submitVid');
        x.style.display = "block";
      };
    </script>
  </head>
  <body>
    <div class="overlay" id="overlay"></div>
    <div class="overlayy" id="overlayy"></div>
    <div class="nav-main-container" id="nav-main-container">
      <div class="app_logo">
        <img class="logo" src="../content/filennials_logo.png" alt="Filennials logo" onclick="location.href='home.php';">
      </div>
      <div class="nav-container">
        <div class="menu">
          <li id="li-home" class="active"><a href="home.php"><span class="fas fa-home"></span></a></li>
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

      <?php //HOME USER FEED - SEARCH/LIVE/UPLOAD ?>
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
        </div>
        <form action="" method="post">
        <div class="search-box">
            <p><input id="search-user" type="text" name="search-user" value="" autocomplete="off" placeholder="Type to search..."><?php /*<span class="fas fa-search"></span> */ ?></p>
        </div>
        </form>
        <div id="search-result" <?php //onclick="location.href='test.php';" ?>></div>
        <div class="home-feed-upload-or-live" >
          <li class="live-video"><span class="fas fa-video"></span>Live</li>
          <li id="upload-popup-toggle"><span class="fas fa-file-video"></span>Upload</li>
        </div>
      </div>

      <?php //HOME MAIN FEED ?>
      <?php
      $vid = '../user_video_uploads/';
      $pic = '../user_picture_uploads/';

      $sql = "SELECT * FROM tbl_users a INNER JOIN tbl_vid_uploads b
      ON a.ID = b.userID ORDER BY b.datecreated DESC";

      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
        $postid = $row['vidID'];
        $likerid = $_SESSION['ID'];
        ?>
        <div class="main-feed">
          <div class="uploader-pic">
            <p><img class="post-pic" style="cursor:pointer;" src="<?php echo $pic ?><?php echo $row['profile_pic_path'] ?>" id="<?php echo $row['ID']; ?>" alt="Uploader Pic"><a style="cursor:pointer;" class="post-user" id="<?php echo $row['ID']; ?>"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></a></p>
          </div>
          <div>
            <p style="font-size:13px;padding-left:10px;">Updated a post on <?php echo $row['datecreated'] ?></p>
          </div>
          <div class="uploader-vid">
            <video preload="metadata" src="<?php echo $vid ?><?php echo $row['vid_path'] ?>" controls loop></video>
          </div>
          <div class="uploader-buttons">
            <div class="liked">
              <?php
                $selectLike = "SELECT * FROM tbl_likes WHERE postid = '$postid' AND likerid = '$likerid'";
                $likeResult = mysqli_query($conn, $selectLike);
                $likeCount = mysqli_num_rows($likeResult);

                if($likeCount == 0) { ?>
                  <a href="#" id="<?php echo $row['vidID']?>" class="like"><span class="far fa-thumbs-up"></span></a>
                  <?php //<span class="tooltipLike">Like</span> ?>
                  <?php
                }
                else { ?>
                  <a href="#" id="<?php echo $row['vidID'] ?>" class="unlike"><span class="fas fa-thumbs-up"></span></a>
                  <?php //<span class="tooltipLike">Unlike</span> ?>
                  <?php
                }
              ?>
            </div>
            <div class="comment">
              <span class="far fa-comment"></span>
              <?php //<span class="tooltipComment">Comment</span> ?>
            </div>
            <div class="share">
              <span class="far fa-share-square"></span>
              <?php //<span class="tooltipShare">Share</span> ?>
            </div>
          </div>
          <div class="like_count">
            <p id="postLikes<?php echo $postid ?>"><strong>
              <?php
                $like_count = $row['like_count'];
                if($like_count == 1){
                echo $row['like_count'] . " like";
                }
                elseif ($like_count > 1) {
                  echo $row['like_count'] . " likes";
                }
              ?> </strong></p>
          </div>
          <div class="caption">
            <p><a href="#" class="post-user" id="<?php echo $row['ID'] ?>"><?php echo "@" .$row['username'] ?></a><?php echo $row['caption'] ?></p>
          </div>
        </div>
    <?php  }
      ?>

      <?php //UPLOAD VID POPUP ?>
      <div class="overlay-darkk" id="overlay-darkk"></div>
      <div class="upload-popup" style="display:none;">
        <p><span id="close-upload-vid" class="material-icons">close</span></p>
        <div class="upload-vid">
          <form id="form-vid-upload" class="" action="upload-vid.php" method="post" enctype="multipart/form-data">
            <h4 class="text-center" style="padding:10px;">Upload Video</h4>
            <p id="messageSuccess" style="color:lightgreen;"></p>
            <p id="messageFailed" style="color:red;"></p>
            <?php if(!empty($msg)): ?>
              <div class="alert <?php echo $msg_class; ?>">
                <?php echo $msg; ?>
              </div>
            <?php endif; ?>
            <video id="vidPreview" src="../content/default-video.gif" autoplay controls loop></video>
            <textarea id="caption" name="caption" placeholder="Say something..."></textarea>
            <input id="video" type="file" name="video" value="" onchange="loadFileVid(event)" style="margin-bottom:20px;">
            <input id="submitVid" type="submit" name="submitVid" value="UPLOAD" style="display:none;">
          </form>
        </div>
      </div>

  </body>
</html>
