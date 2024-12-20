<?php
session_start();

// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'zanproject_db');
if ($conn->connect_error) {
    die("Error database: " . $conn->connect_error);
}

// login proses
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Simpan ID Admin dalam session
        $_SESSION['admin_id'] = $row['id'];

        // Update timestamp for login
        $updateSql = "UPDATE admin SET logs_riwayat = NOW() WHERE id = " . $row['id'];
        $conn->query($updateSql);

        // Redirect ke halaman dashboard admin
        header("Location: Dashboard_Admin/"); 
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style1.css">
    <title>Login | TGB - Property</title>
</head>
<body>
    <form action="" method="POST" class="login-box">
        <div class="login-header">
            <header>Login Admin </header>
        </div>
        <div class="input-box">
            <input type="text" name="username" class="input-field" placeholder="username" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" class="input-field" id="passwordField" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="forgot">
            <section>
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Lihat Sandi</label>
            </section>
            <section>
                <a href="#">Forgot password</a>
            </section>
        </div>
        <div class="input-submit">
            <button class="submit-btn" name="login" id="submit"></button>
            <label for="submit">Login</label>
        </div>
    </form>
    <script>
        
        function togglePassword(){
            var passwordField = document.getElementById('passwordField');
            var showPasswordCheckbox = document.getElementById('showPassword');

           
            if (showPasswordCheckbox.checked) {
                passwordField.type = 'text'; 
            } else {
                passwordField.type = 'password'; 
            }
        }
    </script>
</body>
</html>