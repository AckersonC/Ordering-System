<?php
session_start();
include("connection.php");

$no_resit=$_GET['idresit'];

$sql="update resit set status = 'Pending' where idresit='$no_resit'";
$lak= mysqli_query($condb,$sql);

if(mysqli_affected_rows($condb)==1){
     die("<script>
     alert('Kemaskini Berjaya');
     window.location.href='laporan.php';
     </script>");
}else{
     die("<script>
     alert('Kemaskini Gagal');
     window.location.href='laporan.php';
     </script>");
}
?>