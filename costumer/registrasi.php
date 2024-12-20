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

    // Check if the email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        // Insert the user into the database
        $insert_sql = "INSERT INTO customers (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($insert_sql) === TRUE) {
            $message = "Registration successful! You can now login.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>