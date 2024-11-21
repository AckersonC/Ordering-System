<?php

#memulakan fungsi session
session_start();

#memanggil fail staff_guard.php
include ('staff_guard.php');

#menyemak kewujudan data post
if(!empty($_POST))
{
    #memanggil fail connection
    include('connection.php');



    #pengesahan data(validation)
    if($_POST['harga'] <= 0)
    {
        die ("<script>alert('Ralat maklumat');
        window.history.back();</script>");
    }

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = 'img/';
        $filename = basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $filename;
    
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        #arahan sql (query) utk kemaskini maklumat barang
        $arahan     =       "update menu set
        gambar      =       '".$_POST['gambar']."',
        IDMenu    =       '".$_POST['id']."',
        NamaMenu    =       '".$_POST['nama']."',
        Harga    =       '".$_POST['harga']."',
        KategoriMenu    =       '".$_POST['kategorimenu']."'
        where
        IDMenu      =       '".$_GET['idmenu_lama']."'";
        } else {
            $arahan     =       "update menu set
            IDMenu    =       '".$_POST['id']."',
            NamaMenu    =       '".$_POST['nama']."',
            Harga    =       '".$_POST['harga']."',
            KategoriMenu    =       '".$_POST['kategorimenu']."'
            where
            IDMenu      =       '".$_GET['idmenu_lama']."'";
    }}
    #melaksanakan dan menyemak proses kemaskini
    if(mysqli_query($condb, $arahan))
    {
        #kemaskini berjaya
        echo"<script>alert('Kemaskini Berjaya');
        window.location.href='senarai_item.php';</script>";
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
    window .location.href='senarai_item.php';</script>");
}
?>