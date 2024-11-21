<?php

#memulakan fungsi session
session_start();

#memanggul fail header dan staff guard
include('header.php');
include('staff_guard.php');
?>

<!--Tajuk laman -->
<h3>Muat Naik Data Staff (*.txt)</h3>

<!-- Borang utk memuat naik fail-->
<form action='proses_upload_staff.php' method='POST' enctype='multipart/form-data'>
    <h3><b>Sila pilih fail txt yang ingin dimuat naik</b></h3>
    <input      type='file'     name='data_staff'><br><br>
    <button     type='submit'   name='btn_upload'>Muat Naik</button>
</form>
<?php include('footer.php');?>