<?php
// Letak: src/Database/koneksi.php

function ambilKoneksiDatabase() {
    // SESUAIKAN PASSWORD (parameter ke-3) menjadi "rootdb"
    $kabelKoneksi = mysqli_connect("db", "root", "rootdb", "db_pos");

    if (!$kabelKoneksi) {
        header("Content-Type: application/json");
        echo json_encode(["error" => "Koneksi database gagal di layer src: " . mysqli_connect_error()]);
        exit;
    }

    return $kabelKoneksi;
}