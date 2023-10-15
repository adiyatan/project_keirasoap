<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Check Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
    }

    .container {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
    }

    .badge-primary {
      background-color: #00a4a9;
    }

    .btn-danger {
      background-color: #ff6347;
      border-color: #ff6347;
    }

    .btn-danger:hover {
      background-color: #ff3b20;
      border-color: #ff3b20;
    }

    .btn-warning {
      background-color: #ffc107;
      border-color: #ffc107;
    }

    .btn-warning:hover {
      background-color: #ffaf01;
      border-color: #ffaf01;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Check Pesanan</h2>
        <p class="lead">Kami akan memproses pesanan saat sudah +5 Jam dari pesanan di buat. Untuk membatalkan pesanan, silahkan hubungi <a href="https://wa.me/6282115914639/?text=Halo!%0ASaya%20ingin%20membatalkan%20pesanan%20Apakah%20Bisa" target="_blank">Admin</a>. Jika lebih dari ketentuan, pesanan tidak akan dibatalkan.</p>
      </div>
      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Deskripsi Pesanan</span>
            <span class="badge badge-primary rounded-pill">Info</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0"></h6>
                <small class="text-muted">Cek Barangmu</small>
              </div>
              <span class="text-muted">ID: <?= $_GET['id'] ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0">Total Barang</h6>
                <small class="text-muted"><?= $_GET['total_produk'] ?></small>
              </div>
              <span class="text-muted">*</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Total Harga</h6>
                <small>Rp.<?= $_GET['total_harga'] ?></small>
              </div>
              <span class="text-success">*</span>
            </li>
          </ul>
        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Data Penerima (data tidak akan berubah)</h4>
          <form class="needs-validation" novalidate>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Nama</label>
                <input type="text" class="form-control" id="firstName" placeholder="<?= $_GET['nama_user'] ?>" disabled>
              </div>
              <div class="col-sm-6">
                <label for="nomor_user" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_user" placeholder="<?= $_GET['nomor_user'] ?>" disabled>
              </div>
              <div class="col-12">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" placeholder="<?= $_GET['alamat_user'] ?>" disabled>
              </div>
              <div class="col-md-5">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control" id="kota" placeholder="<?= $_GET['kota_user'] ?>" disabled>
              </div>
              <div class="col-md-4">
                <label for="state" class="form-label">Provinsi</label>
                <input type="text" class="form-control" id="state" placeholder="<?= $_GET['provinsi'] ?>" disabled>
              </div>
              <div class="col-md-3">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="<?= $_GET['postcode_user'] ?>" disabled>
              </div>
            </div>
            <hr class="my-4">
            <h4 class="mb-3">Pembayaran</h4>
            <div class="my-3">
              <div class="form-check">
                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked disabled>
                <label class="form-check-label" for="credit">Cash On Delivery (COD)</label>
              </div>
            </div>
            <hr class="my-4">
            <a href="../php/print/cetak.php?id=<?= $_GET['id']; ?>" target="_blank" class="btn btn-danger btn-lg mt-2">Cetak</a>
            <a href="check.php" class="btn btn-warning btn-lg mt-2">Kembali</a>
          </form>
        </div>
      </div>
    </main>
    <footer class="my-5 pt-5 text-muted text-center text-small footer">
      <p class="mb-1">&copy; Adiyatan Soap Factory</p>
    </footer>
  </div>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="form-validation.js"></script>
</body>
</html>
