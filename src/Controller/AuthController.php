<?php

// session_start(); // untuk mengaktif kan fitur sesion aagar browser mengetahui siapa yang login sekarang

if (session_status() === PHP_SESSION_NONE){
    session_start();
}


require_once __DIR__ . "/../Database/koneksi.php";

function prosesOutentikasiLogin($username, $password){
    $konekToDb = ambilKoneksiDatabase();

    $sql = "SELECT id, username, nama_lengkap, role FROM users WHERE username = ? AND password = ? LIMIT 1";
    $steatment = mysqli_prepare($konekToDb, $sql);
    mysqli_stmt_bind_param($steatment, "ss", $username, $password);
    mysqli_stmt_execute($steatment);
    $result = mysqli_stmt_get_result($steatment);

    if ($user = mysqli_fetch_assoc($result)){
        // simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];

        return true;
    }
    // $usernameClean = mysqli_real_escape_string($konekToDb, $username );
    // $passwordClean = mysqli_real_escape_string($konekToDb, $password);

    // $sql = "SELECT id FROM users WHERE username = '$usernameClean' AND password = '$passwordClean' LIMIT 1";
    // $query = mysqli_query($konekToDb, $sql);

    // if(mysqli_num_rows($query) > 0){
    //     mysqli_close($konekToDb);
    //     return true;
    // }
    mysqli_close($konekToDb);
    return false;
}

function logout(){
    session_unset(); // hapus semua variabel session
    session_destroy(); // hancurkan sesion yang ada

    return true;

}

?>