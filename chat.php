 <?php
  session_start();
  if(!isset($_SESSION['uniqueid'])){
    header("location: logout.php");
  }
 include_once "header.php"; 
 ?>
<body>

<div class="wrapper">
  <!-- Button trigger modal -->
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
          <!-- bagian search -->
          <div class="input-group mb-3">
            <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><img src="search.svg"></span>
            </div>
          </div>
          <div class="users-list">
           <!-- disi tempat user di load -->   
           <ul id="Search">
              <?php
                if(!isset($_SESSION['uniqueid'])){
                  header("location: ../logout.php");
              }
                          $uniqueid = $_SESSION['uniqueid'];
                          $sql2 = mysql_query("SELECT*FROM users WHERE uniqueid!=$uniqueid ORDER BY user_id ASC") or die(mysql_error());
                          while ($row2 = mysql_fetch_assoc($sql2)) {
                            # code...   
                       ?>
                  <li class="btn">           
                  <a class="btn uniqueid"  value="<?php echo $row2['uniqueid']; ?>">
                    <div class="content">
                        <img src="images/<?php echo $row2['images'];?>" alt="">
                          <div class="details">
                            <span><?php echo $row2['username'];?></span>
                          </div>
                    </div>
                  </a>
                  </li>
                                  
              <?php } ?>
              </ul>                                                      

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

<!-- scrit untuk search -->
<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("Search");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

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


