<?php
#Memulakan fungsi session
session_start();

#Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');
?>

<hr>
<h3>Nikmatilah Warisan Malaysia Dengan Citarasa Anda<h3>
<?php
    #arahan SQL untuk memaparkan item yang tersedia
    #5 item yang tersedia
    $sql_pilihan = "
    SELECT namamenu, harga, kategorimenu, gambar FROM menu
    ORDER BY CASE WHEN kategorimenu = 'makanan' THEN 1 ELSE 0 END DESC, namamenu ASC";

    #melaksanakan arahan sql_pilihan
    $laksana_pilihan = mysqli_query($condb, $sql_pilihan);

    #jika tiada data yang dijumpai
    if(mysqli_num_rows($laksana_pilihan)==0){
        #papar TIada barangan yang telah direkodkan
        echo "Tiada barangan yang telah direkodkan";
    }
    else {
        echo "<hr>";
        #jika terdapat barangan yang ditemui
        #papar dalam bentuk jadual.
        echo"<table border='1'>
                    <tr>
                        <td style='text-align: center;'>Gambar</td>
                        <td style='width: 200px; text-align: center;'>Nama Item</td>
                        <td style='width: 200px; text-align: center;'>Harga</td>
                    </tr>";
    
#Pembolehubah $n mengambil data yang ditemui
    while($n=mysqli_fetch_array($laksana_pilihan)){
        #memaparkan semula data diambil oleh pembolehubah $n
        echo "  <tr>
                    <td><img width='150px%' src='img/".$n['gambar']."'></td>
                    <td style='width: 200px; text-align: center;'>".$n['namamenu']."</td>
                    <td style='width: 200px; text-align: center;'>".$n['harga']."</td>
                </tr>";
        }
        echo"</table>";
    }
?>
<?php include ('footer.php'); ?>