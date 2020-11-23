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

if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $userID = "";

  $errorEmpty = false;

  if(empty($username) || empty($password)) {
    echo "<p style='color:red' class='form-error'>Fill in all fields!</p>";
    $errorEmpty = true;
  }
  else {
    $sql = "select * from tbl_users where username = '$username' && password = '$password'";

    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);

    if($count == 0) {
      echo "<p style='color:red;' class='form-error'>Invalid Username or Password!</p>";
    }
    else {
      $_SESSION['username'] = $username;
      $_SESSION['ID'] = $userID;
      echo "<script>window.location.href='home.php';</script>";
      exit;
    }
    mysqli_close($conn);
  }
}
else {
  echo "There was an error!";
}
?>

<script>
  $("#log_username, #log_password").removeClass("input-error");

  var errorEmpty = "<?php echo $errorEmpty; ?>";

  if(errorEmpty == true){
    $("#log_username, #log_password").addClass("input-error");
  }
  if(errorEmpty == false){
    $("#log_username, #log_password").val("");
  }
</script>
