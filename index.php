<?php 
  session_start();
  if(isset($_SESSION['uniqueid'])){
    header("location: chat.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapperlogin">
    <section class="form login">

      <!-- script login -->
    <?php
    include_once('connect.php');
      if(isset($_POST['login'])){
        $username = mysql_real_escape_string(htmlentities($_POST['username']));
        $password = mysql_real_escape_string(htmlentities(md5($_POST['password'])));

        $sql = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'") or die(mysql_error());
        if(mysql_num_rows($sql) == 0){
          echo '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Username atau Password salah!</strong>
                </div>';
        }else{
          $row = mysql_fetch_assoc($sql);
          $_SESSION['uniqueid']=$row['uniqueid'];
          $uniqueid=$row['uniqueid'];
          mysql_query("UPDATE users SET status='online' WHERE uniqueid=$uniqueid");
          header("location: chat.php");
        }
      }
    ?>

      <header><center>Login Realtime Chat App by AM</center></header>
      <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter your username" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="login">
        </div>
      </form>
      <div class="link">Belumpunya akun? <a href="register.php">Daftar sekarang</a></div>
    </section>
  </div>
  <script src="js/custome/pass-show-hide.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>



</html>
