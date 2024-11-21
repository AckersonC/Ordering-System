<?php
#memulakan fungsi session
session_start();

#menyemak kewujudan data post yang dihantar dari login.php
if(!empty($_POST['idstaff']) and !empty($_POST['kodlaluan_staff']))
{
    #memanggil fail connection php
    include ('connection.php');

    #Arahan SQL (query) untuk membandingkan data yang dimasukkan
    #wujud di pangkalan data atau tidak
    $query_login = "select * from staff
    where
            idstaff = '".$_POST['idstaff']."'
    and     kodlaluan_staff  = '".$_POST['kodlaluan_staff']."'";
    
    #melaksanakan arahan membandingkan data
    $laksana_query = mysqli_query($condb, $query_login);

    #jika terdapat 1 data yang sepadan, login berjaya
    if (mysqli_num_rows($laksana_query)==1)
    {
        #mengambil data yang ditemui
        $m = mysqli_fetch_array($laksana_query);

        #mengumpukkan kepada pembolehubah session tahap
        $_SESSION['idstaff'] = $m["idstaff"];
        $_SESSION['tahap'] = "staff";

        #membukakan laman index.php
        echo"<script>window.location.href='index.php';</script>";
    }
    else
    {
        #login gagal. kembali ke laman login.php
        echo"<script>alert('Login Gagal');
        window.location.href='login_staff.php';</script>";
    }
}    
else
{
    #jika tidada data yang dihantar dari laman login.php
    echo"<script>alert('Sila masukkan ID Pengguna dan Kod Laluan');
    window.location.href='login.php';</script>";
}
?>