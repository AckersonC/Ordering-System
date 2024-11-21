<?php
#Menyemak nilao pembolehubah session['tahap']
if($_SESSION['tahap'] !="pengguna")
{
    #jika nilainya tidak sama dengan pembeli. aturcara akan dihentikan
    die("<script>alert('Sila Login');
    window.location.href='logout.php';</script>");
}
?>