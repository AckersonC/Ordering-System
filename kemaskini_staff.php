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

<h3>Kemaskini Data Staff</h3>

<form action='proses_kemaskini_staff.php?idstaff_lama=<?= $_GET['idstaff'] ?>' method='POST'>

Nama:
<input type='text' name='nama' value='<?= $_GET['namastaff'] ?>' required><br><br>

No. ID:
<input type='text' name='id'value='<?= $_GET['idstaff'] ?>' required><br><br>

Kod Laluan:
<input type='text' name='kod_laluan'value='<?= $_GET['kodlaluan_staff'] ?>' required><br><br>
<input type='submit' value='Kemaskini'>
        
</form>
<?php include ('footer.php');?>
