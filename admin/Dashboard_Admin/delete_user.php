<?php
include '../config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "SELECT * FROM customers WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $customers = mysqli_fetch_assoc($result);

        
        $delete_query = "DELETE FROM customers WHERE id = '$id'";

        if (mysqli_query($conn, $delete_query)) {
            echo "customer deleted successfully.";
            header('Location: costumer.php'); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Customer not found!";
    }

?>
