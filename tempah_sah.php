<?php
session_start();

include("connection.php");

if(!isset($_SESSION["orders"])){
     die("<script>
          alert('Cart anda kosong');
          window.location.href='menu.php';
     </script>");
} else {
     $frekuensi = array_count_values($_SESSION['orders']);

     $sama = array_filter($frekuensi, function($count) {
          return $count >= 1;
     });

     $no_resit=substr($_SESSION['id'],0,3).date("jnyHis");
     $tarikh=date('Y-m-d H:i:s');
     $sqlresit = "insert into resit
     (idresit, IDPengguna, jenis ,status,tarikh)
     values
('$no_resit','".$_SESSION['id']."','".$_POST['jenis_tempahan']."','Pending','$tarikh') ";
     $lakresit  = mysqli_query($condb, $sqlresit);
     
     foreach($sama as $key => $bil) {
          $sqlcari = "select* from menu where idmenu = '$key'";
          $lak = mysqli_query($condb,$sqlcari);
          $m = mysqli_fetch_array($lak);

          $sqltempah = "insert into cart set
                         idresit = '$no_resit',
                         idmenu = '$key',
                         harga = '".$m['Harga']."',
                         kuantiti = '$bil' ";
          $laktempah = mysqli_query($condb,$sqltempah);
     }
unset($_SESSION['orders']);

echo "<script>alert('Tempahan Selesai');
window.location.href='tempah-resit.php?noresit=$no_resit';
</script>";
}
?>
