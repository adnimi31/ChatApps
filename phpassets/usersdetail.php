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
            <input type="text" id="message" name="message"  class="form-control"  placeholder="Type a message here..." autocomplete="off">
             <input type="button" id="button" class="btn btn-primary btn-sm" value="Kirim">
          </form>

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
    document.getElementById('message').value = '';

  });

</script>  

<!-- script untuk meload data setiap 0,5 detik -->
<script type="text/javascript">
setInterval(() =>{
    // cari form dengan class typing-area
    const form = document.querySelector(".typing-area"),
    //setelah form dengan class tersebut ditemukan cari didalamnya dengan class incoming_id
    incoming_id = form.querySelector(".incoming_id").value,
    chatBox = document.querySelector(".chat-box");
    // mulai httprequest
    let xhr = new XMLHttpRequest();
    // lalu buat method dan url pengeksekusianya
    xhr.open("POST", "phpassets/datachat.php", true);
    //lalu load
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        //jika statusnya 200 (ok)
          if(xhr.status === 200){
            // maka buat variable data respon nya 
            let data = xhr.response;
            //dan kembalikan datanya yg didalamnya ada html
            chatBox.innerHTML = data;
            
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // kirim data incoming_id tersebut
    xhr.send("incoming_id="+incoming_id);
}, 500);


</script>  
    