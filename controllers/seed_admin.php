<?php
include '../config/db.php';

// Cek apakah admin sudah ada
$username = 'admin';
$password = password_hash('admin123', PASSWORD_BCRYPT);

$sql_check = "SELECT * FROM admin WHERE username = '$username'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "Admin sudah ada!";
} else {
    $sql_insert = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Admin berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
