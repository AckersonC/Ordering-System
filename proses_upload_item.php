<?php
if(isset($_POST['btn_upload']))
{
    #memanggil fail connection
    include('connection.php');

    #mengambil nama sementara fail
    $namafailsementara=$_FILES["data_item"]["tmp_name"];

    #mengambil nama fail
    $namafail=$_FILES['data_item']['name'];
    
    #mengambil jenis fail
    $jenisfail=pathinfo($namafail, PATHINFO_EXTENSION);

    #menguji jenis fail dan sail fail
    if($_FILES["data_item"]["size"]>0 AND $jenisfail=="txt")
    {
        #membuka fail yang diambil
        $fail_data_item=fopen($namafailsementara, "r");

        #mendapatkan data dari fail baris demi baris
        while (!feof($fail_data_item))
        {
            #mengambil data sebaris sahaja bagi setiap pusingan
            $ambilbarisdata=fgets($fail_data_item);

            #memecahkan baris data mengikut tanda pipe
            $pecahkanbaris=explode("|",$ambilbarisdata);

            #selepas pecahan tadiakan diumpukkna kepada 3
            list($idmenu, $namamenu, $hargamenu, $deskripsi, $kategorimenu) = $pecahkanbaris;

            #arahn sql untuk menyimpan data
            $arahan_sql_simpan="insert into menu
            (IDMenu, NamaMenu, Harga, KategoriMenu, ciri) values
            ('$idmenu', '$namamenu', '$hargamenu', '$kategorimenu', '$deskripsi')";

            #memasukkan data kedalam jadual item
            $laksana_arahan_simpan=mysqli_query($condb, $arahan_sql_simpan);
            echo"<script>alert('Import fail data selesai. Sila kemaskini gambar di senarai item.');
            window.location.href='senarai_item.php';</script>";
        }
    fclose($fail_data_item);
    }
    else
    {
        echo"<script>alert('Hanya fail berformat txt sahaja dibenarkan');
        window.location.href='senarai_item.php';</script>";
    }
}
else
{
    die("<scirpt>alert('Ralat akses secara terus');
    window.loaction.href='upload_item.php';</scirpt>");
}
?>

