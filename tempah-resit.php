<?php
session_start();

include("header.php");
include("connection.php");
include("guard.php");
$jumlah_harga = 0;

$sql_pilih = "SELECT * FROM cart, menu, resit
WHERE
    cart.idresit = resit.idresit
    AND cart.idmenu = menu.idmenu
    AND cart.idresit = '" . $_GET['noresit'] . "'";
$laksana = mysqli_query($condb, $sql_pilih);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resit Tempahan</title>
    <link rel="stylesheet" href="tempah_resit.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <h3>Resit Tempahan</h3>
    <div class="button-container">
        <button onclick="openPopup()" class="popup-btn">Ubah Saiz Tulisan</button>
        <button onclick="window.print()" class="print-btn">Cetak</button>
    </div>
    <div class="receipt-container">
        <table class="receipt-table">
            <tr class="receipt-header">
                <th>Menu</th>
                <th>Kuantiti</th>
                <th>Harga seunit</th>
                <th>Harga</th>
            </tr>

            <?php while ($m = mysqli_fetch_array($laksana)) { ?>
            <tr>
                <td align="center"><?= $m['NamaMenu'] ?></td>
                <td align="center"><?= $m['kuantiti'] ?></td>
                <td align="center"><?= $m['harga'] ?></td>
                <td align="right"><?php
                    $harga = $m['kuantiti'] * $m['harga'];
                    $jumlah_harga += $harga;
                    echo number_format($harga, 2);
                ?></td>
            </tr>
            <?php } ?>
            <tr class="receipt-total" align="right">
                <td colspan="3">Jumlah Bayaran (RM)</td>
                <td><?= number_format($jumlah_harga, 2) ?></td>
            </tr>
        </table>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            
            <div class="font-size-control">
            <p>Ubah Saiz Tulisan | </p><button onclick="changeFontSize(-1)" class="font-size-btn">-</button>
                <button onclick="changeFontSize(1)" class="font-size-btn">+</button>
                <button onclick="resetFontSize()" class="font-size-btn">Reset</button>
            </div>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        function changeFontSize(value) {
            const receiptTable = document.querySelector('.receipt-table');
            const currentFontSize = parseInt(window.getComputedStyle(receiptTable).fontSize);
            const newFontSize = currentFontSize + value;
            receiptTable.style.fontSize = newFontSize + 'px';
        }

        function resetFontSize() {
            document.querySelector('.receipt-table').style.fontSize = '14px';
        }
    </script>
</body>
</html>
<?php
include("footer.php")
?>
