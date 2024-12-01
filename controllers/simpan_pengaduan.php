<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $kategori = $conn->real_escape_string($_POST['kategori']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);

    // Query untuk menyimpan data
    $sql = "INSERT INTO pengaduan (nama_pengadu, email_pengadu, kategori_pengaduan, deskripsi) 
            VALUES ('$nama', '$email', '$kategori', '$deskripsi')";

    if ($conn->query($sql) === TRUE) {
        // Redirect dengan status sukses
        header('Location: ../views/ajukan_pengaduan.html?status=success');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

