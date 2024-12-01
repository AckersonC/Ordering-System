<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');

# Arahan SQL untuk memaparkan item yang tersedia
$sql_pilihan = "
SELECT IDMenu, namamenu, harga, kategorimenu, gambar FROM menu
ORDER BY CASE WHEN kategorimenu = 'makanan' THEN 1 ELSE 0 END DESC, namamenu ASC";

# Melaksanakan arahan sql_pilihan
$laksana_pilihan = mysqli_query($condb, $sql_pilihan);

# Jika tiada data yang dijumpai
if (mysqli_num_rows($laksana_pilihan) == 0) {
    echo "Tiada barangan yang telah direkodkan";
} else {
    echo "<hr>";
    # Jika terdapat barangan yang ditemui, papar dalam bentuk jadual
    echo "<table border='1'>
            <tr>
                <td style='text-align: center;'>Gambar</td>
                <td style='width: 200px; text-align: center;'>Nama Item</td>
                <td style='width: 200px; text-align: center;'>Harga</td>
                <td style='width: 200px; text-align: center;'>Kuantiti</td>
                <td style='width: 200px; text-align: center;'>Jumlah Harga</td>
            </tr>";

    while ($n = mysqli_fetch_array($laksana_pilihan)) {
        echo "<tr>
                <td><img width='150px' src='img/".$n['gambar']."'></td>
                <td style='width: 200px; text-align: center;'>".$n['namamenu']."</td>
                <td style='width: 200px; text-align: center;'>".$n['harga']."</td>
                <td style='width: 200px; text-align: center;'>
                    <input type='hidden' id='harga_".$n['IDMenu']."' value='".$n['harga']."'>
                    <button type='button' onclick='stepDown(\"kuantiti_".$n['IDMenu']."\", \"harga_".$n['IDMenu']."\", \"total_".$n['IDMenu']."\", \"grandTotal\")'>-</button>
                    <input type='number' id='kuantiti_".$n['IDMenu']."' name='kuantiti' value='0' min='0' style='width: 70px; text-align: center; padding-left: 15px;' oninput='updateTotal(\"kuantiti_".$n['IDMenu']."\", \"harga_".$n['IDMenu']."\", \"total_".$n['IDMenu']."\", \"grandTotal\")' required>
                    <button type='button' onclick='stepUp(\"kuantiti_".$n['IDMenu']."\", \"harga_".$n['IDMenu']."\", \"total_".$n['IDMenu']."\", \"grandTotal\")'>+</button>
                </td>
                <td style='width: 200px; text-align: center;'>
                    <span id='total_".$n['IDMenu']."'>0</span>
                </td>
            </tr>";
    }

    echo "<tr>
            <td colspan='4' style='text-align: right;'>Jumlah harga ialah:</td>
            <td style='width: 200px; text-align: center;'>
                <span id='grandTotal'>0</span>
            </td>
          </tr>";

    echo "</table>";
    echo "<div style='display: flex; justify-content: center;'> 
            <form action='cart.php' method='POST'><br> 
            <input type='submit' value='Menuju Ke Cart' '> 
            </form> 
        </div>";
}
?>
<script>
function updateTotal(quantityId, priceId, totalId, grandTotalId) {
    var quantity = document.getElementById(quantityId).value;
    var price = document.getElementById(priceId).value;
    var total = quantity * price;
    document.getElementById(totalId).innerText = total.toFixed(2);
    updateGrandTotal(grandTotalId);
}

function stepUp(quantityId, priceId, totalId, grandTotalId) {
    var input = document.getElementById(quantityId);
    input.stepUp();
    updateTotal(quantityId, priceId, totalId, grandTotalId);
}

function stepDown(quantityId, priceId, totalId, grandTotalId) {
    var input = document.getElementById(quantityId);
    if (input.value > 0) {
        input.stepDown();
    }
    updateTotal(quantityId, priceId, totalId, grandTotalId);
}

function updateGrandTotal(grandTotalId) {
    var totalElements = document.querySelectorAll('span[id^="total_"]');
    var grandTotal = 0;
    totalElements.forEach(function(element) {
        grandTotal += parseFloat(element.innerText);
    });
    document.getElementById(grandTotalId).innerText = grandTotal.toFixed(2);
}
</script>
<?php include('footer.php'); ?>
