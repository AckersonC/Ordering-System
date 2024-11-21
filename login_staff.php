<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php
include ('header.php')
?>

<!--Tajuk antaramuka log masuk staff -->
<h3>Login Staff</h3>

<!-- borang daftar masuk (log in) staff -->
 <form action='proses_login_staff.php' method='POST'>
    No. ID Staff: <input type='text' name='idstaff'><br><br>
    Kod Laluan: <input type='password' name='kodlaluan_staff'><br><br>
                <input type='submit' value='Login'>
</form>
<?php include('footer.php'); ?>