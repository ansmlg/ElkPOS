<?php

require_once __DIR__ . "/../Database/koneksi.php";



class ProdukController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // endpoint mengambilsemua data dari tabel produk
    public function getDataProduk()
    {
        $konkekToDb = ambilKoneksiDatabase();
        $sql = "SELECT 
                    p.id, 
                    k.nama_kategori, 
                    p.barcode, 
                    p.nama_produk, 
                    p.harga_jual,
                    p.stok 
                FROM produk p 
                JOIN kategori k 
                ON k.id = p.kategori_id";
        $query = mysqli_execute_query($konkekToDb, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo json_encode([
            "status" => "sukses",
            "data" => $result
        ]);

        mysqli_close($konkekToDb);
        exit;
    }

    public function addDataProduk()
    {
        // 1. Ambil data teks mentah (JSON) dari body request fetch
        $inputMentahJson = file_get_contents("php://input"); // [1, 3]
        // 2. Ubah teks JSON menjadi Array PHP (Associative Array)
        $dataInputObjek = json_decode($inputMentahJson, true); // [1]
        // 3. Validasi Dasar: Pastikan semua kolom wajib diisi
        if (
            empty($dataInputObjek['nama_produk']) || empty($dataInputObjek['barcode']) ||
            empty($dataInputObjek['harga_jual']) || empty($dataInputObjek['stok'])
        ) {
            echo json_encode([
                "status" => "error",
                "pesan" => "Data produk tidak lengkap!"
            ]);
            exit;
        }
        // 4. Ambil jembatan koneksi ke database
        $koneksi = ambilKoneksiDatabase(); // [4, 5]
        // 5. Gunakan PREPARED STATEMENTS agar aman dari SQL Injection [6, 7]
        $query = "INSERT INTO produk 
                            (kategori_id, 
                            nama_produk, 
                            barcode, 
                            harga_jual, 
                            stok) 
                        VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        // 6. Ikat data ke tanda tanya (?): s = string, i = integer
        // Urutan: nama (s), barcode (s), harga (i), stok (i)
        mysqli_stmt_bind_param(
            $stmt,
            "issii",
            $dataInputObjek['kategori_id'],
            $dataInputObjek['nama_produk'],
            $dataInputObjek['barcode'],
            $dataInputObjek['harga_jual'],
            $dataInputObjek['stok']
        );
        // 7. Eksekusi perintah ke gudang database
        if (mysqli_stmt_execute($stmt)) {
            // Jika sukses, kirim respon JSON ke frontend [5, 8]
            echo json_encode([
                "status" => "sukses",
                "pesan" => "Produk baru berhasil disimpan ke gudang!"
            ]);
        } else {
            // Jika gagal (misal barcode duplikat)
            echo json_encode([
                "status" => "error",
                "pesan" => "Gagal menyimpan produk: " . mysqli_error($koneksi)
            ]);
        }
        // Tutup aliran data
        mysqli_stmt_close($stmt);
        mysqli_close($koneksi);
        exit;
    }

    // hapus data produk
    public function deleteDataProduk()
    {
        $input = file_get_contents('php://input');
        $dataObjek = json_decode($input, true);
        $produk_id = $dataObjek['id'];
        $koneksi = ambilKoneksiDatabase();
        $sql = "DELETE FROM produk WHERE id = ? ";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $produk_id);
        if (mysqli_stmt_execute($stmt)){
            echo json_encode([
                "status" => "sukses",
                "pesan" => "Produk behasil di hapus"
            ]);
        }else{
            echo json_encode([
                "status" => "error",
                "pesan" => "Gagal Meghapusdata"
            ]);
        }
          // Tutup aliran data
        mysqli_stmt_close($stmt);
        mysqli_close($koneksi);
        exit;
    }


}
