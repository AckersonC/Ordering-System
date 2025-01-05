<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
# nama host. localhost merupakan default
$nama_host = "localhost";

# username bagi SQL. root merupakan default
$nama_sql = "root";

# password bagi SQL. masukkan password anda.
$pass_sql = "";

#nama pangkalan data yang anda telah bangunkan sebelum ini.
$nama_db = "sis_pesananspps";

#membuka hubungan antara pengkalan data dan sistem.
$condb = mysqli_connect($nama_host, $nama_sql, $pass_sql, $nama_db);

#menguji adakah hubungan berjaya dibuka
if (!$condb)
{
    die("Sambungan ke pangkalan data gagal");
}
else
{
    #echo "Sambungan ke pangkalan data berjaya";
}
?>