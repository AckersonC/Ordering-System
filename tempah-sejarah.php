<?php
session_start();
include("header.php");
include("connection.php");
include("guard.php");
$menu = "<br>";

$sql = "SELECT *,
(SELECT sum(cart.kuantiti * cart.Harga) from cart
WHERE cart.idresit=resit.idresit) AS jum
FROM resit
WHERE IDPengguna='" . $_SESSION['id'] . "'
ORDER BY resit.tarikh DESC";
$laksql = mysqli_query($condb, $sql);

if (isset($_GET['idresit'])):
    $sqlpaparmenu = "select * from cart, menu
    where cart.idmenu = menu.idmenu
    and cart.idresit = '" . $_GET['idresit'] . "'";
    $lakpaparmenu = mysqli_query($condb, $sqlpaparmenu);
    $menu = "<br>";
    while ($mm = mysqli_fetch_array($lakpaparmenu)):
        $menu = $menu . $mm['NamaMenu'] . "(" . $mm['kuantiti'] . " X RM" . $mm['Harga'] . ")<br>";
    endwhile;
endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Tempahan</title>
    <link rel="stylesheet" href="tempah-sejarah.css">
</head>
<body>
    <h3>Sejarah Tempahan</h3>
    <?php if (mysqli_num_rows($laksql) > 0) { ?>
        <div class="table-container">
            <table>
                <tr>
                    <th>No Resit</th>
                    <th>Tarikh</th>
                    <th>Status Tempahan</th>
                    <th>Jumlah Bayaran (RM)</th>
                </tr>
            <?php while ($m = mysqli_fetch_array($laksql)) { ?>
                <tr align='center'>
                    <td align="left">
                    <?php
                        echo "<a href='tempah-resit.php?noresit=" . $m['idresit'] . "'>" . $m['idresit'] . "</a>";
                        if (isset($_GET['idresit']) && $m['idresit'] == $_GET['idresit']) echo $menu;
                    ?>
                    </td>
                    <td><?php
                        $tarikh = date_create($m['tarikh']);
                        echo "Tarikh: " .
                              date_format($tarikh, "d/m/Y") . "<br>
                              Masa: " . date_format($tarikh, "H:i:s");
                    ?></td>
                    <td><?= $m['status'] . "<br><i>" . $m['jenis'] . "</i>" ?></td>
                    <td><?= $m['jum'] ?></td>
                </tr>
            <?php } ?>
            </table>
        </div>
    <?php } else {
        echo "<p align='center'>Tiada Sejarah Tempahan</p>";
    } ?>
</body>
</html>
<?php
include("footer.php")
?>
