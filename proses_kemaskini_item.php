<?php

#memulakan fungsi session
session_start();

#memanggil fail header
include('header.php');
include('connection.php');
include('staff_guard.php');

#menyemak kewujudan data GET. Jiaka data GET empty, buka fail senarai_item
if (empty($_GET)) {
    die("<script>window.location.href='senarai_item.php';</script>");
}

# Check if POST data exists
if (!empty($_POST)) {
    #pengesahan data(validation)
    if ($_POST['harga'] <= 0) {
        die("<script>alert('Ralat maklumat'); window.history.back();</script>");
    }

    $target_dir = 'img/';
    $filename = isset($_FILES['gambar']['name']) ? basename($_FILES['gambar']['name']) : '';
    $target_file = $target_dir . $filename;

    if (!empty($filename)) {

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $arahan = "UPDATE menu SET
                gambar = '$filename',
                IDMenu = '".$_POST['id']."',
                NamaMenu = '".$_POST['nama']."',
                Harga = '".$_POST['harga']."',
                ciri='".$_POST['ciri']."',
                KategoriMenu = '".$_POST['kategorimenu']."'
                WHERE IDMenu = '".$_GET['idmenu_lama']."'";
        } else {
            die("<script>alert('Gagal memuat naik gambar'); window.history.back();</script>");
        }
    } else {
        $arahan = "UPDATE menu SET
            IDMenu = '".$_POST['id']."',
            NamaMenu = '".$_POST['nama']."',
            Harga = '".$_POST['harga']."',
            ciri = '".$_POST['ciri']."',
            KategoriMenu = '".$_POST['kategorimenu']."'
            WHERE IDMenu = '".$_GET['idmenu_lama']."'";
    }

    #melaksanakan dan menyemak proses kemaskini
    
    if (mysqli_query($condb, $arahan)) {
        echo "<script>alert('Kemaskini Berjaya'); window.location.href='senarai_item.php';</script>";
    } else {
        echo "<script>alert('Kemaskini Gagal'); window.history.back();</script>";
    }
} else {
    die("<script>alert('Sila lengkapkan data'); window.location.href='senarai_item.php';</script>");
}
?>
