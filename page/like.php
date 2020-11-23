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

    $updateLike = "UPDATE tbl_vid_uploads SET like_count = '$n'+1 WHERE vidID = '$postid'";
    mysqli_query($conn, $updateLike);
    $insertLike = "INSERT INTO tbl_likes(postid, likerid) VALUES($postid, $liker)";
    mysqli_query($conn, $insertLike);

    $selectLikeCount = "SELECT * FROM tbl_vid_uploads WHERE vidID = '$postid'";
    $selectLikeCountPost = mysqli_query($conn, $selectLikeCount);
    $likeCountPost = mysqli_fetch_assoc($selectLikeCountPost);

    $likeCount = $likeCountPost['like_count'];

    if($likeCount == 1) {
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
