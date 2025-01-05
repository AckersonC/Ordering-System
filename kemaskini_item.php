<?php

#memulakan fungsi session
session_start();

#memanggil fail header
include('header.php');
include('connection.php');
include('staff_guard.php');

#menyemak kewujudan data GET. Jiaka data GET empty, buka fail senarai_item
if(empty($_GET)){
    die("<script>window.location.href='senarai_item.php';</script>");
}
?>
    
<link rel="stylesheet" href="pendaftaran.css">
<link rel="stylesheet" href="upload.css">
<title>Kemaskini Data Item</title>

<div class="content-container">

<h3>Kemaskini Data Item</h3>

<form action='proses_kemaskini_item.php?idmenu_lama=<?= $_GET['IDMenu'] ?>' method='POST' enctype="multipart/form-data">

    <div>
        <label for="id">No. ID:</label>
        <input type='text' id="id" name='id' value='<?= $_GET['IDMenu'] ?>' required>
    </div>

    <div>
        <label for="nama">Nama Item:</label>
        <input type='text' id="nama" name='nama' value='<?= $_GET['NamaMenu'] ?>' required>
    </div>

    <div>
        <label for="harga">Harga Item:</label>
        <input type='text' id="harga" name='harga' value='<?= $_GET['Harga'] ?>' required>
    </div>

    <div>
        <label for="ciri">Deskripsi:</label>
        <input style='height: 40px;' type='text' id="ciri" name='ciri' value='<?= $_GET['ciri'] ?>' required>
    </div>
    
    <div class="kategorimenu">
        <label for="kategorimenu">Kategori Item:</label>
        <select id="kategorimenu" name='kategorimenu' required>
            <option value='<?= $_GET['KategoriMenu'] ?>'>
                <?= $_GET['KategoriMenu'] ?>
            </option>
            <?php
                $sql_kategorimenu = "select distinct KategoriMenu from menu";
                $laksana_carian=mysqli_query($condb,$sql_kategorimenu);
                while ($m=mysqli_fetch_array($laksana_carian)){
                    if($m['KategoriMenu'] != $_GET['KategoriMenu']) {
                        echo "<option value='".$m['KategoriMenu']."'>".$m['KategoriMenu']."</option>";
                    }
                }
            ?>
        </select>
        
    </div>
    
    <form action='proses_kemaskini_item.php?idmenu_lama=<?= $_GET['IDMenu'] ?>' method='POST' enctype="multipart/form-data">

    <div class="input-file-container">
        <input type='file' id="gambar" name='gambar' class="input-file">
        <label for="gambar" class="label-file">Gambar</label>
    </div>

    <input type='submit' value='Kemaskini'>
    </form>

</form>

</div>

<?php include('footer.php'); ?>
</body>
</html>
