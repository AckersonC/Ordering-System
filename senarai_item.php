<?php
#memulakan fungsi session
session_start();

#memanggil fail header, staff_guard, connection\
include('header.php');
include('staff_guard.php');
include('connection.php');

?>
<h3>Senarai Item</h3>

<!--Bahagian 1: memaparkan borang untuk memilih kategori menu-->
<form action='' method='POST'>
    Kategori Menu <br>
    <select name='kategorimenu'>
        <option selected disabled>Sila memilih kategori menu</option>
        <?php
                $sql_kategorimenu = "select distinct KategoriMenu from menu";
                $laksana_carian=mysqli_query($condb,$sql_kategorimenu);
                while ($m=mysqli_fetch_array($laksana_carian)){
                echo "<option 
value='".$m['KategoriMenu']."'>".$m['KategoriMenu']."</option>";
                }
            ?>
        </select>
    </select> <input type='submit' value='Papar'>
</form>


| <a href='pendaftaran_item.php'>Daftar Item Baru</a>
<!--Memanggil fail butang saiz bagi mengubah seiz tulisan-->
<?php include('butang_saiz.php');?>
<!--Header bagi jadual untuk memaparkan senarai barang-->
<table border='1' id='saiz'>
    <tr>
        <td style='text-align: center;'>Gambar</td>
        <td style='width: 200px; text-align: center;'>ID Menu</td>
        <td style='width: 200px; text-align: center;'>Nama Menu</td>
        <td style='width: 200px; text-align: center;'>Harga Menu</td>
        <td style='width: 200px; text-align: center;'>Kategori Menu</td>
        <td style='width: 200px; text-align: center;'>Tindakan</td>
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
            'KategoriMenu'        => $m['KategoriMenu']
        );

        #memaparkan senarai nama dalam jadual
        echo "
        <tr>
        <td><img width='150px%' src='img/".$m['gambar']."'></td>
        <td style='width: 200px; text-align: center;'>".$m['IDMenu']."</td>
        <td style='width: 200px; text-align: center;'>".$m['NamaMenu']."</td>
        <td style='width: 200px; text-align: center;'>".$m['Harga']."</td>
        <td style='width: 200px; text-align: center;'>".$m['KategoriMenu']."</td>
        ";

        #memaprkan navigasi untuk kemaskini dan hapus data barang
        echo"<td style='width: 200px; text-align: center;'>
        <a href='kemaskini_item.php?".http_build_query($data_get)."'>
        Kemaskini</a>
        
        |<a href='proses_padam_item.php?IDMenu=".$m['IDMenu']."'
        onCLick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">
        Hapus</a> |
        </td>
        </tr>";
    }
?>
</table>
<?php include('footer.php');?>





