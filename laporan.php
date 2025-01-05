<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');
include('staff_guard.php');

if (isset($_POST['tarikh_semasa'])) {
    $tarikhsemasa = $_POST['tarikh_semasa'];
} else {
    $tarikhsemasa = date("Y-m-d");
}

# Dapatkan Senarai tarikh
$sqltarikh = "SELECT DATE(tarikh) AS tarikh, count(*) as bilangan
              FROM resit
              GROUP BY DATE(tarikh)
              ORDER BY DATE(tarikh) DESC";
$laktarikh = mysqli_query($condb, $sqltarikh);

# Dapatkan semua senarai tempahan
$sql = "SELECT r.*, 
               (SELECT SUM(c.kuantiti * c.harga)
                FROM cart c
                WHERE c.idresit = r.idresit) AS jum
        FROM resit r
        WHERE r.tarikh LIKE '%$tarikhsemasa%'
        ORDER BY r.tarikh DESC";
$laksql = mysqli_query($condb, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="laporan.css">
    <title>Laporan Tempahan</title>
</head>
<body>
    <div class="content-container">
        <h3>Laporan Tempahan</h3>
        <button class="center-button" onclick="openPopup()">Pilih Tarikh</button>

        <!-- Popup Modal -->
        <div class="popup-overlay" id="popup-overlay"></div>
        <div class="popup" id="popup">
            <span class="close-button" onclick="closePopup()">&times;</span>
            <form action="" method="POST">
                Pilih Tarikh:
                <select name='tarikh_semasa'>
                    <?php
                    $selected_date = $_POST['tarikh_semasa'] ?? ''; // Get the selected date from the form submission
                    while ($mm = mysqli_fetch_array($laktarikh)): ?>
                    <option value='<?= $mm['tarikh'] ?>' <?= $mm['tarikh'] == $selected_date ? 'selected' : '' ?>>
                        <?= date_format(date_create($mm['tarikh']), "d/m/Y") ?>
                    </option>
                    <?php endwhile; ?>
                </select>
                <input type="submit" value="Papar">
            </form>
        </div>

        <!-- Memapar senarai tempahan berdasarkan tarikh -->
        <div class="table-container">
            <table>
                <tr>
                    <th>No Resit</th>
                    <th>Tarikh</th>
                    <th>Status Tempahan</th>
                    <th>Jumlah Bayaran (RM)</th>
                    <th>Tindakan</th>
                </tr>

                <?php if (!$selected_date): ?>
                    <tr>
                    <td colspan="5" class="message">Sila Memilih Tarikh Dahulu</td>
                    </tr>
                <?php else: ?>
                    <?php while ($m = mysqli_fetch_array($laksql)): ?>
                        <tr>
                            <td align='left'>
                                <?php
                                echo "<b><u>".$m['idresit']."</u></b><br>";

                                # Mendapat data tempahan
                                $sqlpaparmenu = "SELECT * FROM cart, menu
                                                 WHERE cart.idmenu = menu.idmenu
                                                 AND cart.idresit = '".$m['idresit']."'";
                                $lakpaparmenu = mysqli_query($condb, $sqlpaparmenu);

                                while ($mm = mysqli_fetch_array($lakpaparmenu)) {
                                    echo $mm["NamaMenu"]."(".$mm['kuantiti']."x RM".$mm['harga'].")<br>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $tarikh = date_create($m['tarikh']);
                                echo "Tarikh: ".date_format($tarikh, "d/m/Y")."<br>
                                      Masa: ".date_format($tarikh, "H:i:s");
                                ?>
                            </td>
                            <td><?= $m["status"] ?></td>
                            <td><?= isset($m['jum']) ? $m['jum'] : 'N/A' ?></td>
                            <td>
                                <?php
                                if ($m['status'] == 'Completed') {
                                    echo "<a href='tempah_belum_siap.php?idresit=".$m['idresit']."' class='antideco'>&#10060;</a>";
                                } else {
                                    echo "<a href='tempah_siap.php?idresit=".$m['idresit']."' class='antideco'>&#9989;</a>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById('popup-overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup-overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>
<?php
# Tutup sambungan pangkalan data
mysqli_close($condb);
?>
<br><br><br><br><br>
<?php
include("footer.php")
?>
