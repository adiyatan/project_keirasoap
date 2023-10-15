<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Detail Sabun</title>
  <style>
    html,
    body {
      background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
      font-family: 'Arial', sans-serif;
      height: auto;
      color: white;
    }

    .product-image {
      width: 100%;
      max-width: 300px;
      height: auto;
      margin: 20px auto;
    }

    .product-details {
      text-align: left;
    }
  </style>
</head>

<body>
  <div class="container-xl">
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4"><?= $_GET['product_nama'] ?></h1>
      <p class="fs-5 .text-white">Harga: Rp.<?= $_GET['product_harga'] ?></p>
    </div>
    <img src="../asset/uploaded-img/<?= $_GET['gambar'] ?>" class="img-fluid rounded-start product-image" alt="<?= $_GET['product_nama'] ?>">
    <div class="product-details">
      <p class="fs-5 .text-white">Kegunaan: <?= $_GET['product_kegunaan'] ?></p>
      <p class="fs-5 .text-white">Bahan: <?= $_GET['product_bahan'] ?></p>
    </div>
    <a href="user.php" class="btn btn-danger">Kembali</a>
    <table class="table table-bordered table-hover table-secondary mt-4">
      <thead class="table-dark text-center">
        <tr>
          <th>Premium</th>
          <th>Anti Bahan Berbahaya</th>
          <th>Halal</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td>&#10004;</td>
          <td>&#10004;</td>
          <td>&#10004;</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>