<?php
session_start();

$key = array_search($_GET['IDMenu'], $_SESSION['orders']);

if($key !== false){
     unset($_SESSION['orders'][$key]);
}

$_SESSION['orders'] = array_values($_SESSION['orders']);

echo"<script>window.location.href='tempah-cart.php';</script>";
?>