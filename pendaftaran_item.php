<?php
#memulakan fungsi session
session_start();

#memanggil fail header.php dan staff_guard.php
include('header.php');
include('connection.php');
include('staff_guard.php');


if (isset($_FILES['gambar'])) {
    $target_dir = "C:\xampp\htdocs\sistemSPPS.com\img"; // Replace with the desired upload directory
    $target_file = $target_dir . basename($_FILES['gambar']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pendaftaran.css">
    <link rel="stylesheet" href="upload.css">
    <title>Pendaftaran Item</title>
</head>
<body>
<div class="content-container">
<!--Tajuk antaramuka-->
<h3>Pendaftaran Item Baru</h3>


<!--Borang Pendaftaran Item Baru-->
<form action = 'proses_pendaftaran_item.php' method='POST' enctype="multipart/form-data">
    <div>
        <label for="id">ID Item: </label>
        <input type='text' id="id" name='id' placeholder="Masukkan 2 digit ID unik" required>
    </div>
    <div>
        <label for="id">Nama Item: </label>
        <input type='text' id="nama" name='nama' placeholder="Masukkan nama makanan" required>
    </div>
    <div>
        <label for="harga">Harga Item: </label>
        <input type='text' id="harga" name='harga' placeholder="Masukkan harga makanan" required>
    </div>
    <div>
        <label for="ciri">Deskripsi Item: </label>
        <input style='height: 40px;' type="text" id="ciri" name='ciri' placeholder="Masukkan deskripsi makanan" required>
    </div>
    
        <div class="kategorimenu">
            <label for="kategorimenu">Kategori Item: </label>
                <select id="kategorimenu" name='KategoriMenu' required>
                    <option selected disabled>Sila pilih kategori makanan</option>
                
                    <?php

                    $sql_kategorimenu = "select distinct KategoriMenu from menu";
                    $laksana_carian=mysqli_query($condb,$sql_kategorimenu);
                    while ($m=mysqli_fetch_array($laksana_carian)){
                    echo "<option value='".$m['KategoriMenu']."'>".$m['KategoriMenu']."</option>";
                    }
                    ?>
                </select>
        </div>

        <div class="input-file-container">
            <input type='file' id="gambar" name='gambar' class="input-file">
            <label for="gambar" class="label-file">Gambar</label>
        </div>

<input type="submit" value="Daftar">
     
</form>
</div>


<?php include ('footer.php');?>
</body>
</html>