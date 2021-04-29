<?php
session_start();
error_reporting(0);
include_once "connect.php";
$uniqueid=$_SESSION['uniqueid'];
mysql_query("UPDATE users SET status='offline' WHERE uniqueid=$uniqueid");
session_destroy();
echo '<script language="javascript">alert("Anda berhasil Logout!"); document.location="index.php";</script>';
?>