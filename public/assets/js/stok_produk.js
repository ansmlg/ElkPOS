
function initStokProduk() {
    fetch("/api/lihat-produk", {
        method: "GET",
    }).then((response) => {
        return response.json();
    }).then((ress) => {
        if (ress.status === "sukses") {
            let barisHTML = "";
            const tabel = document.getElementById("table_produk");
            ress.data.forEach((produk) => {
                barisHTML += `
            <tr>
            <td class="ps-4 fw-semibold text-secondary">#${produk.id}</td>
            <td>
                    <span class="badge bg-light text-dark border">
                    ${produk.nama_kategori || "-"}
                    </span>
                </td>
                <td>
                    <code class="text-dark">${produk.barcode || produk.sku || "-"}</code>
                </td>
                <td class="fw-bold text-dark">${produk.nama_produk}</td>
                <td class="fw-semibold text-success">
                Rp ${Number(produk.harga_jual).toLocaleString("id-ID")}
                </td>
                <td>
                    <span class="badge ${produk.stok <= 5 ? "bg-danger-subtle text-danger" : "bg-success-subtle text-success"} fw-bold">
                        ${produk.stok} Unit
                    </span>
                </td>
                <td class="pe-4 text-center">
                    <button class="btn btn-sm btn-outline-warning me-1 btn-edit" data-id="${produk.id}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger btn-hapus" data-id="${produk.id}">
                    <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            `;
            });
            tabel.innerHTML = barisHTML;
        }
    });
}

// tambah produk
const fromTambahProduk = document.getElementById('formTambahProduk')
fromTambahProduk.addEventListener('submit', async function (e) {
    e.preventDefault();
    const data = {
        kategori_id: this.kategori_id.value,
        nama_produk: this.nama_produk.value,
        barcode: this.barcode.value,
        harga_jual: this.harga_jual.value,
        stok: this.stok.value
    }
    try {
        const response = await fetch('/api/tambah-produk', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const result = await response.json();
        // masih perlu perbaikan di sisni
        const modalElement = document.getElementById('modalTambahProduk');
        // Buat instance Bootstrap modal dari elemen tersebut
        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
        // Sekarang fungsi hide() bisa digunakan tanpa error
        if (result.status === "sukses") {
            modal.hide();
            this.reset();
            initStokProduk();
        }
    } catch (error) {
        console.log('Gagal mengirim data:', error);
    }
})



// hapus produk
// Contoh jika Anda menggunakan event listener pada tabel
const tabel = document.getElementById('table_produk');
tabel.addEventListener('click', function (e) {
    // Cari apakah yang diklik adalah tombol hapus atau edit
    const tombol = e.target.closest('.btn-hapus');
    if (tombol) {
        // Ambil ID dari atribut data-id tombol tersebut
        const produk_id = tombol.getAttribute('data-id');
        if (confirm("Apakah Kamu yakin?")) {
            fetch('/api/hapus-produk', {
                method: 'POST',
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ "id": produk_id })
            }).then(response => {
                return response.json()
            }).then(result => {
                if (result.status == "sukses") {
                    alert(result.pesan)
                    initStokProduk();
                } else {
                    alert(result.pesan);
                }
                return;
            })
        }
    }
});



// console.log(tabel);
// // edit prosuk
// tabel.addEventListener('click', function (element){
//     const tombol = element.target.closest('.btn-edit');
//     if (tombol){
//         const produk_id = tombol_
//     }
// })


