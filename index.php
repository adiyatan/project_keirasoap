<?php
require 'php/functions.php';
session_start();

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  //ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id ='$id'");
  $rows = mysqli_fetch_assoc($result);

  //cek cookie dan id
  if ($key === hash('sha256', $rows['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION['login'])) {
  if ($_SESSION['user'] == true) {
    header("Location: user/user.php");
    exit();
  } elseif ($_SESSION['admin'] == true) {
    header("Location: admin/admin.php");
    exit();
  }
}

$listsabun = query("SELECT * FROM data_sabun");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Adiyatan Luxury Soap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/css/style3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
    }

    .header {
      background: #00a4a9;
      color: #fff;
    }

    .navbar .nav-link {
      color: #fff;
    }

    .navbar .nav-link:hover {
      color: #fff;
    }

    .container-xl {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .heading {
      color: #00a4a9;
    }

    .sub-heading {
      color: #00a4a9;
    }

    .table-bordered,
    .table-hover,
    .table-secondary {
      background-color: #fff;
    }

    .product-image {
      max-width: 100px;
      max-height: 100px;
    }

    .custom-button {
      color: black;
      background-color: #0DCAF0;
    }

    .custom-button:hover {
      background-color: #007982;
    }

    .gallery {
      background-color: #fff;
    }

    .gallery a img {
      border: 4px solid #fff;
    }

    .text-dark-50 {
      color: #555 !important;
    }

    .footer {
      background: #00a4a9;
      color: #fff;
    }

    .scroll-to-top {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      background: #00a4a9;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 50%;
      padding: 15px;
    }

    .scroll-to-top:hover {
      background: #007982;
    }
  </style>
</head>

<body>
  <!-- Header Section -->
  <header class="header">
    <div class="container">
      <h1 class="logo">Adiyatan Luxury Soap</h1>
      <nav class="navbar">
        <a class="nav-link" href="#scrollspyHeading1">Products</a>
        <a class="nav-link" href="#scrollspyHeading2">Testimonials</a>
        <a class="nav-link" href="login.php">Login</a>
        <a class="nav-link" href="registrasi.php">Register</a>
      </nav>
    </div>
  </header>

  <!-- Main Content Section -->
  <div class="container-xl mt-5">
    <h2 id="scrollspyHeading1" class="heading">Luxurious Soap Collection</h2>
    <p class="sub-heading">Crafted for Your Health and Well-being</p>

    <div class="row">
      <!-- Product Listing -->
      <div id="tabel-sabun">
        <table class="table table-bordered table-hover table-secondary mt-4">
          <tr class="thead-dark text-center">
            <th>No.</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Ingredients</th>
            <th>Benefits</th>
            <th>Price</th>
            <th>Action</th>
          </tr>

          <?php $i = 1; ?>
          <?php foreach ($listsabun as $row) : ?>
            <tr class="text-center">
              <td><?= $i; ?></td>
              <td><img src="asset/uploaded-img/<?= $row["gambar_sabun"]; ?>" class="product-image" alt="<?= $row["nama_sabun"]; ?>"></td>
              <td><?= $row["nama_sabun"]; ?></td>
              <td><?= $row["bahan_sabun"]; ?></td>
              <td><?= $row["kegunaan_sabun"]; ?></td>
              <td><?= $row["harga_sabun"]; ?></td>
              <td>
                <a href="login.php" class="btn custom-button">Details</a>
                <br>
                <br>
                <a href="login.php" class="btn custom-button">Add to Cart</a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
        </table>
      </div>
    </div>

    <h2 id="scrollspyHeading2" class="heading">Customer Testimonials</h2>

    <div class="gallery" id="animated-thumbnails-gallery">
      <a href="asset/img/testi1.jpeg">
        <img src="asset/img/testi1.jpeg" alt="Testimonial 1">
      </a>
      <a href="asset/img/testi2.jpeg">
        <img src="asset/img/testi2.jpeg" alt="Testimonial 2">
      </a>
      <a href="asset/img/testi3.jpeg">
        <img src="asset/img/testi3.jpeg" alt="Testimonial 3">
      </a>
      <a href="asset/img/testi4.jpeg">
        <img src="asset/img/testi4.jpeg" alt="Testimonial 4">
      </a>
    </div>
  </div>

  <button class="scroll-to-top" id="scrollToTopBtn" title="Go to top">
    <i class="fa fa-arrow-up"></i>
  </button>

  <!-- Footer Section -->
  <footer class="footer mt-auto text-dark-50 text-center">
    <p>COPYRIGHT &copy; 2023 <a href="https://Adiyatansoap.site/" class="text-dark">Adiyatan Luxury Soap</a> ALL RIGHTS
      RESERVED.</p>
  </footer>

  <script>
    // Function to show the scroll-to-top button when scrolling down
    window.onscroll = function() {
      scrollFunction();
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("scrollToTopBtn").style.display = "block";
      } else {
        document.getElementById("scrollToTopBtn").style.display = "none";
      }
    }

    // Function to smoothly scroll to the top when the button is clicked
    document.getElementById("scrollToTopBtn").onclick = function() {
      scrollToTop();
    };

    function scrollToTop() {
      const duration = 500; // Scroll duration in milliseconds
      const start = window.pageYOffset;
      const startTime = performance.now();

      function scroll(time) {
        const elapsed = time - startTime;
        const progress = Math.min(elapsed / duration, 1);
        window.scrollTo(0, start - start * progress);

        if (progress < 1) {
          requestAnimationFrame(scroll);
        }
      }

      requestAnimationFrame(scroll);
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>