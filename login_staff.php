<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php
include('header.php');
?>
<title>Login Staff</title>
<!-- Link to the external CSS file -->
<link rel="stylesheet" href="login_staff.css">
<div class="content-container">
    <!-- Tajuk antaramuka log masuk staff -->
    <h3>Login Staff</h3>

    <!-- Borang daftar masuk (log in) staff -->
    <form action='proses_login_staff.php' method='POST'>
        <div>
            <label for='idstaff'>No. ID Staff:</label>
            <input type='text' id='idstaff' name='idstaff' placeholder='Masukkan ID anda' required>
        </div>
        <div>
            <label for='kodlaluan_staff'>Kod Laluan:</label>
            <input type='password' id='kodlaluan_staff' name='kodlaluan_staff' placeholder='Masukkan kod laluan anda' required>
        </div>
        <input type='submit' value='Login'>
    </form>
</div><br><br><br><br><br>


<?php include('footer.php'); ?>
