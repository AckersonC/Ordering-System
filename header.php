<!-- tajuk sistem. Akan dipaparkan disebelah atas -->
 <h1> Sistem Pesanan Pantas Dan Senang (SPPS) </h1>
 <p> Pesanan Anda, Di Hujung Jari Anda</p>
 <hr>

 <!-- Bahagian Log In Asas.
      Log in terbahagi kepada 3 bahagian iaitu
      1. Menu Staff dimana staff dapat akses semua perkara
      2. Menu Pembeli dimana pembeli hanya boleh membuat pesanan tetapi pembeli
         perlu login dahulu
      3. Menu di laman utama - bagi pelawat yang tidak login 
         (tidak dapat pesan makanan)
-->
         
<?PHP 
#Menu staff : dipaparkan sekiranya staff telah login
if(!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "staff")
{
    echo "
    | <a href='index.php'>Laman Utama</a>
    | <a href='senarai_pengguna.php'>Senarai Pengguna</a>
    | <a href='senarai_staff.php'>Senarai Staff</a>
    | <a href='senarai_item.php'>Senarai Item</a>
    | <a href='logout.php'>Logout</a>
    |<hr>";
}
#Menu pembeli: dipaparkan sekiranya pembeli telah login
else if(!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "pengguna")
{
    echo "
    | <a href='index.php''>Laman Utama</a>
    | <a href='menu.php'>Menu</a>
    | <a href='cart.php'>Cart</a>
    | <a href='resit.php'>Resit</a>
    | <a href='logout.php'>Logout</a>
    |<hr>";
}
else
{
    echo "
    | <a href='index.php'>Laman Utama</a>
    | <a href='pendaftaran.php'>Pengguna Baru</a>
    | <a href='login.php'>Login Pengguna</a>
    | <a href='login_staff.php'>Login Staff</a>
    <hr>";
}
?>