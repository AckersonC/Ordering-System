<?php
#memulakan fungsi session
session_start();

#memanggil fail header, staff_guard, connection\
include('header.php');
include('staff_guard.php');
include('connection.php');
?>
<title>Urus Item</title>
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
<h3>Senarai Item</h3>
<div class="flex-container">
    <button id="kategoriButton" class="button">Kategori Menu</button>
    <a href='pendaftaran_item.php' class='button-link'>Daftar Item Baru</a>
    <a href='upload_item.php' class='button-link'>Muat Naik Item</a>
    <button id="ubahButton" class="font-button">Ubah Saiz Tulisan</button>
    <button class="font-button" onclick="window.print()">Cetak</button>
</div>

<!-- Kategori Menu Popup -->
<div id="kategoriPopup" class="popup">
    <span id="closeKategoriPopup" class="close-button">X</span>
    <form action='' method='POST'>
        <p>Kategori Menu</p>
        <select name='kategorimenu'>
            <option selected disabled>Sila memilih kategori menu</option>
            <?php
                $sql_kategorimenu = "SELECT DISTINCT KategoriMenu FROM menu";
                $laksana_carian=mysqli_query($condb,$sql_kategorimenu);
                while ($m=mysqli_fetch_array($laksana_carian)){
                    echo "<option value='".$m['KategoriMenu']."'>".$m['KategoriMenu']."</option>";
                }
            ?>
        </select>
        <div class="button-group">
            <input type='submit' value='Papar'>
            <button type='button' id='resetButton'>Reset</button>
        </div>
        
    </form>
</div>
<div id="kategori-popup-overlay" class="popup-overlay"></div>
<script>
        // JavaScript to handle the reset button
        document.getElementById('resetButton').addEventListener('click', function() {
            // Clear the input field
            document.querySelector('select[name="kategorimenu"]').value = '';

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

<!-- Header bagi jadual untuk memaparkan senarai barang -->
<div class="table-container">
    <table border='1' id='saiz'>
        <tr>
            <th style='text-align: center;'>Gambar</th>
            <th style='width: 200px; text-align: center;'>ID Menu</th>
            <th style='width: 200px; text-align: center;'>Nama Menu</th>
            <th style='width: 200px; text-align: center;'>Harga Menu</th>
            <th style='width: 200px; text-align: center;'>Deskripsi</th>
            <th style='width: 200px; text-align: center;'>Kategori Menu</th>
            <th style='width: 200px; text-align: center;'>Tindakan</th>
        </tr>
        <?php

        #syarat tambahan yang akan dimasukkan dalam arahan (query) senarai barang
        $tambahan="";
        if(!empty($_POST['kategorimenu']))
        {
            $tambahan= "AND menu.KategoriMenu = '".$_POST['kategorimenu']."'";
        }

        #arahan query untuk mencari data item
        $arahan_papar="SELECT * FROM menu
        WHERE menu.IDMenu = menu.IDMenu
        and menu.gambar = menu.gambar
        and menu.NamaMenu = menu.NamaMenu
        and menu.Harga = menu.Harga
        and menu.ciri=menu.ciri
        $tambahan
        ORDER BY CASE WHEN kategorimenu = 'makanan' THEN 1 ELSE 0 END DESC, namamenu ASC";

        #laksanakan arahan mencari data barang
        $laksana = mysqli_query($condb, $arahan_papar);

        #mengambil data yang ditemui
        while($m = mysqli_fetch_array($laksana))
        {
            #umpukkan data kpd tatasusunan bagi tujuan kemaskini barang
            $data_get=array(
                'IDMenu'        => $m['IDMenu'],
                'Gambar'        => $m['gambar'],
                'NamaMenu'        => $m['NamaMenu'],
                'Harga'        => $m['Harga'],
                'ciri'          =>$m['ciri'],
                'KategoriMenu'        => $m['KategoriMenu']
            );

            #memaparkan senarai nama dalam jadual
            echo "
            <tr>
            <td><img width='150px%' src='img/".$m['gambar']."'></td>
            <td style='width: 200px; text-align: center;'>".$m['IDMenu']."</td>
            <td style='width: 200px; text-align: center;'>".$m['NamaMenu']."</td>
            <td style='width: 200px; text-align: center;'>".$m['Harga']."</td>
            <td style='width: 200px; text-align: center;'>".$m['ciri']."</td>
            <td style='width: 200px; text-align: center;'>".$m['KategoriMenu']."</td>
            ";

        # memaparkan navigasi untuk kemaskini dan hapus data item
        echo"<td>
        <a href='kemaskini_item.php?".http_build_query($data_get)."' class='kemaskini-button-link'>Kemaskini</a>
        <a href='proses_padam_item.php?IDMenu=".$m['IDMenu']."' class='hapus-button-link'
        onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">Hapus</a>
        </td>
        </tr>";
        }
        ?>
    </table>
</div>
</div>
<?php include('footer.php');?>
