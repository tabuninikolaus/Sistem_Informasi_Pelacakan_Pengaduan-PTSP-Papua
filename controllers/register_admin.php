<?php
session_start();
include '../config/db.php'; // Pastikan jalur file konfigurasi benar

// Proteksi agar hanya admin yang sudah login bisa akses
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../views/login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "Username dan password tidak boleh kosong!";
        exit;
    }

    // Cek apakah username sudah ada di database
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username sudah digunakan!";
    } else {
        // Hash password dan simpan ke database
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $hashed_password);

        if ($stmt->execute()) {
            echo "Admin berhasil ditambahkan!";
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metode tidak valid!";
}
?>
