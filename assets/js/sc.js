window.onload = function () {
  // Ambil parameter dari URL
  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get("status");

  // Jika status = success, tampilkan modal
  if (status === "success") {
    document.getElementById("successModal").style.display = "flex"; // Gunakan flex, karena modal menggunakan display: flex
  }

  // Menutup modal saat tombol OK ditekan dan redirect ke landing page
  document.getElementById("closeModal").onclick = function () {
    document.getElementById("successModal").style.display = "none"; // Menutup modal terlebih dahulu
    window.location.href = "../views/index.html"; // Redirect ke landing page setelah klik OK
  };
};
