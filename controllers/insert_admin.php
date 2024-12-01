<?php
include '../config/db.php'; // Pastikan jalur ini benar

// Data admin baru
$username = 'admindemo'; // Username admin
$password = password_hash('admin12345', PASSWORD_BCRYPT); // Password admin

// Query untuk insert data admin
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $password);

if ($stmt->execute()) {
    echo "Admin berhasil ditambahkan!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
