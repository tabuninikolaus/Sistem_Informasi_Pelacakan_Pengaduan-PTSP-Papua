// Ambil data pengaduan dari server
fetch("../controllers/get_pengaduan.php")
  .then((response) => response.json())
  .then((data) => {
    const tbody = document.getElementById("data-pengaduan");
    data.forEach((pengaduan) => {
      const row = `
                <tr>
                    <td>${pengaduan.id}</td>
                    <td>${pengaduan.nama_pengadu}</td>
                    <td>${pengaduan.kategori_pengaduan}</td>
                    <td>${pengaduan.tanggal_pengaduan}</td>
                    <td>${pengaduan.status}</td>
                    <td>
                        <button class="btn-update" data-id="${pengaduan.id}">Update Status</button>
                    </td>
                </tr>
            `;
      tbody.innerHTML += row;
    });
  });

// Modal logic
const modal = document.getElementById("modal-update");
const closeModal = document.querySelector(".close-btn");

document.body.addEventListener("click", function (e) {
  if (e.target.classList.contains("btn-update")) {
    const id = e.target.dataset.id;
    document.getElementById("pengaduan-id").value = id;
    modal.style.display = "block";
  }
});

closeModal.addEventListener("click", function () {
  modal.style.display = "none";
});

// Kirim data update status ke server
document.getElementById("update-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  fetch("../controllers/update_status.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      modal.style.display = "none";
      location.reload(); // Refresh data di dashboard
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modal-update");
  const closeModal = document.querySelector(".close-btn");
  const form = document.getElementById("update-form");

  // Buka modal dengan ID pengaduan
  document.body.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-update")) {
      const id = e.target.dataset.id;
      document.getElementById("pengaduan-id").value = id;
      modal.style.display = "block";
    }
  });

  // Tutup modal
  closeModal.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Submit form untuk update status
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("../controllers/update_status.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data); // Tampilkan pesan dari server
        modal.style.display = "none";
        location.reload(); // Refresh halaman
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Gagal memperbarui status.");
      });
  });
});
// Pencarian & Filter
document.addEventListener("DOMContentLoaded", () => {
  const tbody = document.getElementById("data-pengaduan");
  const searchInput = document.getElementById("search");
  const filterStatus = document.getElementById("filter-status");
  const applyFiltersButton = document.getElementById("apply-filters");

  // Fungsi untuk memuat data pengaduan
  function loadPengaduan(search = "", status = "all") {
    const url = `../controllers/get_pengaduan.php?search=${search}&status=${status}`;
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        tbody.innerHTML = ""; // Kosongkan tabel sebelum memuat data baru
        data.forEach((pengaduan) => {
          const row = `
                        <tr>
                            <td>${pengaduan.id}</td>
                            <td>${pengaduan.nama_pengadu}</td>
                            <td>${pengaduan.kategori_pengaduan}</td>
                            <td>${pengaduan.tanggal_pengaduan}</td>
                            <td>${pengaduan.status}</td>
                            <td>
                                <button class="btn-update" data-id="${pengaduan.id}">Update Status</button>
                            </td>
                        </tr>
                    `;
          tbody.innerHTML += row;
        });
      })
      .catch((error) => console.error("Error fetching data:", error));
  }

  // Event listener untuk tombol "Terapkan"
  applyFiltersButton.addEventListener("click", () => {
    const searchValue = searchInput.value;
    const filterValue = filterStatus.value;
    loadPengaduan(searchValue, filterValue);
  });

  // Muat data pengaduan saat pertama kali halaman dibuka
  loadPengaduan();
});
