<?php
include '../config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "SELECT * FROM properties WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $property = mysqli_fetch_assoc($result);

    if ($property) {
        
        $imagePath = "uploads/" . $property['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); 
        }

        
        $delete_query = "DELETE FROM properties WHERE id = '$id'";

        if (mysqli_query($conn, $delete_query)) {
            echo "Property deleted successfully.";
            header('Location: index.php'); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Property not found!";
    }
} else {
    echo "No property ID specified!";
}
?>
