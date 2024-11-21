<?php
session_start();

if (!empty($_POST)) {
    include('connection.php');

    if ($_POST['harga'] <= 0 || strlen($_POST['id']) != 2 || !is_numeric($_POST['harga'])) {
        die("<script>alert('Ralat Pada No. ID atau Harga');
        window.history.back(); </script>");
    }

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = 'img/';
        $filename = basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $filename;

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            die("<script>alert('Gagal memindahkan gambar'); window.history.back(); </script>");
        }
    } else {
        die("<script>alert('Tiada gambar dipilih'); window.history.back(); </script>");
    }

    $sql_simpan = "INSERT INTO menu (gambar, IDMenu, NamaMenu, Harga, KategoriMenu)
                   VALUES ('$filename', '{$_POST['id']}', '{$_POST['nama']}', '{$_POST['harga']}', '{$_POST['KategoriMenu']}')";

    $laksana_sql = mysqli_query($condb, $sql_simpan);

    if ($laksana_sql) {
        echo "<script>alert('Pendaftaran Berjaya'); window.location.href='senarai_item.php'; </script>";
    } else {
        echo "<script>alert('Pendaftaran Gagal'); window.history.back(); </script>";
    }
} else {
    echo "<script>alert('Sila lengkapkan maklumat anda'); window.location.href='pendaftaran_item.php';</script>";
}
?>
