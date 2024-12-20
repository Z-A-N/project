<?php
include '../admin/config.php';  // Pastikan koneksi ke database benar

if (isset($_POST['submit'])) {
    // Ambil data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Gunakan prepared statements untuk menghindari SQL Injection
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = $connection->prepare($sql);  // Pastikan menggunakan variabel koneksi yang benar (conn)
    
    // Bind parameter
    $stmt->bind_param("s", $email);

    // Eksekusi query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan sesi
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.php"); // Redirect ke halaman dashboard
            exit();
        } else {
            // Pesan error jika password salah
            $message = "Password yang Anda masukkan salah!";
        }
    } else {
        // Pesan error jika email tidak ditemukan
        $message = "Email tidak ditemukan!";
    }
}

?>