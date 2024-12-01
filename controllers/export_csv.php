<?php
include '../config/db.php'; // Pastikan jalur benar

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_pengaduan.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Nama Pengadu', 'Email Pengadu', 'Kategori_Pengaduan', 'Deskripsi','Status', 'Tanggal_Pengaduan']); // Header kolom

$query = "SELECT id, nama_pengadu, email_pengadu, kategori_pengaduan, deskripsi, status, tanggal_pengaduan FROM pengaduan";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
?>
