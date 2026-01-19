<?php
session_start();
session_unset();   // Menghapus semua variabel session
session_destroy(); // Menghancurkan session sepenuhnya

// Redirect kembali ke Homepage (index.php)
header("Location: index.php");
exit;
?>