<?php 
session_start();
  if(!isset($_SESSION['uniqueid'])){
    header("location: ../logout.php");
}
$outgoing_id=$_SESSION['uniqueid'];
$incoming_id=$_POST['incoming_id'];
include_once "../connect.php";
    $sql = mysql_query("SELECT*FROM message WHERE incoming_id=$incoming_id AND outgoing_id=$outgoing_id OR incoming_id=$outgoing_id AND outgoing_id=$incoming_id  ORDER BY message_id DESC") or die(mysql_error());
    // penting: data chat harus order desc yg berarti tampilkan dari bawah, karena  pada css kita revers load chatnya
    if(mysql_num_rows($sql) > 0){
    while ($response =mysql_fetch_assoc($sql)) {    
        if ($response['outgoing_id']===$outgoing_id ) {
            // disni scrip chat kita ditampilkan
            $output= '<div class="chat outgoing">
                  <div class="details">
                    <p style="text-align: left;" >
                    '.$response['pesan'].'
                    <br>
                    <span style="font-size: 10px;" >'.$response['waktu'].'</span>
                    </p>
                  </div>
                </div>';
        }else{
            //disni script chat lawan kita ditampilkan
            $output= '<div class="chat incoming">
                  <div class="details">
                    <p style="text-align: left;" >
                    '.$response['pesan'].'
                    <br>
                    <span style="font-size: 10px;" >'.$response['waktu'].'</span>
                    </p>
                  </div>
                </div>';
        }    
    
	echo $output;
    }
    }else{
        $output2 = '<div class="text">Belum pernah berkirim pesan dengan users ini.</div>';
        echo $output2;
    }
?>			