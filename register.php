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
    if(isset($_POST['register'])){
    $username = mysql_real_escape_string(htmlentities($_POST['username']));
    $password = mysql_real_escape_string(htmlentities($_POST['password']));
            $sql = mysql_query("SELECT * FROM users WHERE username='$username'") or die(mysql_error());
            // cari dulu apakah username sudah ada apa belum, karena username tidak boleh sama
            if(mysql_num_rows($sql) > 0){
                echo '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Username sudah ada!</strong>
                </div>';
            }else{
              // cek apakah file nya ukuranya lebih dari 500kb atau tidak
                if ($_FILES["images"]["size"] > 500000) {
                                  echo '<div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Ukuran files harus kurang dari 500 Kb!</strong>
                                        </div>';
                }else{
                    // mulai dari sini akan mengecek extensi dan tipe file nya, yg diperbolehkan adalah jpg, jpeg, png
                    if(isset($_FILES['images'])){
                    $img_name = $_FILES['images']['name'];
                    $img_type = $_FILES['images']['type'];
                    $tmp_name = $_FILES['images']['tmp_name'];
                    // explode untuk memecah menjadi array, bisa cek sendiri di google untuk penjelasan nya
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
                    // mengkategorikan ektensi file
                    $extensions = ["jpeg", "png", "jpg"];
                    // mencocokan extensi file
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        // mencocokan tipe file
                        if(in_array($img_type, $types) === true){

                            $time = time();
                            $new_img_name = 'am-chatapps-'.$time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                // mebuat uniqueid, dengan aturan 2 anka pertama tahun 4 sisanya diurutkan otomatis
                                $date=date('y');
                                $sql2=mysql_query("SELECT MAX(uniqueid) as maxid FROM users");
                                $data=mysql_fetch_array($sql2);
                                $maxid=$data['maxid'];
                                $noUrut= (int) substr($maxid, -4);
                                $noUrut++;                                
                                $newuniqueid=$date.sprintf('%04s',$noUrut);
                                $encrypt_pass = md5($password);
                                $status = "offline";
                                $insert_query = mysql_query("INSERT INTO users SET uniqueid='$newuniqueid', username='$username', password='$encrypt_pass', images='$new_img_name', status='$status'") or die(mysql_error());
                                echo '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Kamu berhasil mendaftar, silahkan klik login sekarang jika ingin memulai chat!</strong>
                                  </div>';
                                
                            }
                        }else{
                            echo '<div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Format files harus - jpeg, png, jpg!</strong>
                                  </div>';
                        }
                    }else{
                        echo '<div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Format files harus - jpeg, png, jpg!</strong>
                              </div>';
                    }
                }
                }
                
            }
      }
    ?>

      <header><center>Form Register Realtime Chat App by AM</center></header>
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
        <div class="field input">
          <label>Foto Profil</label>
          <input type="file" name="images" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="register">
        </div>
      </form>
      <div class="link">Sudah punya akun? <a href="index.php">Login sekarang</a></div>
    </section>
  </div>
  <script src="js/custome/pass-show-hide.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>



</html>
