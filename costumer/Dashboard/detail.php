<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../../admin/config.php';

if (!isset($_GET['id'])) {
    die("Properti tidak ditemukan!");
}

$id = $_GET['id'];

$query = "SELECT * FROM properties WHERE id = $id";
$result = mysqli_query($conn, $query);
$property = $result->fetch_assoc();

if (!$property) {
    die("Properti tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Properti</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* CSS untuk halaman detail properti */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero {
            position: relative;
        }

        .hero img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .hero .info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 15px;
            border-radius: 5px;
        }

        .hero .info h1 {
            margin: 0;
            font-size: 24px;
        }

        .property-details {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .property-details .image-gallery img {
            width: 100%;
            border-radius: 10px;
        }

        .property-details .details h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .property-details .details p {
            margin: 10px 0;
        }

        .features ul {
            padding: 0;
            list-style: none;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .features ul li {
            background: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
        }

        .contact-form {
            margin-top: 40px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .contact-form h3 {
            margin-bottom: 20px;
        }

        .contact-form input,
        .contact-form textarea,
        .contact-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .contact-form button {
            background: #174076;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .contact-form button:hover {
            background: #2A6BC2;
        }

        /* Styling untuk tombol kembali */
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #174076;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
        }

        .back-button:hover {
            background-color: #2A6BC2;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol Kembali -->
        <a href="javascript:history.back()" class="back-button">Kembali</a>

        <!-- Hero Section -->
        <div class="hero">
            <img src="../../admin/Dashboard_Admin/uploads/<?php echo $property['image']; ?>" alt="<?php echo $property['name']; ?>">
            <div class="info">
                <h1><?php echo $property['name']; ?></h1>
                <p>Rp <?php echo number_format($property['price'], 2); ?></p>
            </div>
        </div>

        <!-- Detail Properti -->
        <div class="property-details">
            <!-- Galeri Gambar -->
            <div class="image-gallery">
                <img src="../../admin/Dashboard_Admin/uploads/<?php echo $property['image']; ?>" alt="<?php echo $property['name']; ?>">
            </div>
            <!-- Informasi Properti -->
            <div class="details">
                <h2>Deskripsi Properti</h2>
                <p><?php echo $property['description']; ?></p>
                <h3>Lokasi: <?php echo $property['location']; ?></h3>
            </div>
        </div>

        <!-- Formulir Kontak -->
        <div class="contact-form">
            <h3>Tertarik? Hubungi Kami</h3>
            <form action="#">
                <input type="text" placeholder="Nama Anda" required>
                <input type="email" placeholder="Email Anda" required>
                <textarea rows="5" placeholder="Pesan Anda"></textarea>
                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>
</body>
</html>
