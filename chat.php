 <?php
  session_start();
  if(!isset($_SESSION['uniqueid'])){
    header("location: logout.php");
  }
 include_once "header.php"; 
 ?>
<body>
<div class="wrapper">
    <div class="row">
      <!-- bagian user yg akan di chat -->
      <div class="col col-lg-4">
        <section class="users">
          <header>
            <!-- memangil data user yg login -->
            <?php
            include_once "connect.php";
            $uniqueid = $_SESSION['uniqueid'];
            $sql = mysql_query("SELECT*FROM users WHERE uniqueid=$uniqueid") or die(mysql_error());
            $row = mysql_fetch_assoc($sql);
              # code...   
            ?>
            <div class="content">
              <img src="images/<?php echo $row['images'];?>" alt="">
              <div class="details">
                <span>Me, <?php echo $row['username'];?></span>
                <p><?php echo $row['status'];?></p>
              </div>              
            </div>
            <a href="logout.php" class="btn btn-secondary btn-sm" onclick="return confirm('yakin ingin keluar?')">Logout</a>
          </header>
          <cite title="Source Title">Clik users untuk memulai chat</cite><p></p>
          <div class="users-list">
           <!-- disi tempat user di load -->   
           <?php include_once "phpassets/users.php"; ?>                                                         

          </div>
        </section>
      </div>
      <!-- bagian chat area -->
      <div class="col col-lg-8">            
        <section class="chat-area">                
            <div id="responsecontainer" align="center">
            <!-- disini tempat ajax di panggil berdasarkan id yaitu responsecontainer -->
            <cite title="Source Title">Clik users untuk memulai chat</cite> 
            </div>        
          </div>
        </section>
      </div></div>
    </div>
</div>
<!-- scrip untuk mencari chat ketika di klik -->
<script type="text/javascript">
// ketika komponen dengan class uniqueid di klik maka jalankan perintah di bawah 
  $('.uniqueid').click(function(){
    // kita tidak menggunakan serialize karena data yg diambil cuman1
    var formData = {
      'uniqueid': $(this).attr('value')
    };
    $.ajax({
          type: 'POST',
          url: 'phpassets/usersdetail.php',
          data: formData, success: function(response){
          // console log hanya untuk mengetes bisa kalian hilangkan nanti
          console.log("success");
          // ketika data success diproses maka tampilkan kembali pada div yg id nya responsecontainer dan dalam bentuk html
          $("#responsecontainer").html(response);
     }
     });
    });
</script>
</body>
</html>


