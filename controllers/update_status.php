<?php
include '../config/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Validasi input
    if (empty($id) || empty($status)) {
        echo "ID atau Status tidak boleh kosong!";
        exit;
    }

    // Gunakan prepared statements untuk menghindari SQL Injection
    $stmt = $conn->prepare("UPDATE pengaduan SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {
        // Ambil email pengguna, nama pengadu, deskripsi pengaduan berdasarkan ID
        $result = $conn->query("SELECT email_pengadu, nama_pengadu, deskripsi FROM pengaduan WHERE id = $id");
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Kirim email notifikasi
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP provider Anda
                $mail->SMTPAuth = true;
                $mail->Username = 'fleksibel027@gmail.com'; // Email pengirim
                $mail->Password = 'vzlk jwhc lmdr phgd'; // App Password Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Gunakan TLS
                $mail->Port = 587; // Port untuk TLS

                $mail->setFrom('fleksibel027@gmail.com', 'PTSP Papua');
                $mail->addAddress($user['email_pengadu']); // Email pengguna

                $mail->isHTML(true);
                $mail->Subject = 'Status Pengaduan Anda Diperbarui';
                $mail->Body = "
                    <p>Yth. {$user['nama_pengadu']},</p>
                    <p>Status pengaduan Anda telah diperbarui menjadi: <strong>$status</strong>.</p>
                    <p><strong>ID Pengaduan:</strong> $id</p>
                    <p><strong>Deskripsi Pengaduan:</strong> {$user['deskripsi']}</p>
                    <p>Silahkan melakukan pelcakan pengaduan anda mengunakan id di atas dan untuk informasih lebih lanjut bisa hubungi kami atau datang ke antor Ptsp Papua.</p>
                    <p>Terima kasih,<br>PTSP Papua</p>
                ";

                $mail->send();
                echo "Status berhasil diperbarui dan email notifikasi terkirim!";
            } catch (Exception $e) {
                echo "Status berhasil diperbarui, tetapi email gagal dikirim: {$mail->ErrorInfo}";
            }
        } else {
            echo "Pengguna tidak ditemukan!";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Metode tidak valid!";
}

// Tambahkan riwayat perubahan status
$pengaduan = $conn->query("SELECT status FROM pengaduan WHERE id = $id")->fetch_assoc();
$status_awal = $pengaduan['status'];

$sqlRiwayat = "INSERT INTO riwayat_status (id_pengaduan, status_awal, status_baru) 
               VALUES ($id, '$status_awal', '$status')";
$conn->query($sqlRiwayat);

?>
