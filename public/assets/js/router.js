document.addEventListener("DOMContentLoaded", function () {
    // cek session
    fetch('/api/check-session')
        .then(response => response.json())
        .then(dataRespon => {
            if (dataRespon.status !== "login") {
                window.location.href = '../auth/login.html';
            }
            const nama = document.getElementById('nama');
            nama.innerText = dataRespon.nama;
            const role = document.getElementById('role');
            if (dataRespon.role === "admin") {
                role.innerText = "Admin";
            } else if (dataRespon.role === "kasir") {
                role.innerText = "Kasir";
            } else {
                role.innerText = "Owner";
            }
        })

    const menuLinks = document.querySelectorAll('#sidebar_menu .nav-link');
    const contentArea = document.getElementById('content_area');

    // 1. FUNGSI UTAMA UNTUK MENGAMBIL FILE HTML LUAR
    function loadPage(pageUrl) {
        fetch(pageUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Gagal memuat halaman (${response.status})`);
                }
                return response.text(); // Ubah file mentah menjadi teks HTML
            })
            .then(htmlContent => {
                // Suntikkan isi file HTML ke dalam tag <main>
                contentArea.innerHTML = htmlContent;
                // console.log(pageUrl)
                if (pageUrl === 'pages/stok_produk.html') {
                    const script = document.createElement('script');
                    script.src = "/assets/js/stok_produk.js";
                    document.body.appendChild(script);
                }

                const modalElement = document.getElementById('modalPembayaran');
                if (modalElement) {
                    // Daftarkan ulang modal tersebut ke sistem Bootstrap secara manual
                    const modalPembayaran = new bootstrap.Modal(modalElement);

                    // Cari tombol proses bayar
                    const btnProsesBayar = document.querySelector('[data-bs-target="#modalPembayaran"]');
                    if (btnProsesBayar) {
                        // Pasang sensor klik manual untuk memunculkan modal
                        btnProsesBayar.addEventListener('click', function () {
                            modalPembayaran.show();
                        });
                    }
                }
            })
            .catch(error => {
                contentArea.innerHTML = `
                    <div class="alert alert-danger border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Sistem Error:</strong> ${error.message}. Pastikan file target ada di folder pages/.
                    </div>
                `;
            });
    }

    // 2. HALAMAN AWAL (DEFAULT)
    // Saat aplikasi pertama dibuka, otomatis sedot pages/dashboard.html\
    const defaulPage = 'pages/stok_produk.html'
    loadPage(defaulPage);

    // 3. LOGIKA KETIKA MENU SIDEBAR DIKLIK
    menuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Mengunci agar browser tidak reload halaman
            const targetPage = this.getAttribute('data-page');
            if (targetPage) {
                loadPage(targetPage); // Jalankan fungsi fetch halaman baru
                updateSidebarUI(this); // Geser warna indikator aktif (kuning)
            }
        });
    });

    // 4. FUNGSI EFEK VISUAL SIDEBAR (Pindah Warna Aktif)
    function updateSidebarUI(clickedLink) {
        menuLinks.forEach(link => {
            link.classList.remove('active', 'bg-warning', 'text-dark', 'fw-semibold');
            link.classList.add('text-white');
        });

        clickedLink.classList.add('active', 'bg-warning', 'text-dark', 'fw-semibold');
        clickedLink.classList.remove('text-white');
    }

    // TENTUKAN WARNA TOMBOL AKTIF DI AWAL 
    const defaultLink = Array.from(menuLinks).find(link => link.getAttribute('data-page') === defaulPage);
    if (defaultLink) {
        updateSidebarUI(defaultLink);
    }



    // fungsi logout
    document.getElementById("logout").addEventListener('click', function keluar() {
        if (confirm("Apakah anda yakin ingin logout?")) {
            fetch("/api/logout", {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "sukses") {
                        window.location.href = '../index.html';
                    }
                })
                .catch(
                    error => console.error("Gagal Logout: ", error)
                )
        }
    })

});