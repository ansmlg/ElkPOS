<?php

// Set response default selalu JSON
header("Content-Type: application/json");

// Import Class Controller yang dibutuhkan
require_once __DIR__ . "/../../src/Controller/AuthController.php";
require_once __DIR__ . "/../../src/Controller/ProdukController.php";

// Ambil path URI request saat ini
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Inisialisasi Controller
$authController = new AuthController();
$produkController = new ProdukController();

// Routing System
switch ($uri) {
    case '/api/login':
        if ($method === 'POST') {
            $authController->login();
        } else {
            http_response_code(405);
            echo json_encode(["status" => "error", "pesan" => "Method Not Allowed"]);
        }
        break;

    case '/api/check-session':
        if ($method === 'GET') {
            $authController->checkSession();
        } else {
            http_response_code(405);
            echo json_encode(["status" => "error", "pesan" => "Method Not Allowed"]);
        }
        break;

    case '/api/logout':
        if ($method === 'POST' || $method === 'GET') {
            $authController->logout();
        }
        break;

    case '/api/lihat-produk':
        if($method === 'GET'){
            $produkController->getDataProduk();
        }
        break;

    case '/api/tambah-produk':
        if($method === 'POST'){
            $produkController->addDataProduk();
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["status" => "error", "pesan" => "Endpoint tidak ditemukan"]);
        break;
}