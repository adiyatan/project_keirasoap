<?php
session_start();

require '../php/functions.php';
$listsabun = query("SELECT * FROM data_sabun");

$id_user = $_SESSION['id_user'];
$select = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$id_user'") or die('query failed');
if (mysqli_num_rows($select) > 0) {
  $user = mysqli_fetch_assoc($select);
}
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['role'] == "") {
  header("location:../login.php?pesan=gagal");
}

// Add these lines at the beginning of your PHP code to handle sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'nama_sabun';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

$orderBy = $sort . ' ' . $order;
$listsabun = query("SELECT * FROM data_sabun ORDER BY $orderBy");



if (isset($_POST['add_to_cart'])) {
  $product_gambar = $_POST['product_gambar'];
  $product_nama = $_POST['product_nama'];
  $product_bahan = $_POST['product_bahan'];
  $product_kegunaan = $_POST['product_kegunaan'];
  $product_harga = $_POST['product_harga'];
  $product_quantity = 1;

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE nama_sabun_cart = '$product_nama'") or die(mysqli_error($conn));


  $insert_product = mysqli_query($conn, "INSERT INTO `cart`(id_cart,id_user, nama_sabun_cart, bahan_sabun_cart, kegunaan_sabun_cart, harga_sabun_cart, gambar_sabun_cart, quantity) VALUES(NULL, '$id_user','$product_nama', '$product_bahan', '$product_kegunaan', '$product_harga', '$product_gambar', '$product_quantity')") or die(mysqli_error($conn));
  $message[] = 'product added to cart succesfully';
}

