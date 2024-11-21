<?php
#memulakan fungsi session
session_start();

#menyemak kewujudan data post
if (!empty($_POST)) {
    include ('connection.php');

    #data validation: had atas had bawah
    if(strlen($_POST['idstaff']) !=3 or !is_numeric($_POST['idstaff']) or
    strlen($_POST['kodlaluan_staff']) !=4 or !is_numeric($_POST['kodlaluan_staff'])) 
    {
        die("<script>alert ('Ralat Pada No. ID');
        window.location.href='pendaftaran_staff.php'; </script>");
    }

    #arahan SQL untuk menyimpan data pembeli baru
    $sql_simpan = "insert into staff
    (idstaff, kodlaluan_staff, namastaff)
    values
    ('".$_POST['idstaff']."', '".$_POST['kodlaluan_staff']."', '".$_POST['namastaff']."')";

    #melaksanakan arahan simpan data pembeli baru
    $laksana_query = mysqli_query($condb, $sql_simpan);

    #menyemak jika proses menyimpan data berjaya atau tidak
    if($laksana_query)
    {
        #jika berjaya, papar popup dan buka fail index.php
        echo"(<script>alert('Pendaftaran Berjaya');
        window.location.href='senarai_staff.php'; </script>";
    }
    else
    {
        #jika gagal, papar popup dan buka fail pendaftaran.php
        echo"<script>alert('Pendaftaran Gagal');
        window.location.href='pendaftaran_staff.php'; </script>";
    }
}
else
{
        #jika pengguna membuka fail ini tanpa mengisi data.
        #minta pengguna isi data terlebih dahulu
        echo"<script>alert('Sila lengkapkap maklumant anda');
        window.location.href='pendaftaran_staff.php';</script>";
}
?>