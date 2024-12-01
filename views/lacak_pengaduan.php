<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lacak Pengaduan</title>
    <link rel="stylesheet" href="../assets/css/style_lacak_pengaduan.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  </head>
  <body>
  <header>
      <div class="logo">
        <img src="../assets/img/log.png" alt="" />
      </div>
      <nav>
        <ul>
          <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
        </ul>
      </nav>
    </header>
    <div class="container">
      <h1>Ayo Lacak Status Pengaduan Disini</h1>

      <!-- Form untuk memasukkan ID Pengaduan -->
      <form action="lacak_pengaduan.php" method="GET">
        <div class="form-group">
          <label for="id_pengaduan">Masukkan ID Pengaduan:</label>
          <input type="text" id="id_pengaduan" name="id_pengaduan" required />
          <button type="submit">Lacak</button>
        </div>
      </form>
      <?php
    // Menampilkan hasil pelacakan pengaduan jika ada
    if (isset($_GET['id_pengaduan'])) {
        include '../controllers/lacak_pengaduan.php'; // Memasukkan file PHP untuk proses pelacakan
    }
    ?>
    </div>
  </body>
</html>
