<?php

require_once __DIR__ . "./../Database/koneksi.php";



class ProdukController{
    public function __construct(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    // endpoint mengambilsemua data dari tabel produk
    public function getDataProduk(){
        $konkekToDb = ambilKoneksiDatabase();

        $sql = "SELECT p.id, k.nama_kategori, p.barcode, p.nama_produk, p.harga_jual, p.stok FROM produk p JOIN kategori k ON k.id = p.kategori_id";
        $query = mysqli_execute_query($konkekToDb, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

            echo json_encode([
                "status" => "sukses",
                "data" => $result
            ]);
    }
}

?>
