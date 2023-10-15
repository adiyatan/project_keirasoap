<?php
require '../php/functions.php';

session_start();
$id_user = $_SESSION['id_user'];

$order = mysqli_query($conn, "SELECT * FROM `order` WHERE id_user = '$id_user'") or die('query failed');
if (mysqli_num_rows($order) > 0) {
  $fetch = mysqli_fetch_assoc($order);
}

$id_user = $_SESSION['id_user'];
$select = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$id_user'") or die('query failed');
if (mysqli_num_rows($select) > 0) {
  $user = mysqli_fetch_assoc($select);
}

$select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = $id_user") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Riwayat Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <script src="../asset/js/jquery-3.6.0.min.js"></script>
</head>
<style>
  body {
    background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
  }

  .navbar {
    background: #00a4a9;
    padding: 25px 180px;
    color: #fff;
  }

  .foto {
    width: auto;
    height: 50px;
  }

  .loader {
    width: 100px;
    position: absolute;
    top: 1px;
    left: 285px;
    z-index: -1;
    display: none;
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

  .table th {
    background-color: #00a4a9;
    color: #fff;
  }

  .btn-print {
    background-color: #007883;
    color: #fff;
  }
</style>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-white-text">
    <div class="container">
      <a href="" class="navbar-brand">Adiyatan Soap Factory</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="user.php#daftarsabun">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              Keranjang
              <span class="badge bg-primary">
                <?php echo $row_count; ?>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="check.php">Riwayat Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Ubah Profil</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-xl mt-1 fs-10">
    <div class="row">
      <form action="" method="GET">
        <div class="row">
          <div class="col-md-4">
            <div class="input-group mb-3">
              <select class="form-control" name="sort">
                <option value="">--Sortir Berdasarkan Waktu--</option>
                <option value="a-z" <?php if (isset($_GET['sort']) && $_GET['sort'] == "a-z") {
                                      echo "Pilih";
                                    } ?>>Terlama</option>
                <option value="z-a" <?php if (isset($_GET['sort']) && $_GET['sort'] == "z-a") {
                                      echo "Pilih";
                                    } ?>>Terbaru</option>
              </select>
              <button type="submit" class="input-group-text btn btn-danger" id="tombol-sortir">Sortir</button>
            </div>
          </div>
        </div>
      </form>
      <div id="tabel-order">
        <table class="table table-bordered table-hover table-secondary mt-4">
          <tr class="thead-dark text-center table table-dark table-striped">
            <th>ID Pesanan</th>
            <th>Waktu Pemesanan</th>
            <th>Total Produk</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>

          <?php
          $sort = "";
          if (isset($_GET["sort"])) {
            if ($_GET["sort"] == "a-z") {
              $sort = "ASC";
            } else if ($_GET["sort"] == "z-a") {
              $sort = "DESC";
            }
          }
          $order = mysqli_query($conn, "SELECT * FROM `order` WHERE id_user = '$id_user' ORDER BY waktupesan $sort") or die('query failed');
          ?>

          <?php foreach ($order as $row) : ?>
            <tr class="thead-dark text-center">
              <td><?= $row["id"]; ?></td>
              <td><?= $row["waktupesan"]; ?></td>
              <td><?= $row["total_produk"]; ?></td>
              <td><?= $row["total_harga"]; ?></td>
              <td><?= $row["status"]; ?></td>
              <td>
                <a href="checkpesanan.php?id=<?= $row["id"] ?>&nama_user=<?= $row["nama_user"] ?>&nomor_user=<?= $row["nomor_user"] ?>&method=<?= $row["method"] ?>&alamat_user=<?= $row["alamat_user"] ?>&provinsi=<?= $row["provinsi"] ?>&kota_user=<?= $row["kota_user"] ?>&postcode_user=<?= $row["postcode_user"] ?>&total_produk=<?= $row["total_produk"] ?>&total_harga=<?= $row["total_harga"] ?>&waktupesan=<?= $row["waktupesan"] ?> " class="btn btn-print">Cetak</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
    <button class="scroll-to-top" id="scrollToTopBtn" title="Go to top">
      <i class="fa fa-arrow-up"></i>
    </button>
  </div>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>