<?php
session_start();
include("header.php");
include("connection.php");
include("guard.php");
$jumlah_harga = 0;

#menyemak jika tatasusunan order kosong
if (!isset($_SESSION['orders']) or count($_SESSION['orders']) == 0) {
    die("<script>
    alert('Cart anda kosong');
    window.location.href='menu.php';
    </script>");
} else {
    #dapatkan bilangan setiap elemen
    $bilangan = array_count_values($_SESSION['orders']);

    #filter elemen yang muncul lebih dari satu kali
    $sama = array_filter($bilangan, function ($count) {
        return $count >= 1;
    });
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempah Cart</title>
    <link rel="stylesheet" href="tempah_cart.css"> <!-- Make sure this path is correct -->
</head>
<body>
    <h3>Cart</h3>
    <div class="cart-container">
        <table class="cart-table">
            <tr class="cart-header">
                <th>Menu</th>
                <th>Kuantiti</th>
                <th>Harga seunit</th>
                <th>Harga</th>
            </tr>

            <?php foreach ($sama as $key => $bil) {
                $sql = "SELECT * FROM menu WHERE IDMenu = '$key'";
                $lak = mysqli_query($condb, $sql);
                $m = mysqli_fetch_array($lak);
            ?>
            <tr>
                <td><?= $m['NamaMenu'] ?></td>
                <td align='center'>
                    <a href='tempah-padam.php?IDMenu=<?= $m['IDMenu'] ?>' class="quantity-btn">-</a>
                    <?= $bil ?>
                    <a href='tempah-tambah.php?page=cert&IDMenu=<?= $m['IDMenu'] ?>' class="quantity-btn">+</a>
                </td>
                <td align='right'><?= $m['Harga'] ?></td>
                <td align='right'><?php
                $harga = $bil * $m['Harga'];
                $jumlah_harga += $harga;
                echo number_format($harga, 2);
                ?></td>
            </tr>
            <?php } ?>
            <tr class="cart-total">
                <td colspan="3" align="right">Jumlah Bayaran (RM)</td>
                <td align="right"><?= number_format($jumlah_harga, 2) ?></td>
            </tr>
        </table>

        <br>
        <form action="tempah_sah.php" method="POST">
            <div class="order-confirmation">
                <label for="jenis_tempahan">Jenis Tempahan:</label>
                <select name="jenis_tempahan" id="jenis_tempahan">
                    <option value="BUNGKUS">BUNGKUS</option>
                    <?php for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='Meja $i'>Meja $i</option>";
                    } ?>
                </select>
                <button type="submit">Sahkan Tempahan</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php } ?>
<?php
include("footer.php")
?>
