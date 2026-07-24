fetch('/api/lihat-produk', {
    method: "GET"
})
    .then(response => {
        return response.json();
    })
    .then(ress => {
        // console.log(ress.status);
        if (ress.status === "sukses") {
            let barisHTML = '';
            const tabel = document.getElementById("table_produk");
            ress.data.forEach(produk => {
                barisHTML += `
                <tr>
                    <td class="ps-4 fw-semibold text-secondary">#${produk.id}</td>
                    <td>
                        <span class="badge bg-light text-dark border">
                            ${produk.nama_kategori || '-'}
                        </span>
                    </td>
                    <td>
                        <code class="text-dark">${produk.barcode || produk.sku || '-'}</code>
                    </td>
                    <td class="fw-bold text-dark">${produk.nama_produk}</td>
                    <td class="fw-semibold text-success">
                        Rp ${Number(produk.harga_jual).toLocaleString('id-ID')}
                    </td>
                    <td>
                        <span class="badge ${produk.stok <= 5 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success'} fw-bold">
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
                `
            });
            tabel.innerHTML = barisHTML;
        }
    })