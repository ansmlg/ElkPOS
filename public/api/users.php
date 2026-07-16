<?php

header("Content-Type: application/json");

require_once __DIR__ . "/../../src/Controller/AuthController.php";

$methodRequest = $_SERVER['REQUEST_METHOD'];


if ($methodRequest === "POST"){
    $inputMetahJson = file_get_contents("php://input");
    $dataInputObjek = json_decode($inputMetahJson, true);

    if (empty($dataInputObjek['nama']) || empty($dataInputObjek['password'])) {
        echo json_encode([
            "status" => "gagal",
            "pesan" => "userneme dan password tidak boleh kosong!"
        ]);
        exit;
    }

    $loginSukses = prosesOutentikasiLogin($dataInputObjek['nama'], $dataInputObjek['password']);

    if ($loginSukses){
        echo json_encode([
            "status" => "sukses",
            "pesan" => "Login Berhasil! Selamat Datang."
        ]);
    }else{
        echo json_encode([
            "status" => "gagal",
            "pesan" => "Username Atau Password salah!"
        ]);
    }
    exit;
}


?>