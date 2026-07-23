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

        $sql = "SELECT * FROM produk";
        $query = mysqli_execute_query($konkekToDb, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

            echo json_encode([
                "status" => "sukses",
                "data" => $result
            ]);
    }
}

?>
