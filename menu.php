<?php
# Memulakan fungsi session
session_start();
include("header.php");
include("connection.php");
include("guard.php");
$tambahan="";

# Mendapatkan data menu berdasarkan kategori dipilih
if (!empty($_GET['jenis'])) {
    $tambahan = "WHERE KategoriMenu='" . $_GET['jenis'] . "'";
}
$sql = "SELECT * FROM menu $tambahan";
$laksana = mysqli_query($condb, $sql);

# Mendapatkan data kategori
$sql_kategori = "SELECT * FROM kategori";
$laksana_kategori = mysqli_query($condb, $sql_kategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="menu.css"> <!-- Pastikan path ke CSS betul -->
    <style>
        .popup-btn, .print-btn {
            background-color: #fff8e7; /* Match header background color */
            color: #333;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px; /* Horizontal margin only */
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="content-container">
        <h3>Menu</h3>
        <div class="menu-container">
            <div class="categories">
                <button class="popup-btn" onclick="window.location.href='menu.php'">Semua</button>
                <?php while ($mm = mysqli_fetch_array($laksana_kategori)) { ?>
                <button class="popup-btn" onclick="window.location.href='menu.php?jenis=<?= $mm['KategoriMenu'] ?>'"><?= $mm['KategoriMenu'] ?></button>
                <?php } ?>
            </div>

            <div class="cards">
                <?php
                if (mysqli_num_rows($laksana) != 0) {
                    while ($m = mysqli_fetch_array($laksana)) { ?>
                    <div class="card">
                        <img src="img/<?= $m['gambar'] ?>" alt="<?= $m['NamaMenu'] ?>" class="card-img">
                        <div class="card-content">
                            <h2><?= $m['NamaMenu'] ?></h2>
                            <p>RM<?= $m['Harga']?></p>
                            <p><?= $m['ciri'] ?></p>
                            <a href='tempah-tambah.php?page=menu&jenis=<?= $m['KategoriMenu'] ?>&IDMenu=<?= $m['IDMenu'] ?>' class="add-to-cart-btn">Tambah Ke Cart</a>
                        </div>
                    </div>
                    <?php }
                } else {
                    echo "<p style='color:red;'>Menu Kategori ini belum didaftarkan</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include("footer.php")
?>
