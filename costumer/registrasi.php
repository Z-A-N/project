<?php
$conn = new mysqli('localhost', 'root', '', 'zanproject_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    
    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        
        $insert_sql = "INSERT INTO customers (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($insert_sql) === TRUE) {
            $message = "Registration successful! You can now login.";
            header("Location: Dashboard/index.html");
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>