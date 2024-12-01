document.querySelector("form").addEventListener("submit", function (e) {
  const nama = document.getElementById("nama").value.trim();
  const deskripsi = document.getElementById("deskripsi").value.trim();

  if (!nama || !deskripsi) {
    e.preventDefault();
    alert("Nama dan Deskripsi Pengaduan harus diisi!");
  }
});
// Modal Script
const modal = document.getElementById("modal-update");
const closeBtn = document.querySelector(".close-btn");
const updateButtons = document.querySelectorAll(".btn-update");

updateButtons.forEach((button) => {
  button.addEventListener("click", () => {
    modal.style.display = "flex";
  });
});

closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});
// Pelacakan Riwayat
const idPengaduan = getIdPengaduanFromURL(); // Ambil ID dari URL
fetch(`/controllers/riwayat_pengaduan.php?id=${idPengaduan}`)
  .then((response) => response.json())
  .then((data) => {
    const tableBody = document.getElementById("riwayat-data");
    tableBody.innerHTML = data
      .map(
        (row) => `
            <tr>
                <td>${row.status}</td>
                <td>${row.deskripsi}</td>
                <td>${row.tanggal}</td>
            </tr>
        `
      )
      .join("");
  });
// Riwayat
const date = new Date(data.tanggal_pengaduan);
const formattedDate = date.toLocaleString("id-ID", {
  day: "2-digit",
  month: "long",
  year: "numeric",
  hour: "2-digit",
  minute: "2-digit",
  second: "2-digit",
});
