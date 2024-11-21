<?php
if(isset($_POST['btn_upload']))
{
    #memanggil fail connection
    include('connection.php');

    #mengambil nama sementara fail
    $namafailsementara=$_FILES["data_staff"]["tmp_name"];

    #mengambil nama fail
    $namafail=$_FILES['data_staff']['name'];
    
    #mengambil jenis fail
    $jenisfail=pathinfo($namafail, PATHINFO_EXTENSION);

    #menguji jenis fail dan sail fail
    if($_FILES["data_staff"]["size"]>0 AND $jenisfail=="txt")
    {
        #membuka fail yang diambil
        $fail_data_staff=fopen($namafailsementara, "r");

        #mendapatkan data dari fail baris demi baris
        while (!feof($fail_data_staff))
        {
            #mengambil data sebaris sahaja bagi setiap pusingan
            $ambilbarisdata=fgets($fail_data_staff);

            #memecahkan baris data mengikut tanda pipe
            $pecahkanbaris=explode("|",$ambilbarisdata);

            #selepas pecahan tadiakan diumpukkna kepada 3
            list($namastaff, $idstaff, $kodlaluan_staff) = $pecahkanbaris;

            #arahn sql untuk menyimpan data
            $arahan_sql_simpan="insert into staff
            (namastaff, idstaff, kodlaluan_staff) values
            ('$namastaff', '$idstaff', '$kodlaluan_staff')";

            #memasukkan data kedalam jadual staff
            $laksana_arahan_simpan=mysqli_query($condb, $arahan_sql_simpan);
            echo"<script>alert('Import fail data selesai');
            window.location.href='senarai_staff.php';</script>";
        }
    fclose($fail_data_staff);
    }
    else
    {
        echo"<script>alert('Hanya fail berformat txt sahaja dibenarkan');
        window.location.href='senarai_staff.php';</script>";
    }
}
else
{
    die("<scirpt>alert('Ralat akses secara terus');
    window.loaction.href='upload_staff.php';</scirpt>");
}
?>

