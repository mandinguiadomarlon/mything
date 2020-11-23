<?php
  session_start();

  if($_SESSION['ID'] == $_SESSION['other-user-ID'])
  {
    header('location:user-profile.php');
  }
  else {
    header('location:test.php');
  }
 ?>
