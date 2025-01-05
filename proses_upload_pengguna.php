<?php
if(isset($_POST['btn_upload']))
{
    #memanggil fail connection
    include('connection.php');

    #mengambil nama sementara fail
    $namafailsementara=$_FILES["data_pengguna"]["tmp_name"];

    #mengambil nama fail
    $namafail=$_FILES['data_pengguna']['name'];
    
    #mengambil jenis fail
    $jenisfail=pathinfo($namafail, PATHINFO_EXTENSION);

    #menguji jenis fail dan sail fail
    if($_FILES["data_pengguna"]["size"]>0 AND $jenisfail=="txt")
    {
        #membuka fail yang diambil
        $fail_data_pengguna=fopen($namafailsementara, "r");

        #mendapatkan data dari fail baris demi baris
        while (!feof($fail_data_pengguna))
        {
            #mengambil data sebaris sahaja bagi setiap pusingan
            $ambilbarisdata=fgets($fail_data_pengguna);

            #memecahkan baris data mengikut tanda pipe
            $pecahkanbaris=explode("|",$ambilbarisdata);

            #selepas pecahan tadiakan diumpukkna kepada 3
            list($namapengguna, $notelpengguna, $idpengguna, $kodlaluan_pengguna) = $pecahkanbaris;

            #arahn sql untuk menyimpan data
            $arahan_sql_simpan="insert into pengguna
            (Nama, NoTel, IDPengguna, KodLaluan) values
            ('$namapengguna', '$notelpengguna', '$idpengguna', '$kodlaluan_pengguna')";

            #memasukkan data kedalam jadual staff
            $laksana_arahan_simpan=mysqli_query($condb, $arahan_sql_simpan);
            echo"<script>alert('Import fail data selesai');
            window.location.href='senarai_pengguna.php';</script>";
        }
    fclose($fail_data_staff);
    }
    else
    {
        echo"<script>alert('Hanya fail berformat txt sahaja dibenarkan');
        window.location.href='senarai_pengguna.php';</script>";
    }
}
else
{
    die("<scirpt>alert('Ralat akses secara terus');
    window.loaction.href='upload_pengguna.php';</scirpt>");
}
?>

