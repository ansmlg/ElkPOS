<?php

require_once __DIR__ . "/../Database/koneksi.php";

class AuthController {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ==========================================
    // 1. ENDPOINT: LOGIN (Aman dengan Password Verify)
    // ==========================================
    public function login() {
        $input = json_decode(file_get_contents("php://input"), true);

        $username = trim($input['nama'] ?? '');
        $password = trim($input['password'] ?? '');

        if (empty($username) || empty($password)) {
            echo json_encode([
                "status" => "gagal",
                "pesan" => "Username dan password tidak boleh kosong!"
            ]);
            return;
        }

        $konekToDb = ambilKoneksiDatabase();

        // Cari user HANYA berdasarkan username
        $sql = "SELECT id, username, password, nama_lengkap, role FROM users WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($konekToDb, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            // Verifikasi Password Hash (Mendukung password_hash)
            if (password_verify($password, $user['password']) || $password === $user['password']) { 
                // Catatan: '$password === $user['password']' hanya untuk kompatibilitas password lama yang belum di-hash
                
                // Cegah Session Hijacking
                session_regenerate_id(true);

                // Simpan Sesi
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['role'];

                mysqli_close($konekToDb);

                echo json_encode([
                    "status" => "sukses",
                    "pesan" => "Login Berhasil! Selamat Datang.",
                    "user" => [
                        "nama" => $user['nama_lengkap'],
                        "role" => $user['role']
                    ]
                ]);
                return;
            }
        }

        mysqli_close($konekToDb);
        echo json_encode([
            "status" => "gagal",
            "pesan" => "Username atau password salah!"
        ]);
    }

    // ==========================================
    // 2. ENDPOINT: CHECK SESSION
    // ==========================================
    public function checkSession() {
        if (isset($_SESSION['role'])) {
            echo json_encode([
                "status" => "login",
                "user_id" => $_SESSION['user_id'],
                "nama" => $_SESSION['nama'],
                "role" => $_SESSION['role']
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["status" => "not_login"]);
        }
    }

    // ==========================================
    // 3. ENDPOINT: LOGOUT (Aman)
    // ==========================================
    public function logout() {
        $_SESSION = array(); // Kosongkan array session

        // Hapus cookie session di browser
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        echo json_encode([
            "status" => "sukses",
            "pesan" => "Sesi berhasil diakhiri"
        ]);
    }

    // ==========================================
    // 4. ENDPOINT BARU: GANTI PASSWORD
    // ==========================================
    public function changePassword() {
        // Wajib login dulu
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(["status" => "gagal", "pesan" => "Unauthorized"]);
            return;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $passwordLama = $input['password_lama'] ?? '';
        $passwordBaru = $input['password_baru'] ?? '';

        if (empty($passwordLama) || empty($passwordBaru)) {
            echo json_encode(["status" => "gagal", "pesan" => "Semua field harus diisi!"]);
            return;
        }

        $konekToDb = ambilKoneksiDatabase();
        $userId = $_SESSION['user_id'];

        // Ambil password saat ini dari DB
        $sql = "SELECT password FROM users WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($konekToDb, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($user && (password_verify($passwordLama, $user['password']) || $passwordLama === $user['password'])) {
            // Hash password baru sebelum disimpan!
            $hashBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);

            $updateSql = "UPDATE users SET password = ? WHERE id = ?";
            $updateStmt = mysqli_prepare($konekToDb, $updateSql);
            mysqli_stmt_bind_param($updateStmt, "si", $hashBaru, $userId);
            
            if (mysqli_stmt_execute($updateStmt)) {
                echo json_encode(["status" => "sukses", "pesan" => "Password berhasil diubah!"]);
            } else {
                echo json_encode(["status" => "gagal", "pesan" => "Gagal memperbarui password."]);
            }
        } else {
            echo json_encode(["status" => "gagal", "pesan" => "Password lama salah!"]);
        }

        mysqli_close($konekToDb);
    }
}