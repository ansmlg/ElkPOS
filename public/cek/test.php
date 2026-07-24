<?php

// 1. Paksa PHP menampilkan error jika ada salah ketik

use LDAP\Result;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ini di perlukan ketika ingin melihat data tampildlam format json
header("Content-Type: application/json; charset=UTF-8");


require_once __DIR__ . "./../../src/Database/koneksi.php";


// endpoint mengambilsemua data dari tabel produk
function getDataProduk()
{
    $konkekToDb = ambilKoneksiDatabase();

    $sql = "SELECT p.id, k.nama_kategori, p.barcode, p.nama_produk, p.harga_jual, p.stok FROM produk p JOIN kategori k ON k.id = p.kategori_id";
    $query = mysqli_execute_query($konkekToDb, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    

    echo json_encode([
        "status" => "sukses",
        "data" => $result

    ]);

    mysqli_close($konkekToDb);
}

getDataProduk();


function getDataUser(){
    $conn = ambilKoneksiDatabase();

    $sql = "SELECT * FROM users";
    $query = mysqli_execute_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC) ;
    // $result = mysqli_fetch_assoc($query) ;


    echo json_encode($result);
}

// getDataUser();

?>