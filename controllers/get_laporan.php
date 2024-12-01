<?php
include '../config/db.php';

// Data jumlah pengaduan per kategori
$sqlKategori = "SELECT kategori_pengaduan, COUNT(*) AS jumlah FROM pengaduan GROUP BY kategori_pengaduan";
$resultKategori = $conn->query($sqlKategori);

$kategoriData = [];
while ($row = $resultKategori->fetch_assoc()) {
    $kategoriData[] = $row;
}

// Data jumlah pengaduan per status
$sqlStatus = "SELECT status, COUNT(*) AS jumlah FROM pengaduan GROUP BY status";
$resultStatus = $conn->query($sqlStatus);

$statusData = [];
while ($row = $resultStatus->fetch_assoc()) {
    $statusData[] = $row;
}

// Gabungkan data
$data = [
    'kategori' => $kategoriData,
    'status' => $statusData,
];

echo json_encode($data);
?>
