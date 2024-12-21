<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php"); 
    exit();
}
include '../config.php'; 


$query = "SELECT * FROM properties";
$query_count = "SELECT COUNT(*) AS total_properties, SUM(price) AS total_price FROM properties";
$query_count_customers = "SELECT COUNT(*) AS total_customers FROM customers";

$result = mysqli_query($conn, $query);
$result_count = mysqli_query($conn, $query_count);
$result_customers = mysqli_query($conn, $query_count_customers);

$row = mysqli_fetch_assoc($result_count);
$row_customers = mysqli_fetch_assoc($result_customers);




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
	<link rel="stylesheet" href="style2.css?v=1.0"> 
	<!-- style2.css?v=1.0 apabila style tidak berubah pembersihan cache -->

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
			<li>
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
			<li class="active">
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
					<input type="search" placeholder="Search...">
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
                <li><a href="./">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Costumer</a></li>
            </ul>
        </div>
    </div>

    <!-- Box Info Section -->
    <ul class="box-info mb-10">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3><?php echo $row['total_properties']; ?></h3>
                <p>New Listings</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3><?php echo $row_customers['total_customers']; ?></h3>
                <p>Clients</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3><?php echo "Rp " . number_format($row['total_price'], 0, ',', '.'); ?></h3>
                <p>Total Sales</p>
            </span>
        </li>
    </ul>

    <div class="container_cus">
    <h2>Daftar Pengguna</h2>
    <table class="table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $query = "SELECT id, username, email FROM customers";
            $result = mysqli_query($conn, $query);

            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                    <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm mx-1'>Edit</a>
                    <a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm mx-1'
                       onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\")'>Hapus</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
	</div>

</div>
</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>
