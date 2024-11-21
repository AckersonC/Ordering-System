<?php

#memulakan fungsi session
session_start();

#memanggil fail header
include('header.php');
include('connection.php');
include('staff_guard.php');

#menyemak kewujudan data GET. Jiaka data GET empty, buka fail senarai_item
if(empty($_GET)){
    die("<script>window.loacation.href='senarai_item.php';</script>");
}
?>

<h3>Kemaskini Data Item</h3>

<form action='proses_kemaskini_item.php?idmenu_lama=<?=$_GET['IDMenu']?>' method='POST'>

Gambar:
<input type='file' name='gambar' value='<?= $_GET['gambar'] ?>'><br><br>

No. ID:
<input type='text' name='id' value='<?= $_GET['IDMenu'] ?>' required><br><br>

Nama Item:
<input type='text' name='nama' value='<?= $_GET['NamaMenu'] ?>' required><br><br>

Harga Item:
<input type='text' name='harga'value='<?= $_GET['Harga'] ?>' required><br><br>

Kategori Item:
<select name='kategorimenu' required><br><br>
    <option value='<?= $_GET['KategoriMenu'] ?>'>
    <?= $_GET['KategoriMenu'] ?></option>
    <?php
        $sql_kategorimenu = "select distinct KategoriMenu from menu";
        $laksana_carian=mysqli_query($condb,$sql_kategorimenu);
        while ($m=mysqli_fetch_array($laksana_carian)){
            if($m['KategoriMenu'] != $_GET['KategoriMenu'])
            {
                echo "<option value='".$m['KategoriMenu']."'>".$m['KategoriMenu']."</option>";
            }

        }
    ?>
</select>
<br><br>
<input type='submit' value='Kemaskini'>
        
</form>
<?php include ('footer.php');?>

