<?php
#memula session
session_start();

#menghantar tatasusunan session order jika tak wujud
if(!isset($_SESSION["orders"])){
     $_SESSION['orders']=array();
}

#menambah elemen ke dalam session orders
array_push($_SESSION['orders'], $_GET['IDMenu']);
if($_GET['page']=="menu"){
     echo"<script>window.location.href='menu.php?jenis=".$_GET['jenis']."';</script>";
} else{
     echo"<script>window.location.href='tempah-cart.php';</script>";
}
?>