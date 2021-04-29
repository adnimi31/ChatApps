<?php
session_start(); 
    if(isset($_SESSION['uniqueid'])){
        include_once "../connect.php";
        $outgoing_id = $_SESSION['uniqueid'];
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];
        if(!empty($message)){
            $sql = mysql_query("INSERT INTO message SET incoming_id='$incoming_id', outgoing_id='$outgoing_id',pesan='$message'") or die(mysql_error());
        }
    }else{
        header("location: ../logout.php");
    }


 ?>