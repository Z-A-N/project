<?php
include '../admin/config.php';  

if (isset($_POST['submit'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);  
    
    $stmt->bind_param("s", $email);

    
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        
        if (password_verify($password, $user['password'])) {
            
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: Dashboard/index.html"); 
            exit();
        } else {
            
            $message = "Password yang Anda masukkan salah!";
        }
    } else {
        
        $message = "Email tidak ditemukan!";
    }
}

?>