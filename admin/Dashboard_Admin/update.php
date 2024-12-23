<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current property details
    $query = "SELECT * FROM properties WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $property = mysqli_fetch_assoc($result);

    if (!$property) {
        echo "Property not found!";
        exit();
    }

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        // Handle image update if a new image is uploaded
        if ($image) {
            $target = "uploads/";
            $file = $target . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                // Delete old image from the server
                unlink($target . $property['image']);
            } else {
                echo "Failed to upload image.";
                exit();
            }
        } else {
            $image = $property['image']; // Keep the old image if no new image is uploaded
        }

        // Update the property details in the database
        $update_query = "UPDATE properties SET name = '$name', price = '$price', location = '$location', description = '$description', image = '$image' WHERE id = '$id'";
        
        if (mysqli_query($conn, $update_query)) {
            echo "Property updated successfully.";
            header('Location: index.php'); // Redirect to the property list page
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "No property ID specified!";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Shortcut icon -->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <!-- My CSS -->
    <link rel="stylesheet" href="style2.css">
    <style>
        #sidebar .brand .side-logo {
            width: 45px;
            margin-right: 15px;
            display: flex;
            justify-content: center;
        }
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        :root {
            --poppins: 'Poppins', sans-serif;
            --lato: 'Lato', sans-serif;
            --light: #F9F9F9;
            --blue: #3C91E6;
            --light-blue: #CFE8FF;
            --grey: #eee;
            --dark-grey: #AAAAAA;
            --dark: #342E37;
            --red: #DB504A;
            --yellow: #FFCE26;
            --light-yellow: #FFF2C6;
            --orange: #FD7238;
            --light-orange: #FFE0D3;
        }

        html {
            overflow-x: hidden;
        }

        body.dark {
            --light: #0C0C1E;
            --grey: #060714;
            --dark: #FBFBFB;
        }

        body {
            background: var(--grey);
            overflow-x: hidden;
            font-family: var(--poppins);
        }

        /* SIDEBAR */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100%;
            background: var(--light);
            z-index: 2000;
            font-family: var(--lato);
            transition: .3s ease;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        #sidebar.hide {
            width: 60px;
        }

        #sidebar .brand {
            margin-left: 10px;
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            color: var(--blue);
            position: sticky;
            top: 0;
            left: 0;
            background: var(--light);
            z-index: 500;
            padding-bottom: 20px;
            box-sizing: content-box;
        }

        #sidebar .side-menu {
            width: 100%;
            margin-top: 48px;
        }

        #sidebar .side-menu li {
            height: 48px;
            background: transparent;
            margin-left: 6px;
            border-radius: 48px 0 0 48px;
            padding: 4px;
        }

        #sidebar .side-menu li.active {
            background: var(--grey);
            position: relative;
        }

        #sidebar .side-menu li a {
            width: 100%;
            height: 100%;
            background: var(--light);
            display: flex;
            align-items: center;
            border-radius: 48px;
            font-size: 16px;
            color: var(--dark);
            white-space: nowrap;
            overflow-x: hidden;
            transition: 0.3s;
        }

        #sidebar .side-menu li a:hover {
            background-color: var(--light-blue);
            color: var(--blue);
        }

        #sidebar .side-menu li.active a {
            color: var(--blue);
        }

        /* CONTENT */
        #content {
            position: relative;
            width: calc(100% - 280px);
            left: 280px;
            transition: .3s ease;
        }

        #sidebar.hide ~ #content {
            width: calc(100% - 60px);
            left: 60px;
        }

        #content nav {
            height: 56px;
            background: var(--light);
            padding: 0 24px;
            display: flex;
            align-items: center;
            grid-gap: 24px;
            font-family: var(--lato);
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        #content main {
            width: 100%;
            padding: 36px 24px;
            font-family: var(--poppins);
            max-height: calc(100vh - 56px);
            overflow-y: auto;
        }

        /* FORM STYLE */
        .form-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 32px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group input[type="file"] {
            padding: 8px;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--blue);
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            border-radius: 6px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: var(--dark);
        }

        .btn-secondary {
            background-color: var(--grey);
            color: var(--dark);
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: var(--light-grey);
        }
    </style>

    <title>Admin - PropertyHub</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img class="side-logo" src="img/logo.png" alt="Logo_TGB">
            <span class="text">PropertyHub</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class='bx bxs-home'></i>
                    <span class="text">Properti</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-user'></i>
                    <span class="text">Costumer</span>
                </a>
            </li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png" alt="profile">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main class="main-content">
        <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Update Property</a></li>
            </ul>
        </div>
    </div>
            <section class="form-section">
            <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nama Properti</label>
                        <input type="text" id="name" name="name" value="<?php echo $property['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Properti</label>
                        <input type="number" id="price" name="price" value="<?php echo $property['price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Lokasi Properti</label>
                        <input type="text" id="location" name="location" value="<?php echo $property['location']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Properti</label>
                        <textarea id="description" name="description" required><?php echo $property['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Gambar (Leave blank to keep current image)</label>
                        <input type="file" id="image" name="image">
                        <br>
                        <?php if ($property['image']): ?>
                            <img src="uploads/<?php echo $property['image']; ?>" alt="Property Image" style="width: 100px; height: auto;">
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="submit" class="btn-primary">Update</button>
                    <a href="./" class="btn-secondary">Cancel</a>
                </form>
            </section>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>
</body>

</html>
