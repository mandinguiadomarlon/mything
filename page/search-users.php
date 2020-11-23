  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
      <script>
        $(document).ready(function(){
          $('.search-user').click(function(){
            var userid = $(this).attr('id');
            //alert('You clicked on ' + userid);
            //$.redirect("/login.php", {userid: userid}, "POST", "_blank");
            var form = document.createElement("form");
            form.method = 'post';
            form.action = 'other-users.php';
            var input = document.createElement('input');
            input.type = "text";
            input.name = "userid";
            input.style.display = "none";
            input.value = userid;
            document.body.appendChild(form);
            form.appendChild(input);
            form.submit();
          });
        });
      </script>
    </head>
    <body>
      <?php
        session_start();

        include('database.php');

        $sql = "SELECT * FROM tbl_users WHERE firstname LIKE '%".$_POST['name']."%' OR lastname LIKE '%".$_POST['name']."%' ";

        $array = $conn->query($sql);

        $count = mysqli_num_rows($array);

        if($count == 0){
          ?>
          <div>
            <p class="text-center" style="color:#fff;">No result.</p>
          </div>
          <?php
        }
        else {
          foreach ($array as $key) {
          ?>
          <div id="other-users">
            <a href="#" class="search-user" id="<?php echo $key['ID']; ?>">
              <?php if($key['no_pic'] == 1) { ?>
                <img width="50" height="50" src="../content/userDefault.png" id="other-user-pic" />&nbsp;
        <?php } else { ?>
                      <img width="50" height="50" src="../user_picture_uploads/<?php echo $key['profile_pic_path'] ?>" id="other-user-pic" />&nbsp;
                <?php    } ?>

              <span id="fn"><?php echo $key['firstname'] ?></span>&nbsp;
                <span id="ln"><?php echo $key['lastname'] ?>
              </span>
            </a>
          </div>
          <?php
          }
        }
        ?>
    </body>
  </html>
