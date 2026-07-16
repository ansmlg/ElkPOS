<?php

require_once __DIR__ . "/../Database/koneksi.php";

function prosesOutentikasiLogin($username, $password){
    $konekToDb = ambilKoneksiDatabase();

    $usernameClean = mysqli_real_escape_string($konekToDb, $username );
    $passwordClean = mysqli_real_escape_string($konekToDb, $password);

    $sql = "SELECT id FROM users WHERE username = '$usernameClean' AND password = '$passwordClean' LIMIT 1";
    $query = mysqli_query($konekToDb, $sql);

    if(mysqli_num_rows($query) > 0){
        mysqli_close($konekToDb);
        return true;
    }
    mysqli_close($konekToDb);
    return false;
}

?>