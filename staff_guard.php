<?php
#Menyemak nilao pembolehubah session['tahap']
if($_SESSION['tahap'] !="staff")
{
    #jika nilainya tidak sama dengan staff. aturcara akan dihentikan
    die("<script>alert('Sila Login');
    window.location.href='logout.php';</script>");
}
?>