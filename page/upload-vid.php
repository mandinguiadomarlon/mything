<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $pwd = "";
  $db = "filennials";

  //db connection
  $conn = mysqli_connect($server, $user, $pwd, $db);

  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }

  $userID = $_SESSION['ID'];

  if(!empty($_FILES['video'])) {
    $caption = $_POST['caption'];
    $video = $_FILES['video'];

    $videoName = $video['name'];
    $videoTmpName = $video['tmp_name'];
    $videoSize = $video['size'];
    $videoError = $video['error'];
    $videoType = $video['type'];

    $videoExt = explode('.', $videoName);
    $videoActualExt = mb_strtolower(end($videoExt));

    $allowed = array('mp4', 'gif', 'flv', 'm3u8', 'ts', '3gp', 'mov', 'avi', 'wmv');

    if(in_array($videoActualExt, $allowed)) {
      if($videoError == 0) {
        if($videoSize < 999999999) {
          $videoNewName = uniqid('', true).".".$videoActualExt;
          $videoPath = '../user_video_uploads/'.$videoNewName;
          if(move_uploaded_file($videoTmpName, $videoPath)) {
            $sql = "INSERT INTO tbl_vid_uploads(userID, vid_path, caption, like_count, comment_count, share_count, datecreated)
            VALUES ('$userID', '$videoNewName', '$caption', 0, 0, 0, CURRENT_TIMESTAMP())";
            if(mysqli_query($conn, $sql)) {
              echo "Video Uploaded";
            } else {
              echo "invalid";
            }
          }
        } else {
          echo "big";
        }
      } else {
        echo "invalid";
      }
    } else {
      echo "type";
    }
    mysqli_close($conn);
  }
?>
