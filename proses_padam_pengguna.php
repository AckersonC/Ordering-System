<?php
#memulakan fungsi session
session_start();

#menyemak kewujudan data GET idpengguna pengguna
if(!empty($_GET))
{

    #memanggil fail connection.php
    include('connection.php');

    #arahan untuk memadam data pengguna berdasarkan idpengguna yang dihantar(GET)
    $arahan = "delete from pengguna where IDPengguna='".$_GET['IDPengguna']."'";

    #melaksanakan arahan dan menguji proses padam rekod
    if(mysqli_query($condb,$arahan))
    {
        #jika data berjaya dipadan, papar popup dan buka fail senarai_pengguna.php
        echo "<script>alert('Data Berjaya Dipadamkan');
        window.location.href='senarai_pengguna.php';</script>";
    }
    else{
        #jika data gagal dipadam.papar popup dan buka fail senarai_pembeli.php
        echo "<script>alert('Data Gagal Dipadamkan');
        window.location.href='senarai_pengguna.php';</script>";
    }
}
else{
    #jika data GET tidak wujud (empty). papar popup dan buyka fail senarai_pengguna.php
    die("<script>alert('Ralat. Tidak dapat diakses terus');
    window.location.href='senarai_pengguna.php';</script>");
}
?>