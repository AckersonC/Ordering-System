<!-- Link to the external CSS file -->
<link rel="stylesheet" href="header.css">

<!-- Header Content -->
<div class="header-container">
    <a href="index.php">
    <img src="img/logo.jpg" width="150px" height="120px">
    </a>
    <div>
        <h1>Sistem Pesanan Pantas Dan Senang (SPPS)</h1>
        <p>Pesanan Anda, Di Hujung Jari Anda</p>
        <?php
        if (isset($_SESSION['nama'])) {
            echo "<p>Selamat Datang, " . htmlspecialchars($_SESSION['nama']) . "!</p>";
        } else {
            echo "<p></p>";
        }
        ?>
    </div>
</div>
<hr>

<!-- Bahagian Log In Asas. -->
<nav>
    <a href="javascript:history.back()" class="back-link">←</a>
    <?PHP 
    #memapar bilangan pada cart
    if (isset($_SESSION["orders"])) {
        $bil="<span style='color:#af7b2c;'>[".count($_SESSION['orders'])."]</span>";
    } else {$bil="";}?>

    <?php

    # Menu staff : dipaparkan sekiranya staff telah login
    if(!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "staff") {
        echo "
        <a href='senarai_pengguna.php'>Pengguna &#128100;</a>
        <a href='senarai_staff.php'>Staff ⚠️</a>
        <a href='senarai_item.php'>Item &#128230;</a>
        <a href='laporan.php'>Laporan &#129534;</a>
        <a href='logout.php'>Logout &#128228;</a>";
    }
    # Menu pembeli: dipaparkan sekiranya pembeli telah login
    else if(!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "pengguna") {
        echo "
        <a href='menu.php'>Menu &#128203;</a>
        <a href='tempah-cart.php'>Cart &#128722<?= $bil</a>
        <a href='tempah-sejarah.php'>Sejarah &#129534;</a>
        <a href='logout.php'>Logout &#128228;</a>";
    }
    # Menu di laman utama untuk pelawat yang tidak login
    else {
        echo "
        <a href='index.php'>Utama &#127968;</a>
        <a href='pendaftaran.php'>Daftar &#9997;</a>
        <a href='login.php'>Pengguna &#128100;</a>
        <a href='login_staff.php'>Staff ⚠️</a>";
    }
    ?>
</nav>
<hr>
