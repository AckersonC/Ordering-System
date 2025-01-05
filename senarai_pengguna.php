<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php, connection.php dan guard staff.php
include('header.php');
include('connection.php');
include('staff_guard.php');
?>
<title>Urus Pengguna</title>
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
<body>
<div class="content-container">
<h3>Senarai Pengguna</h3>
<div class="flex-container">
    <button id="searchButton" class="button">Carian Pengguna</button>
    <a href='pendaftaran.php' class='button-link'>Daftar Pengguna Baru</a>
    <a href='upload_pengguna.php' class='button-link'>Muat Naik Pengguna</a>
    <button id="ubahButton" class="font-button">Ubah Saiz Tulisan</button>
    <button class="font-button" onclick="window.print()">Cetak</button>
</div>

<!-- Search Popup -->
<div id="popup" class="popup">
    <span id="closePopup" class="close-button">X</span>
    <form action='' method='POST'>
        <p>Carian Pengguna</p>
        <div class="input-container">
        Nama Pengguna: <input type='text' name='nama' placeholder="Masukkan nama pengguna">
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



<!-- Header bagi jadual untuk memaparkan senarai pembeli -->
<div class="table-container">
<table width='100%' border='1' id='saiz'>
    <tr>
        <th>Nama</th>
        <th>ID Pengguna</th>
        <th>Kod Laluan</th>
        <th>No Tel</th>
        <th>Tindakan</th>
    </tr>
<?php

# syarat tambahan yang akan dimasukkan dalam arahan(query) senarai pengguna
$tambahan="";
if(!empty($_POST['nama']))
{
    $tambahan="where nama like '%".$_POST['nama']."%'";
}

# arahan query untuk mencari senarai nama pengguna
$arahan_papar="select* from pengguna $tambahan";

# laksanakan arahan mencari data pembeli
$laksana=mysqli_query($condb, $arahan_papar);

# mengambil data yang ditemui
    while ($m = mysqli_fetch_array($laksana))
    {
        # umpukkan data kepada tatasusunan bagi tujuan kemaskini staff
        $data_get=array(
            'namapengguna'      => $m['Nama'],
            'idpengguna'   => $m['IDPengguna'],
            'kodlaluan'      => $m['KodLaluan'],
            'notel'      => $m['NoTel']
        );

        # memaparkan senarai nama dalam jadual
        echo"<tr>
        <td>".$m['Nama']."</td>
        <td>".$m['IDPengguna']."</td>
        <td>".$m['KodLaluan']."</td>
        <td>".$m['NoTel']."</td>";

        # memaparkan navigasi untuk kemaskini dan hapus data staff
        echo"<td>
        <a href='kemaskini_pengguna.php?".http_build_query($data_get)."' class='kemaskini-button-link'>Kemaskini</a>
        <a href='proses_padam_pengguna.php?IDPengguna=".$m['IDPengguna']."' class='hapus-button-link'
        onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">Hapus</a>
        </td>
        </tr>";
    }
?>
</table>
</div>
</div>
<?php include('footer.php');?>
