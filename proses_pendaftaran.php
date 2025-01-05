<?php
#memulakan fungsi session
session_start();

#menyemak kewujudan data post
if (!empty($_POST)) {
    include ('connection.php');

    #data validation: had atas had bawah
    if(strlen($_POST['idpengguna']) !=3 or !is_numeric($_POST['idpengguna']) )
    {
        die("<script>alert ('Ralat Pada No. ID');
        window.location.href='pendaftaran.php'; </script>");
    }

    #arahan SQL untuk menyimpan data pembeli baru
    $sql_simpan = "insert into pengguna
    (idpengguna, notel, kodlaluan, nama)
    values
    ('".$_POST['idpengguna']."', '".$_POST['notel']."', '".$_POST['kodlaluan']."', 
    '".$_POST['nama']."')";

    #melaksanakan arahan simpan data pembeli baru
    $laksana_query = mysqli_query($condb, $sql_simpan);

    #menyemak jika proses menyimpan data berjaya atau tidak
    if($laksana_query)
    {
        #jika berjaya, papar popup dan buka fail index.php
        echo"(<script>alert('Pendaftaran Berjaya');
        window.location.href='login.php'; </script>";
    }
    else
    {
        #jika gagal, papar popup dan buka fail pendaftaran.php
        echo"<script>alert('Pendaftaran Gagal');
        window.location.href='pendaftaran.php'; </script>";
    }
}
else
{
        #jika pengguna membuka fail ini tanpa mengisi data.
        #minta pengguna isi data terlebih dahulu
        echo"<script>alert('Sila lengkapkap maklumant anda');
        window.location.href='pendaftaran.php';</script>";
}
?>