<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php"); 
    exit();
}
include '../config.php'; 


$query = "SELECT * FROM properties";
$result = mysqli_query($conn, $query);

// Periksa apakah ada data yang ditemukan
if (!$result) {
    echo "Error: " . mysqli_error($conn);
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
	<!-- Shortcut Icon -->
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
	</style>

	<title>Admin - PropertyHub</title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img class="side-logo" src="img/logo.png" alt="Logo_PropertyHub">
			<span class="text">PropertyHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="create.php">
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
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="../logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search properties...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png" alt="Profile">
			</a>
		</nav>
		<!-- NAVBAR -->

		<main>
    <!-- Dashboard Heading -->
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Home</a></li>
            </ul>
        </div>
    </div>

    <!-- Box Info Section -->
    <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3>120</h3>
                <p>New Listings</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3>834</h3>
                <p>Clients</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3>$1.2M</h3>
                <p>Total Sales</p>
            </span>
        </li>
    </ul>

    <!-- Properties Heading -->
    <div class="head-title">
        <div class="left">
            <h1>Properties</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Properties</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <!-- Property Image -->
                    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"
                        class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text"><?php echo $row['location']; ?></p>
                        <p class="card-text text-success">$<?php echo number_format($row['price'], 2); ?></p>

                        <!-- Edit and Delete Buttons -->
                        <div class="d-flex justify-content-center">
                            <!-- Edit Button -->
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mx-2">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger mx-2" 
                               onclick="return confirm('Are you sure you want to delete this property?')">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</main>



		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>