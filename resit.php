<?php
#memulakan fungsi session
session_start();

#memanggil fail header, connection
include('header.php');
include('connection.php');

?>
<h3>Resit</h3>
<!--Memanggil fail butang saiz bagi mengubah seiz tulisan-->
<?php include('butang_saiz.php');?>
<!--Header bagi jadual untuk memaparkan resit-->
<table width='100%' border='1' id='saiz'>
    <tr>
        <td>ID Resit</td>
        <td>ID Menu</td>
        <td>Kuantiti</td>
    </tr>
<?php


// Prepare and execute the SQL statement to retrieve data for the logged-in user
$arahan_papar = "SELECT * FROM pesanan WHERE idpengguna = '".$_POST['idpengguna']."';";

#laksanakan arahan mencari data barang
$laksana = mysqli_query($condb, $arahan_papar);

while($m = mysqli_fetch_array($laksana))
{
    #umpukkan data kpd tatasusunan bagi tujuan kemaskini barang
    $data_get=array(
        'NoResit'        => $m['NoResit'],
        'IDMenu'        => $m['IDMenu'],
        'Kuantiti'        => $m['Kuantiti'],
    );

    #memaparkan senarai nama dalam jadual
    echo "<tr>
    <td>".$m['NoResit']."</td>
    <td>".$m['IDMenu']."</td>
    <td>".$m['Kuantiti']."</td>
    ";

}
?>
</table>
<?php include('footer.php');?>



