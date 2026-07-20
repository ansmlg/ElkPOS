<?php

session_start();
header("Content-Type: application/json");

// chek apa kah ada ini dari session
if (isset($_SESSION['role'])){
    echo  json_encode([
        "status" => "login",
        "nama" => $_SESSION['nama'],
        "role" => $_SESSION['role']
    ]);
}else{
    echo json_encode([
        "status" => "not_login"
    ]);
}

?>