$select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = $id_user") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Halaman User</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <style>
    .header {
      background: #00a4a9;
      color: #fff;
      text-align: center;
    }

    .navbar {
      background: #00a4a9;
    }

    .container-xl {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }

    .table {
      background-color: #fff;
    }

    .table th {
      background-color: #00a4a9;
      color: #fff;
    }

    .fas{
      color: #fff;
    }

    .product-image {
      max-width: 80px;
      max-height: 80px;
    }

    .custom-button {
      color: black;
      background-color: #0DCAF0;
    }

    .custom-button:hover {
      background-color: #007982;
    }

    .footer {
      background: #00a4a9;
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    .loader {
      width: 100px;
      position: absolute;
      top: 1px;
      left: 285px;
      z-index: -1;
      display: none;
    }

    .foto {
      width: auto;
      height: 50px;
    }

    .navbar-white-text .navbar-nav .nav-link {
      color: white;
    }

    body {
      background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark navbar-white-text">
    <div class="container">
      <a href="/" class="navbar-brand">Keira Soap Factory</a>
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

  <div class="container-xl mt-3">
    <div class="container">
      <div class="col-12 col-lg-auto mt-3 mb-lg-0">
        <p>Halo <b><?= $user['nama_user']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['role']; ?></b>.</p>
        <p style="font-style: italic;">Selamat Berbelanja :)</p>
        <p>Untuk konsultasi hubungi <span><a href="https://wa.me/6282115914639/?text=Halo!%0ASaya%20ingin%20konsultasi%20sabun" target="_blank">Admin</a></span></p>
        <?php

        if (isset($message)) {
          foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
          };
        };

        ?>
      </div>
      <div class="text-end mt-2">
        <a href="../php/logout.php" class="btn btn-success">Logout</a>
      </div>
    </div>
  </div>
  <div class="container-xl mt-3">
    <h1>Daftar Sabun Kesehatan</h1>
    <p>Oleh Keira Soap Factory</p>
    <!-- Your table code here -->
    <div class="row">
      <div class="col-md-3">
        <h4></h4>
        <div class="col-md">
          <form action="" method="post">
            <img src="../asset/img/loader.gif" class="loader">
            <div class="input-group">
              <input type="text" name="keyword" class="form-control" placeholder="Masukkan kata kunci" autocomplete="off" id="keyword">
              <div class="input-group-append">
                <button type="submit" name="cari" class="btn btn-secondary p-3" id="tombol-cari">Cari</button>
              </div>
              <img src="../asset/img/loader.gif" class="loader">
            </div>
          </form>
        </div>
      </div>
      <div id="tabel-sabun">
        <table class="table table-bordered table-hover table-secondary mt-4" id="daftarsabun">
          <thead class="thead-dark text-center table-dark table-striped">
            <tr>
              <th>No.</th>
              <th>Gambar</th>
              <th>Nama Sabun
                <?php if ($sort === 'nama_sabun' && $order === 'asc') : ?>
                  <a href="?sort=nama_sabun&order=desc"><i class="fas fa-sort-down"></i></a>
                <?php else : ?>
                  <a href="?sort=nama_sabun&order=asc"><i class="fas fa-sort-up"></i></a>
                <?php endif; ?>
              </th>
              <th>Bahan Sabun
                <?php if ($sort === 'bahan_sabun' && $order === 'asc') : ?>
                  <a href="?sort=bahan_sabun&order=desc"><i class="fas fa-sort-down"></i></a>
                <?php else : ?>
                  <a href="?sort=bahan_sabun&order=asc"><i class="fas fa-sort-up"></i></a>
                <?php endif; ?>
              </th>
              <th>Kegunaan Sabun
                <?php if ($sort === 'kegunaan_sabun' && $order === 'asc') : ?>
                  <a href="?sort=kegunaan_sabun&order=desc"><i class="fas fa-sort-down"></i></a>
                <?php else : ?>
                  <a href="?sort=kegunaan_sabun&order=asc"><i class="fas fa-sort-up"></i></a>
                <?php endif; ?>
              </th>
              <th style="width: 100px;">Harga
                <?php if ($sort === 'harga_sabun' && $order === 'asc') : ?>
                  <a href="?sort=harga_sabun&order=desc"><i class="fas fa-sort-down"></i></a>
                <?php else : ?>
                  <a href="?sort=harga_sabun&order=asc"><i class="fas fa-sort-up"></i></a>
                <?php endif; ?>
              </th>
              <th>Action</th>
            </tr>
          </thead>

          <?php $i = 1; ?>
          <?php foreach ($listsabun as $row) : ?>
            <tr class="text-center">
              <td><?= $i; ?></td>
              <td><img src="../asset/uploaded-img/<?= $row["gambar_sabun"]; ?>" class="rounded foto" width="auto" height="50px"></td>
              <td><?= $row["nama_sabun"]; ?></td>
              <td><?= $row["bahan_sabun"]; ?></td>
              <td><?= $row["kegunaan_sabun"]; ?></td>
              <td><?= $row["harga_sabun"]; ?></td>
              <td>
                <a href="detail.php?gambar=<?= $row["gambar_sabun"] ?>&product_nama=<?= $row["nama_sabun"]  ?>&product_bahan=<?= $row["bahan_sabun"] ?>&product_kegunaan=<?= $row["kegunaan_sabun"]  ?>&product_harga=<?= $row["harga_sabun"] ?>" class="btn btn-sm text-white bg-danger">Detail</a>
                <br>
                <br>
                <form method="post">
                  <input type="hidden" name="product_gambar" value="../asset/uploaded-img/<?= $row["gambar_sabun"]; ?>">
                  <input type="hidden" name="product_nama" value="<?= $row["nama_sabun"]; ?>">
                  <input type="hidden" name="product_bahan" value="<?= $row["bahan_sabun"]; ?>">
                  <input type="hidden" name="product_kegunaan" value="<?= $row["kegunaan_sabun"]; ?>">
                  <input type="hidden" name="product_harga" value="<?= $row["harga_sabun"]; ?>">
                  <input type="submit" class="btn btn-sm bg-warning" value="Add to Cart" onclick="return confirm('Tambah ke keranjang?')" name="add_to_cart">
                </form>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <p>&copy; 2023 Keira Soap Factory</p>
    </div>
  </footer>
</body>
<!-- Assign PHP id_user value to a JavaScript variable -->
<script>
  var id_user = <?php echo $id_user; ?>;
</script>
<script src="../asset/js/jquery-3.6.0.min.js"></script>
<script src="../asset/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>