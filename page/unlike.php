<?php
  session_start();
  include 'database.php';

  if(isset($_POST['postid']))
  {
    $postid = $_POST['postid'];
    //echo $postid;
    $selectQuery = "SELECT * FROM tbl_vid_uploads WHERE vidID = '$postid'";
    $selectPost = mysqli_query($conn, $selectQuery);
    $rowPost = mysqli_fetch_assoc($selectPost);
    $n = $rowPost['like_count'];
    $liker = $_SESSION['ID'];

    $deleteLike = "DELETE FROM tbl_likes WHERE postid= '$postid' AND likerid = '$liker'";
    $updateLike = "UPDATE tbl_vid_uploads SET like_count = '$n'-1 WHERE vidID = '$postid'";
    mysqli_query($conn, $deleteLike);
    mysqli_query($conn, $updateLike);

    $selectLikeCount = "SELECT * FROM tbl_vid_uploads WHERE vidID = '$postid'";
    $selectLikeCountPost = mysqli_query($conn, $selectLikeCount);
    $likeCountPost = mysqli_fetch_assoc($selectLikeCountPost);

    $likeCount = $likeCountPost['like_count'];

    if($likeCount <= 0) {
      echo "";
      exit;
    }
    elseif($likeCount == 1) {
      echo $likeCount . " like";
      exit;
    }
    else {
      echo $likeCount . " likes";
      exit;
    }
    mysqli_close($conn);
  }
 ?>
