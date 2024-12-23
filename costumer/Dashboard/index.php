<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); 
    exit();
}
include '../../admin/config.php'; 

$query = "SELECT * FROM properties";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!--Icon-->
    <link
      rel="shortcut icon"
      href="assets/img/TGB_logo.png"
      type="image/x-icon"
    />
    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Font Awesome 6.3.0 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    />

    <link rel="stylesheet" href="style.css?=1.0" />
    <script src="main.js"></script>
    <title>ZanProject - Layanan Property Masa Kini</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-light fixed-top navbar-shadow"
      id="navv"
    >
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            src="./assets/img/TGB_logo.png"
            alt="TGB Logo"
            width="100"
            height="100"
            class="img-fluid"
          />
          <span class="text-primary">Property</span>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item mr-4">
              <a class="nav-link text-white font-weight-bold" href="#">Home</a>
            </li>
            <li class="nav-item mr-4">
              <a class="nav-link text-white" href="#service">Service</a>
            </li>
            <li class="nav-item mr-4">
              <a
                class="nav-link text-white"
                href="assets/Company Profile TBG.pdf"
                >Company Profile</a
              >
            </li>
            <li class="nav-item mr-4">
              <a class="nav-link text-white" href="#link">Kontak</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const navbarToggle = document.querySelector(".navbar-toggler");
        const navbar = document.querySelector(".navbar");

        navbarToggle.addEventListener("click", function () {
          navbar.classList.toggle(
            "active",
            navbarToggle.getAttribute("aria-expanded") === "false"
          );
        });
      });
    </script>

 <!-- Hero_Home -->
 <main class="hero" id="home">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-5">
        <div class="pt-5 hero-content">
          <h1>Kami Menawarkan Properti Berkualitas untuk Anda</h1>
          <p class="mt-3">
            Temukan hunian impian Anda atau investasi terbaik melalui
            layanan properti terpercaya kami.
          </p>
          <div class="hero-button mt-4">
            <a href="#display-property">Wujudkan Impian</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
    
    <!-- Service -->
     <section class="service" id="service">
  <div class="container">
    <div class="text-center">
      <h2>Kami Memberikan Layanan Properti Terbaik</h2>
      <p class="mt-2">
        Diskusikan dengan kami untuk menemukan properti impian Anda.
      </p>
    </div>
    <div class="row service-list-card">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card service-card">
          <div class="card-icon">
            <div class="circle" style="background-color: #5b72ee"></div>
            <iconify-icon
              icon="mdi:home-search-outline"
              id="iconify-icon-service-1"
              style="color: white; display: block"
              width="32"
            ></iconify-icon>
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Pencarian Properti</h5>
            <p class="card-text text-center mt-2">
              Membantu Anda menemukan rumah, apartemen, atau properti komersial yang sesuai dengan kebutuhan dan anggaran.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-md-4 mb-4">
        <div class="card service-card">
          <div class="card-icon">
            <div class="circle" style="background-color: #00cbb8"></div>
            <iconify-icon
              icon="mdi:handshake-outline"
              id="iconify-icon-service-2"
              style="color: white; display: block"
              width="32"
            ></iconify-icon>
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Konsultasi Properti</h5>
            <p class="card-text text-center mt-2">
              Memberikan layanan konsultasi profesional untuk membantu Anda membuat keputusan investasi properti yang tepat.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-md-4 mb-4">
        <div class="card service-card">
          <div class="card-icon">
            <div class="circle" style="background-color: #29b9e7"></div>
            <iconify-icon
              icon="mdi:finance"
              id="iconify-icon-service-3"
              style="color: white; display: block"
              width="32"
            ></iconify-icon>
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Pembiayaan Properti</h5>
            <p class="card-text text-center mt-2">
              Membantu Anda memahami dan mendapatkan opsi pembiayaan terbaik untuk pembelian properti Anda.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row flex justify-content-center mt-4">
      <!-- Card 4 -->
      <div class="col-md-4 mb-4">
        <div class="card service-card">
          <div class="card-icon">
            <div class="circle" style="background-color: #5b72ee"></div>
            <iconify-icon
              icon="mdi:map-marker-radius-outline"
              id="iconify-icon-service-4"
              style="color: white; display: block"
              width="32"
            ></iconify-icon>
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Penilaian Properti</h5>
            <p class="card-text text-center mt-2">
              Memberikan layanan evaluasi nilai properti untuk pembelian, penjualan, atau investasi Anda.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="col-md-4 mb-4">
        <div class="card service-card">
          <div class="card-icon">
            <div class="circle" style="background-color: #00cbb8"></div>
            <iconify-icon
              icon="mdi:camera-enhance-outline"
              id="iconify-icon-service-5"
              style="color: white; display: block"
              width="32"
            ></iconify-icon>
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Fotografi Properti</h5>
            <p class="card-text text-center mt-2">
              Menyediakan foto dan video profesional untuk mempromosikan properti Anda dengan cara terbaik.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Display Properti -->
