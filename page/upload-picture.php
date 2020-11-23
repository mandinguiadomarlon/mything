<?php
  session_start();

  $msg = "";
  $msg_class = "";

  $server = "localhost";
  $user = "root";
  $pwd = "";
  $db = "filennials";

  //db connection
  $conn = mysqli_connect($server, $user, $pwd, $db);

  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }

  $username = $_SESSION['username'];
  $userID = $_SESSION['ID'];

  if(isset($_POST['submitPic'])) {
    $file = $_FILES['picture'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = mb_strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)) {
      if($fileError === 0){
        if($fileSize < 1000000) {
          $fileNewName = uniqid('', true).".".$fileActualExt;
          $filePath = '../user_picture_uploads/'.$fileNewName;
          if(move_uploaded_file($fileTmpName, $filePath)) {
            $sql = "INSERT INTO tbl_img_uploads(userID, img_path, datecreated)
            VALUES ('$userID', '$fileNewName', CURRENT_TIMESTAMP())";
            if(mysqli_query($conn, $sql)){
              $sqlUpdate = "UPDATE tbl_users SET profile_pic_path = '$fileNewName', no_pic = 0
              WHERE username = '$username'";
              if(mysqli_query($conn, $sqlUpdate)){

                $msg = "Image Uploaded";
                $msg_class = "alert-success";

                header('location:user-profile.php');
              }
              else {
                $msg = "Database update error!";
                $msg_class = "alert-danger";
              }
            }
            else {
              $msg = "Database upload error!";
              $msg_class = "alert-danger";
            }
          }
          else {
            $msg = "Failed to upload image";
            $msg_class = "alert-danger";
          }
        }
        else {
          $msg = "Your file is too big!";
          $msg_class = "alert-danger";
        }
      }
      else {
        $msg = "There was an error uploading your file!";
        $msg_class = "alert-danger";
      }
    }
    else {
      $msg = "You cannot upload files of this type!";
      $msg_class = "alert-danger";
    }
    mysqli_close($conn);
  }
?>
