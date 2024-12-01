<?php
session_start();
session_destroy(); // Menghapus semua sesi
header('Location: ../views/login.html'); // Redirect ke halaman login
exit;
?>
