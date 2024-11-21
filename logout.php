<?php
#memulakan fungsi session
session_start();

#menghapuskan nilai pembolehubah session
session_unset();

#menghjentikan fungsi session
session_destroy();

echo"<script>window.location.href='index.php'</script>"
?>