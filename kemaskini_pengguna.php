<?php

#memulakan fungsi session
session_start();

#memanggil fail header
include('header.php');
include('staff_guard.php');

#menyemak kewujudan data GET. Jiaka data GET empty, buka fail senarai_staff
if(empty($_GET)){
    die("<script>window.loacation.href='senarai_pengguna.php';</script>");
}
?>
<title>Kemaskini Data Pengguna</title>
<!-- Link to the external CSS file -->
<link rel="stylesheet" href="pendaftaran.css">
<div class="content-container">

    <h3>Kemaskini Data Pengguna</h3>

    <form action='proses_kemaskini_pengguna.php?idpengguna_lama=<?= $_GET['idpengguna'] ?>' method='POST'>

    <div>Nama:
    <input type='text' name='nama' value='<?= $_GET['namapengguna'] ?>' required></div>

    <div>No. ID:
    <input type='text' name='id'value='<?= $_GET['idpengguna'] ?>' required></div>

    <div>Kata Laluan:
    <input type='text' name='kod_laluan'value='<?= $_GET['kodlaluan'] ?>' required></div>

    <div>No Tel:
    <input type='text' name='notel'value='<?= $_GET['notel'] ?>' required></div>

    <input type='submit' value='Kemaskini'>
            
    </form>
</div>
<?php include ('footer.php');?>
