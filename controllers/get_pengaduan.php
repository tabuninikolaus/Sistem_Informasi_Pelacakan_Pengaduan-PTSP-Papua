<?php
include '../config/db.php';

// Query untuk mendapatkan semua data pengaduan
$sql = "SELECT * FROM pengaduan ORDER BY tanggal_pengaduan DESC";
$result = $conn->query($sql);

$pengaduan = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pengaduan[] = $row;
    }
}
// Ambil parameter dari GET
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$filter_status = isset($_GET['status']) ? $conn->real_escape_string($_GET['status']) : '';

// Query dasar
$sql = "SELECT * FROM pengaduan WHERE 1=1";

// Tambahkan pencarian berdasarkan nama atau ID
if (!empty($search)) {
    $sql .= " AND (nama_pengadu LIKE '%$search%' OR id = '$search')";
}

// Tambahkan filter berdasarkan status
if (!empty($filter_status) && $filter_status !== 'all') {
    $sql .= " AND status = '$filter_status'";
}

// Urutkan berdasarkan tanggal pengaduan
$sql .= " ORDER BY tanggal_pengaduan DESC";

$result = $conn->query($sql);

$pengaduan = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pengaduan[] = $row;
    }
}

// Kirim data dalam format JSON
echo json_encode($pengaduan);
?>
