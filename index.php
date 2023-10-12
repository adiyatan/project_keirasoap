<?php
require 'php/functions.php';

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
  if ($_SESSION['user'] = true) {
    header("Location: user/user.php");
  }
}

if (isset($_SESSION['login'])) {
  if ($_SESSION['admin'] = true) {
    header("Location: admin/admin.php");
  }
}

$listsabun = query("SELECT * FROM data_sabun");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Keira Luxury Soap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/css/style3.css">
</head>

<body>
  <!-- Header Section -->
  <header class="header">
    <div class="container">
      <h1 class="logo">Keira Luxury Soap</h1>
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

  <!-- Footer Section -->
  <footer class="mt-auto text-dark-50 text-center">
    <p>COPYRIGHT &copy; 2023 <a href="https://keirasoap.site/" class="text-dark">Keira Luxury Soap</a> ALL RIGHTS
      RESERVED.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>