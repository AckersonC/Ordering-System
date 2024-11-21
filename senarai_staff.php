<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php, connection.php dan guard staff.php
include('header.php');
include('connection.php');
include('staff_guard.php');
?>

<h3>Senarai Staff</h3>

<!--Borang carian nama pembeli-->
<form action='' method='POST'>
    Carian Staff <br>
    Nama Staff: <input type='text' name='nama'>
                  <input type='submit' value='Cari'>
</form>

| <a href='pendaftaran_staff.php'>Daftar Staff Baru</a>
| <a href='upload_staff.php'>Muat Naik Staff</a>

<!--Memanggil fail butang_saiz.php bagi membolehkan pengguna mengubah saiz tulisan-->
<?php include('butang_saiz.php');?>
<!--HEader bagi jadual untuk memaparkan senarai staff-->
<table width='100%' border='1' id='saiz'>
    <tr>
        <td>Nama</td>
        <td>ID Staff</td>
        <td>Kod Laluan</td>
        <td>Tindakan</td>
    </tr>
<?php

$tambahan="";
if(!empty($_POST['nama']))
{
    $tambahan="where namastaff like '%".$_POST['nama']."%'";
}


#arahan query untuk mencari senarai nama staff
$arahan_papar="select* from staff $tambahan";

#laksanakan arahan mencari data pembeli
$laksana=mysqli_query($condb, $arahan_papar);

#mengambil data yang ditemui
    while ($m = mysqli_fetch_array($laksana))
    {
        #umpukkan data kepada tatasusunan bagi tujuan kemaskini staff
        $data_get=array(
            'namastaff'      => $m['namastaff'],
            'idstaff'   => $m['idstaff'],
            'kodlaluan_staff'      => $m['kodlaluan_staff']
        );

        #memaparkan senarai nama dalam jadual
        echo "<tr>
        <td>".$m['namastaff']."</td>
        <td>".$m['idstaff']."</td>
        <td>".$m['kodlaluan_staff']."</td>";

        #memaparkan navigasi untuk kemaskini dan hapus data staff
        echo"<td>
        |<a href='kemaskini_staff.php?".http_build_query($data_get)."'>
        Kemaskini</a>
        
        |<a href='proses_padam_staff.php?staffid=".$m['idstaff']."'
        onCLick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">
        Hapus</a>|
        </td>
        </tr>";
        
    }
?>
</table>
<?php include('footer.php');?>