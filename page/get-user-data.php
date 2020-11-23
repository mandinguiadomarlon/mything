<?php
  $link = mysqli_connect("localhost", "root", "", "filennials");
  $pic_path = "";

/* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  $query = "SELECT * FROM tbl_users WHERE username = '$username'";

  if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['birthday'] = $row['birthday'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['mobilenumber'] = $row['mobilenumber'];
        $_SESSION['profile_pic_path'] = $row['profile_pic_path'];
        $_SESSION['no_pic'] = $row['no_pic'];

        $pic_path = $_SESSION['profile_pic_path'];
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($link);
 ?>
