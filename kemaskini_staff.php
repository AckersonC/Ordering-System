<?php

#memulakan fungsi session
session_start();

#memanggil fail header
include('header.php');
include('staff_guard.php');

#menyemak kewujudan data GET. Jiaka data GET empty, buka fail senarai_staff
if(empty($_GET)){
    die("<script>window.loacation.href='senarai_staff.php';</script>");
}
?>
<title>Kemaskini Data Staff</title>
<!-- Link to the external CSS file -->
<link rel="stylesheet" href="pendaftaran.css">
<div class="content-container">

    <h3>Kemaskini Data Staff</h3>

    <form action='proses_kemaskini_staff.php?idstaff_lama=<?= $_GET['idstaff'] ?>' method='POST'>

    <div>Nama:
    <input type='text' name='nama' value='<?= $_GET['namastaff'] ?>' required></div>

    <div>No. ID:
    <input type='text' name='id'value='<?= $_GET['idstaff'] ?>' required></div>

    <div>Kata Laluan:
    <input type='text' name='kod_laluan'value='<?= $_GET['kodlaluan_staff'] ?>' required></div>
    <input type='submit' value='Kemaskini'>
            
    </form>
</div>
<?php include ('footer.php');?>
