<?php
$host = 'localhost';
$user = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Kosongkan jika tidak ada password
$dbname = 'pelacakan_pengaduan';

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
