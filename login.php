<?php
# Memulakan fungsi session
session_start();
# Memanggil fail header.php
include('header.php');?>
<title>Login Pengguna</title>
<link rel="stylesheet" href="login.css">
<div class="content-container">
    <h3>Login Pengguna</h3>
    <!-- Borang daftar masuk (log in/sign in) pembeli -->
    <form action='proses_login.php' method='POST'>
        <div>
            <label for='idpengguna'>No. ID:</label>
            <input type='text' id='idpengguna' name='idpengguna' placeholder='Masukkan ID anda' required>
        </div>
        <div>
            <label for='kodlaluan'>Kod Laluan:</label>
            <input type='password' id='kodlaluan' name='kodlaluan' placeholder='Masukkan kod laluan anda' required>
        </div>
        <div class="small-text"> <!-- Added class for small text -->
            <small>Sila hubungi staff untuk kemaskini akaun</small>
        </div>
        <input type='submit' value='Login'>
    </form>
</div><br><br><br><br>
<?php include('footer.php'); ?>
