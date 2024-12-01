<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: views/login.html'); // Redirect ke halaman login jika belum login
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <!-- Header Navigasi -->
    <header class="admin-header">
      <h1>Dashboard Admin</h1>
      <nav>
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="../controllers/export_csv.php" class="btn">Export ke CSV</a>
        <a href="../controllers/export_pdf.php" class="btn">Export ke PDF</a>
        <a href="laporan.html">Laporan</a>
        <a href="register_admin.html">Tambah Admin Baru</a>
        <a href="../controllers/logout.php">Logout</a>
        
      </nav>
    </header>
    <!-- Filter dan Pencarian -->
    <section class="filters">
      <label for="search">Cari Pengaduan:</label>
      <input type="text" id="search" placeholder="Masukkan nama atau ID" />

      <label for="filter-status">Filter Status:</label>
      <select id="filter-status">
        <option value="all">Semua</option>
        <option value="Diterima">Diterima</option>
        <option value="Diproses">Diproses</option>
        <option value="Selesai">Selesai</option>
      </select>

      <button id="apply-filters">Terapkan</button>
    </section>

    <!-- Tabel Data Pengaduan -->
    <section class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nomor Referensi</th>
            <th>Nama Pengadu</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="data-pengaduan">
          <!-- Data Dummy -->
          <tr>
            <td>REF123456</td>
            <td>John Doe</td>
            <td>Perizinan</td>
            <td>2024-11-19</td>
            <td>Sedang Diproses</td>
            <td>
              <button class="btn-update">Update</button>
            </td>
          </tr>
          <!-- Tambahkan Data Lain -->
        </tbody>
      </table>
    </section>
    <!-- Modal -->
    <div id="modal-update" class="modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Update Status</h2>
        <form id="update-form">
          <input type="hidden" id="pengaduan-id" name="id" />
          <label for="status">Pilih Status:</label>
          <select id="status" name="status">
            <option value="Diterima">Diterima</option>
            <option value="Diproses">Diproses</option>
            <option value="Selesai">Selesai</option>
          </select>
          <button type="submit">Simpan</button>
        </form>
      </div>
    </div>

    <script src="../assets/js/dashboard.js"></script>
  </body>
</html>
