<?php
#memulakan fungsi session
session_start();

#menyemak kewujudan data post yang dihantar dari login.php
if(!empty($_POST['idpengguna']) and !empty($_POST['kodlaluan']))
{
    #memanggil fail connection php
    include ('connection.php');

    #Arahan SQL (query) untuk membandingkan data yang dimasukkan
    #wujud di pangkalan data atau tidak
    $query_login = "select * from pengguna
    where
            idpengguna = '".$_POST['idpengguna']."'
    and     kodlaluan  = '".$_POST['kodlaluan']."'Limit 1";
    
    #melaksanakan arahan membandingkan data
    $laksana_query = mysqli_query($condb, $query_login);

    #jika terdapat 1 data yang sepadan, login berjaya
    if (mysqli_num_rows($laksana_query)==1)
    {
        #mengambil data yang ditemui
        $m = mysqli_fetch_array($laksana_query);

        #mengumpukkan kepada pembolehubah session tahap
        $_SESSION['tahap'] = 'pengguna';
        $_SESSION['nama'] = $m['Nama'];
        $_SESSION['id'] = $m['IDPengguna'];

        #membukakan laman index.php
        echo"<script>window.location.href='menu.php';</script>";
    }
    else
    {
        #login gagal. kembali ke laman login.php
        echo"<script>alert('Login Gagal');
        window.location.href='login.php';</script>";
    }
}    
else
{
    #jika tidada data yang dihantar dari laman login.php
    echo"<script>alert('Sila masukkan ID Pengguna dan Kod Laluan');
    window.location.href='login.php';</script>";
}
?>