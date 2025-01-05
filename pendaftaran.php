<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php
include('header.php');
?>
<title>Pendaftaran Pengguna</title>
<!-- Link to the external CSS file -->
<link rel="stylesheet" href="pendaftaran.css">
<div class="content-container">
    <!-- Tajuk Antaramuka -->
    <h3>Pendaftaran Pengguna Baharu</h3>
    <!-- Borang Pendaftaran Pembeli Baharu -->
    <form action='proses_pendaftaran.php' method='POST'>
        <div>Nama: <input type='text' name='nama' placeholder='Masukkan nama penuh anda' required></div>
        <div>No. Tel: <input type='text' name='notel' placeholder='Masukkan nombor telefon anda tanpa -' required></div>
        <div>No. ID: <input type='text' name='idpengguna' placeholder='Masukkan 3 digit ID unik' required></div>
        <div class="password-container">
            Kata Laluan: 
            <input type='password' id='kodlaluan' name='kodlaluan' placeholder='Masukkan kata laluan anda' required>
        </div>
        <input type='submit' value='Daftar'>
    </form>
</div>
<?php include('footer.php'); ?>
