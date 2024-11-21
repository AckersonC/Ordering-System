<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php dan staff_guard.php
include('header.php');
include('staff_guard.php');
?>
<!--Tajuk antaramuka-->
<h3>Pendaftaran Staff Baru</h3>

<!--Borang Pendaftaran Staff Baru-->
<form action = 'proses_pendaftaran_staff.php' method='POST'>
    Nama Staff: <input type='text' name='namastaff' required><br><br>
    No. ID: <input type='text' name='idstaff' required><br><br>
    Kod Laluan: <input type='password' name='kodlaluan_staff' required><br><br>
                <input type='submit' value='Daftar'>
</form>
<?php include ('footer.php');?>