<section class="display-property" id="display-property">
  <div class="container">
    <div class="text-center mb-5">
      <h2>Temukan Properti Terbaik Kami</h2>
      <p class="mt-2">Lihat koleksi properti pilihan kami untuk kebutuhan Anda.</p>
    </div>
    <div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <!-- Card 1 -->
      <div class="col-md-4 mb-4">
        <div class="card property-card">
        <img src="../../admin/Dashboard_Admin/uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"
        class="card-img-top" style="">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text"><?php echo number_format($row['price'], 2); ?></p>
            <p class="card-location"><i class="fas fa-map-marker-alt"></i><?php echo $row['location']; ?></p>
            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-block">Lihat Detail</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<!-- Display Properti -->

    <script>
      function updateIconSizeMain() {
        const width = window.innerWidth || document.documentElement.clientWidth;
        const iconA1 = document.getElementById("iconify-icon-about-1");
        const iconA2 = document.getElementById("iconify-icon-about-2");
        const iconS1 = document.getElementById("iconify-icon-service-1");
        const iconS2 = document.getElementById("iconify-icon-service-2");
        const iconS3 = document.getElementById("iconify-icon-service-3");
        const iconS4 = document.getElementById("iconify-icon-service-4");
        const iconS5 = document.getElementById("iconify-icon-service-5");

        if (width <= 576) {
          iconA1.style.display = "block";
          iconA2.style.display = "block";
          iconA1.setAttribute("width", "26");
          iconA2.setAttribute("width", "26");

          iconS1.style.display = "block";
          iconS1.setAttribute("width", "26");
          iconS2.style.display = "block";
          iconS2.setAttribute("width", "26");
          iconS3.style.display = "block";
          iconS3.setAttribute("width", "26");
          iconS4.style.display = "block";
          iconS4.setAttribute("width", "26");
          iconS5.style.display = "block";
          iconS5.setAttribute("width", "26");
        } else if (width <= 768) {
          iconA1.style.display = "block";
          iconA1.setAttribute("width", "24");
          iconA2.style.display = "block";
          iconA2.setAttribute("width", "24");

          iconS1.style.display = "block";
          iconS1.setAttribute("width", "32");
          iconS2.style.display = "block";
          iconS2.setAttribute("width", "32");
          iconS3.style.display = "block";
          iconS3.setAttribute("width", "32");
          iconS4.style.display = "block";
          iconS4.setAttribute("width", "32");
          iconS5.style.display = "block";
          iconS5.setAttribute("width", "32");
        } else {
          iconA1.style.display = "block";
          iconA2.style.display = "block";
          iconA1.setAttribute("width", "36");
          iconA2.setAttribute("width", "36");

          iconS1.style.display = "block";
          iconS1.setAttribute("width", "28");
          iconS2.style.display = "block";
          iconS2.setAttribute("width", "28");
          iconS3.style.display = "block";
          iconS3.setAttribute("width", "28");
          iconS4.style.display = "block";
          iconS4.setAttribute("width", "28");
          iconS5.style.display = "block";
          iconS5.setAttribute("width", "28");
        }
      }
      window.addEventListener("DOMContentLoaded", updateIconSizeMain);
      window.addEventListener("resize", updateIconSizeMain);
    </script>

    <!-- Banner -->
    <section class="banner">
      <div class="banner-header">
        <div class="banner-header-inner flexx">
          <h3 class="text-center">
            Bergabung Bersama Kami untuk Mewujudkan Impian Anda dan Temukan Properti Terbaik yang Sesuai dengan Kebutuhan Anda.
          </h3>
          <div class="banner-button" onclick="bannerButton()">
            <a href="/karya">Lihat Proyek Kami</a>
          </div>
        </div>
        <div>
          <svg
            class="waves"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28"
            preserveAspectRatio="none"
            shape-rendering="auto"
          >
            <defs>
              <path
                id="gentle-wave"
                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
              ></path>
            </defs>
            <g class="parallax">
              <use
                xlink:href="#gentle-wave"
                x="48"
                y="0"
                fill="rgba(255,255,255,0.7)"
              ></use>
              <use
                xlink:href="#gent  le-wave"
                x="48"
                y="3"
                fill="rgba(255,255,255,0.5)"
              ></use>
              <use
                xlink:href="#gentle-wave"
                x="48"
                y="5"
                fill="rgba(255,255,255,0.3)"
              ></use>
              <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff"></use>
            </g>
          </svg>
        </div>
      </div>
    </section>

    <script>
      function bannerButton() {
        window.location.href = "./karya.html";
      }
    </script>
    
