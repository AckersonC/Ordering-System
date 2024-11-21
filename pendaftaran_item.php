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

<!--Tajuk antaramuka-->
<h3>Pendaftaran Item Baru</h3>


<!--Borang Pendaftaran Item Baru-->
<form action = 'proses_pendaftaran_item.php' method='POST' enctype="multipart/form-data">
    Gambar: <input type='file' name='gambar' required><br><br>
    ID Item: <input type='text' name='id' required><br><br>
    Nama Item: <input type='text' name='nama' required><br><br>
    Harga Item: <input type='float' name='harga' required><br><br>
    Kategori Item: <select name='KategoriMenu' required><br><br>
                <option selected disabled>Sila pilih kategori makanan</option>
                
<?php

    $sql_kategorimenu = "select distinct KategoriMenu from menu";
    $laksana_carian=mysqli_query($condb,$sql_kategorimenu);
    while ($m=mysqli_fetch_array($laksana_carian)){
    echo "<option value='".$m['KategoriMenu']."'>".$m['KategoriMenu']."</option>";
        }
?>
                </select>
                <br><br>
                <button     type='submit'   name='btn_daftar'>Daftar</button>
        
</form>
<?php include ('footer.php');?>