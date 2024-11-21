<?php
#Memulakan fungsi session
session_start();

#Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');
?>
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
                        <td style='width: 200px; text-align: center;'>Kuantiti</td>
                        <td style='width: 200px; text-align: center;'>Tindakan</td>
                    </tr>";
    
#Pembolehubah $n mengambil data yang ditemui
    while($n=mysqli_fetch_array($laksana_pilihan)){
        #memaparkan semula data diambil oleh pembolehubah $n
        echo "  <tr>
                    <td><img width='150px%' src='img/".$n['gambar']."'></td>
                    <td style='width: 200px; text-align: center;'>".$n['namamenu']."</td>
                    <td style='width: 200px; text-align: center;'>".$n['harga']."</td>
                    <td style='width: 200px; text-align: center;'><form action = 'proses_tambah.php' method='POST'>
                        <input type='text' name='kuantiti' min='0' required><br></form>
                    </td> 
                    <td style='width: 200px; text-align: center;'>
                        <input type='submit' value='Tambah Ke Cart'>
                    </td>
                </tr>";
        }
        echo"</table>";
        echo "<form action = 'cart.php' method='POST'><br>
                <input type='submit' value='Menuju Ke Cart'>
               </form>";
    }
?>
<?php include ('footer.php'); ?>