<!-- Footer -->
    <section class="contact w-100" id="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-lg-4 col-md-5 col-sm-6 col-5">
                <img
                  src="./assets/img/logo.ico"
                  alt="ZanProject Contact"
                  class="img-fluid"
                />
              </div>
              <div
                id="contact-address"
                class="col-lg-8 col-md-7 col-sm-6 col-7"
              >
                <p>PT.Tiro Gemilang Bersama</p>
                <p>
                  Jl. H. Sayan No. 60 C, Pabuaran Mekar Kec. Cibinong, Kab.
                  Bogor, Jawa Barat
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-md-0 mt-4">
            <div class="row d-md-flex justify-content-between">
              <div id="contact-product" class="col-xl-6 col-md-6 col-5">
                <h5 class="fw-bold">Layanan Kami</h5>
                <p>Proyek Properti Terpercaya</p>
                <p><a href="/#service">Layanan Properti ZanProject</a></p>
                <p><a href="/">Akademi Properti</a></p>
              </div>
              <div id="link" class="col-xl-6 col-md-6 col-sm-6 col-7">
                <h5 class="fw-bold">Info Kontak</h5>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-2">
                    <iconify-icon
                      icon="ic:outline-email"
                      id="icon-1"
                      width="24"
                      style="display: block"
                    ></iconify-icon>
                  </div>
                  <div
                    class="contact-small d-flex justify-content-start align-items-center col-lg-10 col-md-9 col-10"
                  >
                    <p>tirogemilangbersama@gmail.com</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-2 col-md-3 col-2">
                    <iconify-icon
                      icon="ic:outline-whatsapp"
                      id="icon-2"
                      width="24"
                      style="display: block"
                    ></iconify-icon>
                  </div>
                  <div class="contact-small col-xl-10 col-md-9 col-10">
                    <p>
                      <a
                        href="https://wa.me/6282224142936?text=Halo%20kak,%20permisi,%20Saya%20mau%20konsultasi%20terkait%20jasa%20dari%2020ini"
                        target="_blank"
                      >
                        +62 822-2414-2936
                      </a>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-2 col-md-3 col-2">
                    <iconify-icon
                      icon="ri:instagram-line"
                      id="icon-3"
                      width="24"
                      style="display: block"
                    ></iconify-icon>
                  </div>
                  <div
                    id="smalltwoq"
                    class="contact-small col-xl-10 col-md-9 col-10"
                  >
                    <p>
                      <a
                        href="https://www.instagram.com/zan_project.id/"
                        target="_blank"
                      >
                        @zanproject.id
                      </a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row">
          <div id="footer-copyright" class="col-md-6 d-flex align-items-center">
            <p class="text-center">
              Copyright 2024 PT. Tiro Gemilang Bersama, All Right Reserved
            </p>
          </div>
          <div
            id="footer-desc"
            class="col-md-6 footer-desc d-flex justify-content-between align-items-center"
          >
            <p id="left"><a href="privacy.html">Privacy Policy</a></p>
            <p id="right">Terms &amp; Conditions</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
