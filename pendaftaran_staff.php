<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php dan staff_guard.php
include('header.php');
include('staff_guard.php');
?>
<title>Pendaftaran Staff</title>
<!-- Link to the external CSS file -->
<link rel="stylesheet" href="pendaftaran.css">
<div class="content-container">
<!--Tajuk antaramuka-->
<h3>Pendaftaran Staff Baru</h3>

<!--Borang Pendaftaran Staff Baru-->
<form action = 'proses_pendaftaran_staff.php' method='POST'>
    <div>Nama Staff: <input type='text' name='namastaff' placeholder="Masukkan nama penuh anda" required></div>
    <div>No. ID: <input type='text' name='idstaff' placeholder="Masukkan 3 digit ID unik" required></div>
    <div>Kata Laluan: <input type='password' name='kodlaluan_staff' placeholder="Masukkan kata laluan anda" required></div>
                <input type='submit' value='Daftar'>
</form>
</div>
<?php include ('footer.php');?>