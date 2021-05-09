<style type="text/css">

.input-row {
   width: 90%;
   height: 0px;
}
/*script untuk mengatur emoji agar diatas*/
.emoji-menu { bottom: 60px!important; }
.icon-smile:before {
    content: " ";
    width: 16px;
    height: 16px;
    display: flex;
    flex-direction: column-reverse;
    background: url(icon-smile.png);
}
</style>
<?php
session_start();
  if(!isset($_SESSION['uniqueid'])){
    header("location: ../logout.php");
}
if(isset($_POST['uniqueid']))
{
  // ambil data yg sudah dikirimkan oleh ajax, karena kita menggunakan post sebelumnya maka untuk mendapatkan nya kita gunakan post juga
  $uniqueid = $_POST['uniqueid'];
  include_once "../connect.php";
    $sql3 = mysql_query("SELECT*FROM users WHERE uniqueid=$uniqueid") or die(mysql_error());
    $response =mysql_fetch_assoc($sql3);
?>
          
          <header>
            <img src="images/<?php echo $response['images']; ?>" alt="" width="55" height="50">
            <div class="details">
              <span><?php echo $response['username']; ?></span>
              <p><?php echo $response['status']; ?></p>
            </div>
            
          </header>
<?php } ?>
          <div class="chat-box">
             <!-- disini ajax data chat dipanggil setiap 0,5 detik -->
          </div>
           
         <!-- bagian kita mnegirimkan form chat -->
          <form action="" class="typing-area" id="frmdata" method="POST">
            <!-- disini bagian kode yg akan dikirim ke ajaz yg meload setiap 0,5 detik di bawah -->
            <input type="text" id="incoming_id" name="incoming_id" class="incoming_id" value="<?php echo $response['uniqueid']; ?>" hidden>
            <div class="input-row">
              <p class="emoji-picker-container">
                <textarea class="input-field" data-emojiable="true"
              data-emoji-input="unicode" type="text" name="message"
              id="message" placeholder="Tulis pesan disini...">  </textarea>
              </p>
            </div>
             <input type="button" id="button" class="btn btn-primary btn-sm" value="Kirim">
          </form>

<!-- script emoji -->
<script type="text/javascript">
  $(function () {
    // ketika gambar emoji di klik 
      window.emojiPicker = new EmojiPicker({
        // status selector emoji kita jadikan true
        emojiable_selector: '[data-emojiable=true]',
        // lalu cari assetsnya di directory dibawah
        assetsPath: 'emojiassets/emoji-picker/lib/img/',
        popupButtonClasses: 'icon-smile'
      });

      window.emojiPicker.discover();
  });
</script>

<!-- ajax untuk mengirim data input pesan -->
<script type="text/javascript">
  $("#button").click(function(){    
      $.ajax({
             type:"post",
             url:"phpassets/insertchat.php",
             // serialize disni maksudnya kita tidak perlu mendeklarasikan setiap input, kita langsung kirimkan se data yg ada pada form dengan id #frmdata
             data:$("#frmdata").serialize(),
                success:function(data){
                  console.log("success");                               
                 }
             });
    // ketika data sudah masuk maka kita hilangkan/refresh chat inputnya dengan cara di bawah ini 
     $(".input-field").empty();

  });

</script>  

<!-- script untuk meload data setiap 0,5 detik -->
<script type="text/javascript">
// jquery ambil dokumen, ketika siap jalankan
$(document).ready(function(){
  // jalankan interval/refres setiap 0,5 detik
  setInterval(function () {
    // get data dari datachat lalu kembalikan dengan parameter datachat
    $.get('phpassets/datachat.php?incoming_id='+ $('#incoming_id').val(), function(datachat) {
      // tampilkan di class chat-box dengan script dibawah
      $('.chat-box').html(datachat);
    });
  }, 500);  
});

</script> 
