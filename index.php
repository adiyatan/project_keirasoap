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
  <title>Keira Soap Factory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.es5.min.js" integrity="sha512-ssPi1cTYTwYV0e6IRdIId4ytENOrTDvixXo8l0DaTBAwYw9yD6rk9HU06pWRCoSWSRKwrucdVS/2fMC1getgcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="asset/css/style.css">


  <style>
    .loading {
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

    .gallery {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      width: 90%;
      margin: 0 auto;
    }

    .gallery a {
      height: 200px;
      width: 300px;
      margin: 20px;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 3px 5px black;
    }

    .gallery a img {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }

    .gallery a img:hover {
      transform: scale(0.9);
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
  };

  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container">
      <a class="navbar-brand fs-2" href="#">Keira Soap Factory</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading1" style="color: black; background-color: #0DCAF0;">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading2" style="color: black; background-color: #0DCAF0;">Testimoni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php" style="color: black;">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registrasi.php" style="color: black;">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tentangkami.php" style="color: black;" target="_blank">Tentang Kami</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div data-bs-spy="scroll" data-bs-target="#navbarNav" data-bs-offset="0" class="scrollspy-example">
    <div class="container-xl mt-5">
      <h4 id="scrollspyHeading1" class="text-center fs-2">Daftar Produk</h4>
      <p class="text-center fs-4">Oleh Keira Soap Factory</p>
      <div class="row">
        <div id="tabel-sabun">
          <table class="table table-bordered table-hover table-secondary mt-4">
            <thead class="thead-dark text-center">
              <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama Sabun</th>
                <th>Bahan Sabun</th>
                <th>Kegunaan Sabun</th>
                <th>Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($listsabun as $row) : ?>
                <tr class="text-center">
                  <td><?= $i; ?></td>
                  <td>
                    <img src="asset/uploaded-img/<?= $row["gambar_sabun"]; ?>" class="rounded foto" width="auto" height="50px">
                  </td>
                  <td><?= $row["nama_sabun"]; ?></td>
                  <td><?= $row["bahan_sabun"]; ?></td>
                  <td><?= $row["kegunaan_sabun"]; ?></td>
                  <td><?= $row["harga_sabun"]; ?></td>
                  <td>
                    <a href="login.php" class="btn btn-sm text-black bg-info">Detail</a>
                    <a href="login.php" class="btn btn-sm text-black bg-info">Tambah ke keranjang</a>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <h4 id="scrollspyHeading2" class="text-center fs-2">Testimoni</h4>
      <div class="gallery" id="animated-thumbnails">
        <a href="asset/img/testi1.jpeg">
          <img src="asset/img/testi1.jpeg" />
        </a>
        <a href="asset/img/testi2.jpeg">
          <img src="asset/img/testi2.jpeg" />
        </a>
        <a href="asset/img/testi3.jpeg">
          <img src="asset/img/testi3.jpeg" />
        </a>
        <a href="asset/img/testi4.jpeg">
          <img src="asset/img/testi4.jpeg" />
        </a>
      </div>
    </div>
    <footer class="mt-auto text-dark-50 text-center">
      <p>COPYRIGHT &copy; 2022 <a href="https://keirasoap.site/" class="text-dark">Keira Soap Factory</a> ALL RIGHTS RESERVED.</p>
    </footer>
  </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.min.js" integrity="sha512-+cRLP8t0rsqPalRf//6kfVwRVPzxvwtgLOm8XoSw+M/ND6/0aODP3WFs8m4EPtqsJ9aurqbYq4q/0u8lRJSldA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
  lightGallery(document.getElementById('animated-thumbnails-gallery'), {
    thumbnail: true,
  });
</script>

</html>