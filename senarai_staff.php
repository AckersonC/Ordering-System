<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php, connection.php dan guard staff.php
include('header.php');
include('connection.php');
include('staff_guard.php');
?>
<title>Urus Staff</title>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="butang_saiz.css">
    <link rel="stylesheet" href="senarai.css">
    <script src="butang_saiz.js" defer></script>
    <script src="senarai.js" defer></script>
    <title>Ubah Saiz Tulisan</title>
</head>
<div  class="content-container">


<body>
<h3>Senarai Staff</h3>
<div class="flex-container">
    <button id="searchButton" class="button">Carian Staff</button>
    <a href='pendaftaran_staff.php' class='button-link'>Daftar Staff Baru</a>
    <a href='upload_staff.php' class='button-link'>Muat Naik Staff</a>
    <button id="ubahButton" class="font-button">Ubah Saiz Tulisan</button>
    <button class="font-button" onclick="window.print()">Cetak</button>
</div>
<!-- Search Popup -->
<div id="popup" class="popup">
    <span id="closePopup" class="close-button">X</span>
    <form action='' method='POST'>
        <p>Carian Staff</p>
        <div class="input-container">
        Nama Staff: <input type='text' name='nama' placeholder="Masukkan nama staff">
        </div>
        <div class="button-group">
            <input type='submit' value='Cari'>
            <button type='button' id='resetButton'>Reset</button>
        </div>
    </form>
</div>
<div id="popup-overlay" class="popup-overlay"></div>
<script>
        // JavaScript to handle the reset button
        document.getElementById('resetButton').addEventListener('click', function() {
            // Clear the input field
            document.querySelector('input[name="nama"]').value = '';

            // Optionally, submit the form or reload the page to display all results
            document.forms[0].submit(); // Submits the form to reset the filter
        });
    </script>

<!-- Font Size Adjustment Popup -->
<div id="ubahPopup" class="popup">
    <span id="closeUbahPopup" class="close-button">X</span>
    <div class="flex-container">
        <p>Ubah Saiz Tulisan | </p>
        <input name='reSize1' type='button' value='Reset' onclick='ubahsaiz(2)' class="font-button"/>
        <input name='reSize' type='button' value='&nbsp;+&nbsp;' onclick='ubahsaiz(1)' class="font-button"/>
        <input name='reSize2' type='button' value='&nbsp;-&nbsp;' onclick='ubahsaiz(-1)' class="font-button"/>
    </div>
</div>
<div id="ubah-popup-overlay" class="popup-overlay"></div>
<!--HEader bagi jadual untuk memaparkan senarai staff-->
<div class="table-container">
<table width='100%' border='1' id='saiz'>
    <tr>
        <th>Nama</th>
        <th>ID Staff</th>
        <th>Kod Laluan</th>
        <th>Tindakan</th>
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

        # memaparkan navigasi untuk kemaskini dan hapus data staff
        echo"<td>
        <a href='kemaskini_staff.php?".http_build_query($data_get)."' class='kemaskini-button-link'>Kemaskini</a>
        <a href='proses_padam_staff.php?idstaff=".$m['idstaff']."' class='hapus-button-link'
        onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">Hapus</a>
        </td>
        </tr>";
        
    }
?>
</table>
</div>
</div>
<?php include('footer.php');?>