<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');
?>
<title>Laman Utama</title>
<!-- Link to the external CSS file -->
<link rel="stylesheet" href="index.css">
<!-- Link to the external JavaScript file -->
<script src="index.js"></script>

<div class="slideshow-container content-container">
    <div class="mySlides fade">
        <img src="img/promo1.jpg" style="width:100%">
        <div class="slideshow-text">Promosi Istimewa - Nasi Lemak Diskaun 20%</div>
    </div>
    <div class="mySlides fade">
        <img src="img/promo2.jpg" style="width:100%">
        <div class="slideshow-text">Hidangan Baru - Laksa Johor</div>
    </div>
    <div class="mySlides fade">
        <img src="img/promo3.jpg" style="width:100%">
        <div class="slideshow-text">Promosi Harian - Beli 1 Percuma 1 Air Tebu</div>
    </div>
    <div class="mySlides fade">
        <img src="img/promo4.jpg" style="width:100%">
        <div class="slideshow-text">Slogan Kami - Mendorong Kami Untuk Menhidang Anda Dengan Lebih Baik</div>
    </div>
</div>
<div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

<div class="content-container">
    <h2>3 Pesanan Paling Tinggi</h2>

    <div class="container">
    <?php
        # Arahan SQL untuk memaparkan item yang tersedia
        $sql_pilihan = "
        SELECT namamenu, harga, kategorimenu, ciri, gambar FROM menu
        ORDER BY CASE WHEN kategorimenu = 'makanan' THEN 1 ELSE 0 END DESC, namamenu ASC
        LIMIT 3"; # Adjusted to select only top 3 items

        # Melaksanakan arahan sql_pilihan
        $laksana_pilihan = mysqli_query($condb, $sql_pilihan);

        # Jika tiada data yang dijumpai
        if (mysqli_num_rows($laksana_pilihan) == 0) {
            echo "Tiada barangan yang telah direkodkan";
        } else {
            $ranks = ['gold', 'silver', 'bronze'];
            $index = 0;

            # Jika terdapat barangan yang ditemui, papar dalam bentuk kad
            while ($n = mysqli_fetch_array($laksana_pilihan)) {
                $rank = $ranks[$index++];
                echo "<div class='card $rank'>
                        <div class='card-inner'>
                            <div class='card-front'>
                                <img src='img/" . $n['gambar'] . "' alt='" . $n['namamenu'] . "'>
                                <h3>" . $n['namamenu'] . "</h3>
                            </div>
                            <div class='card-back'>
                                <h3>" . $n['namamenu'] . "</h3>
                                <p>" . $n['ciri'] . "</p>
                                <p>Harga: " . $n['harga'] . "</p>
                                <a href='login.php' class='button-order'>Pesan</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    ?>
    </div>
</div>

<?php include('footer.php'); ?>
