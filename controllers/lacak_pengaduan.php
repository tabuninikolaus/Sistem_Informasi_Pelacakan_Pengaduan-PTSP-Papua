<?php
include '../config/db.php'; // 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id_pengaduan'];

    // Validasi ID pengaduan
    if (empty($id) || !is_numeric($id)) {
        echo "ID pengaduan tidak valid!";
        exit;
    }

    $sql = "SELECT * FROM pengaduan WHERE id = $id";
    $result = $conn->query($sql);

    // Cek apakah pengaduan ditemukan
    if ($result->num_rows > 0) {
        $pengaduan = $result->fetch_assoc();
        // Menampilkan data pengaduan dalam format HTML
        echo "<h2>Detail Pengaduan</h2>";
        echo "<p><strong>ID Pengaduan:</strong> " . $pengaduan['id'] . "</p>";
        echo "<p><strong>Nama Pengadu:</strong> " . $pengaduan['nama_pengadu'] . "</p>";
        echo "<p><strong>Email Pengadu:</strong> " . $pengaduan['email_pengadu'] . "</p>";
        echo "<p><strong>Status Pengaduan:</strong> " . $pengaduan['status'] . "</p>";
        echo "<p><strong>Tanggal Pengaduan:</strong> " . $pengaduan['tanggal_pengaduan'] . "</p>";

        // Jika ada riwayat status pengaduan (asumsi ada tabel riwayat status)
        $riwayat_sql = "SELECT * FROM riwayat_status WHERE id_pengaduan = $id ORDER BY waktu_perubahan DESC";
        $riwayat_result = $conn->query($riwayat_sql);

        if ($riwayat_result->num_rows > 0) {
            echo "<h3>Riwayat Status Pengaduan:</h3><ul>";
            while ($riwayat = $riwayat_result->fetch_assoc()) {
                echo "<li><strong>" . $riwayat['status_baru'] . "</strong> pada " . $riwayat['waktu_perubahan'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Riwayat status tidak tersedia.</p>";
        }
    } else {
        echo "<p>Pengaduan tidak ditemukan.</p>";
    }
}
?>
