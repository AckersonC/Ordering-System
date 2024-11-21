<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php
include ('header.php');
?>

<!-- Tajuk antaramuka log masuk pengguna -->
 <h3>Login Pengguna</h3>

 <!-- borang daftar masuk (log in/sign in) pembeli-->
  <form action='proses_login.php' method='POST'>

  No. ID:     <input type='text' name='idpengguna' required><br><br>
  Kod Laluan: <input type='password' name='kodlaluan' required><br><br>
              <input type='submit' value='Login'>
</form>
<?php include ('footer.php'); ?>