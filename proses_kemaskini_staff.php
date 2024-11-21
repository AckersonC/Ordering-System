<?php

#memulakan fungsi session
session_start();

#memanggil fail header
include('staff_guard.php');

#menyemak kewujudan data GET. Jiaka data GET empty, buka fail senarai_item
if(!empty($_POST))
{
    #memanggil fail connection.php
    include('connection.php');
    
    #pengesahan data (validation) idstaff
    if (strlen($_POST['id']) != 3 or !is_numeric($_POST['id']))
    {
        die("<script>alert('Ralat No. ID');
        window.history.back();</script>");
    }
    
    #arahan sql (query) utk kemaskini maklumat staff
    $arahan     =       "update staff set
    namastaff   =       '".$_POST['nama']."',
    idstaff   =       '".$_POST['id']."',
    kodlaluan_staff   =       '".$_POST['kod_laluan']."'
    where
    idstaff         =       '".$_GET['idstaff_lama']."'";

    #melaksana dan menyemak proses kemaskini
    if(mysqli_query($condb, $arahan))
    {
        #kemaskini berjaya
        echo"<script>alert('Kemaskini Berjaya');
        window.location.href='senarai_staff.php';</script>";
    }
    else
    {
        #kemaskini gagal
        echo"<script>alert('Kemaskini Gagal');
        window.history.back();</script>";
    }
}
else
{
    #jika data GET tidak wujud. kembali ke failo senarai_staff.php 
    die("<script>alert('Sila lengkapkan data');
    window .location.href='senarai_staff.php';</script>");
}
?>

