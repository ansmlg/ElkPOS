<?php 

require_once __DIR__ . "/../../src/Controller/AuthController.php";

header("Content-Type: application/json");

if (logout()){
    echo json_encode([
        "status" => "sukses",
        "pesan" => "Sesi berhasil di akhiri"
    ]);
}

exit;


?>