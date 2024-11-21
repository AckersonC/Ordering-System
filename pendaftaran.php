<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php
include('header.php');

?>

<!--Tajuk Antaramuka-->
<h3>Pendaftaran Pengguna Baharu</h3>
<!--Borang Pendaftaran Pembeli Baharu-->
<form action = 'proses_pendaftaran.php' method ='POST'>
    Nama:       <input type='text' name='nama' required> <br><br>
    Alamat:     <input type='text' name='alamat' required> <br><br>
    No. Tel:    <input type='text' name='notel' required> <br><br>
    No. ID:     <input type='text' name='idpengguna' required> <br><br>
    Kod Laluan: <input type='password' name='kodlaluan' required> <br><br>
    <input type='submit' value='Daftar'>
</form>
<?php include('footer.php');?>