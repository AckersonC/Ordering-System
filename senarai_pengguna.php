<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php, connection.php dan guard staff.php
include('header.php');
include('connection.php');
include('staff_guard.php');
?>

<h3>Senarai Pengguna</h3>
<!--Borang carian nama pembeli-->
<form action='' method='POST'>
    Carian Pengguna <br>
    Nama Pengguna: <input type='text' name='nama'>
                  <input type='submit' value='Cari'>
</form>

| <a href='pendaftaran.php'>Daftar Pengguna Baru</a>
| <a href='upload_pengguna.php'>Muat Naik Pengguna</a>


<!--Memanggil fail butang_saiz.php bagi membolehkan pengguna mengubah saiz tulisan-->
<?php include('butang_saiz.php');?>
<!--HEader bagi jadual untuk memaparkan senarai pembeli-->
<table width='100%' border='1' id='saiz'>
    <tr>
        <td>Nama</td>
        <td>ID Pengguna</td>
        <td>Kod Laluan</td>
        <td>No Tel</td>
        <td>Alamat</td>
        <td>Tindakan</td>
    </tr>
<?php

#syarat tambahan yang akan dimasukkan dalam arahan(query) senarai pengguna
$tambahan="";
if(!empty($_POST['nama']))
{
    $tambahan="where nama like '%".$_POST['nama']."%'";
}

#arahan query untuk mencari senarai nama pengguna
$arahan_papar="select* from pengguna $tambahan";

#laksanakan arahan mencari data pembeli
$laksana=mysqli_query($condb, $arahan_papar);

#mengambil data yang ditemui
    while ($m = mysqli_fetch_array($laksana))
    {
        #umpukkan data kepada tatasusunan bagi tujuan kemaskini staff
        $data_get=array(
            'namapengguna'      => $m['Nama'],
            'idpengguna'   => $m['IDPengguna'],
            'kodlaluan'      => $m['KodLaluan'],
            'notel'      => $m['NoTel'],
            'alamat'      => $m['Alamat']
        );

        #memaparkan senarai nama dalam jadual
        echo"<tr>
        <td>".$m['Nama']."</td>
        <td>".$m['IDPengguna']."</td>
        <td>".$m['KodLaluan']."</td>
        <td>".$m['NoTel']."</td>
        <td>".$m['Alamat']."</td>";

        #memaparkan navigasi untuk kemaskini dan hapus data staff
        echo"<td>

        |<a href='kemaskini_pengguna.php?".http_build_query($data_get)."'>
        Kemaskini</a>
        

        |<a href='proses_padam_pengguna.php?IDPengguna=".$m['IDPengguna']."'
        onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">Hapus</a>|

        </td>
        </tr>";
    }
?>
</table>
<?php include('footer.php');?>