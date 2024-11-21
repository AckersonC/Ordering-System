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

<h3>Kemaskini Data Pengguna</h3>

<form action='proses_kemaskini_pengguna.php?idpengguna_lama=<?= $_GET['idpengguna'] ?>' method='POST'>

Nama:
<input type='text' name='nama' value='<?= $_GET['namapengguna'] ?>' required><br><br>

No. ID:
<input type='text' name='id'value='<?= $_GET['idpengguna'] ?>' required><br><br>

Kod Laluan:
<input type='text' name='kod_laluan'value='<?= $_GET['kodlaluan'] ?>' required><br><br>

No Tel:
<input type='text' name='notel'value='<?= $_GET['notel'] ?>' required><br><br>

Alamat:
<input type='text' name='alamat'value='<?= $_GET['alamat'] ?>' required><br><br>
<input type='submit' value='Kemaskini'>
        
</form>
<?php include ('footer.php');?>
