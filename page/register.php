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
  $email = $_POST['email'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $birthday = $_POST['birthday'];
  $gender = $_POST['gender'];
  $mobilenumber = $_POST['mobilenumber'];

  $errorEmpty = false;
  $errorEmail = false;

  if(empty($username) || empty($password) || empty($email) || empty($firstname) || empty($lastname) || empty($birthday) || empty($gender) || empty($mobilenumber)) {
    echo "<p style='color:red' class='form-error'>Fill in all fields!</p>";
    $errorEmpty = true;
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p style='color:red' class='form-error'>Write a valid e-mail address!</p>";
    $errorEmail = true;
  }
  else {
    $duplicate = mysqli_query($conn, "SELECT username FROM tbl_users WHERE username = '$username'");
    if(mysqli_num_rows($duplicate) > 0) {
      //echo "duplicate";
      echo "<p style='color:red' class='form-error'>Username already exists!</p>";
    }
    else {
      $sql = "INSERT INTO tbl_users (username, password, email, firstname, lastname, birthday, gender, mobilenumber, datecreated)
      VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$birthday', '$gender', '$mobilenumber', CURRENT_TIMESTAMP())";

      if (mysqli_query($conn, $sql)) {
        //echo "success";
        echo "<p style='color:green' class='form-success'>Registered successfully!</p>";
      }
      else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    mysqli_close($conn);
  }
}
else {
  echo "There was an error!";
}

?>

<script>
  $("#username, #password, #email, #firstname, #lastname, #birthday, #mobilenumber").removeClass("input-error");

  var errorEmpty = "<?php echo $errorEmpty; ?>";
  var errorEmail = "<?php echo $errorEmail; ?>";

  if (errorEmpty == true) {
    $("#username, #password, #email, #firstname, #lastname, #birthday, #mobilenumber").addClass("input-error");
  }
  if (errorEmail == true) {
    $("#email").addClass("input-error");
  }
  if (errorEmpty == false && errorEmail == false) {
    $("#username, #password, #email, #firstname, #lastname, #birthday, #mobilenumber").val("");
  }
</script>
