<?php
require_once __DIR__ . '/vendor/autoload.php';
require '../functions.php';

$id = $_GET['id'];
$order = mysqli_query($conn, "SELECT * FROM `order` WHERE id = '$id'") or die('query failed');
if (mysqli_num_rows($order) > 0) {
    $fetch = mysqli_fetch_assoc($order);
}

$mpdf = new \Mpdf\Mpdf();

$order = '
<!DOCTYPE html>
<html>
<head>
    <title>Halaman order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .container {
        margin: 20px;
    }
    .text-center {
        text-align: center;
    }
    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    .table th,
    .table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }
    .table thead {
        background-color: #f0f0f0;
    }
</style>
<body>
<div class="container">
    <h1 class="text-center">Bukti Pembayaran</h1>
    <p class="text-center">' . $fetch['waktupesan'] . '</p>
    <p>Nama Penerima: ' . $fetch['nama_user'] . '</p>
    <p>Nomor Penerima: ' . $fetch['nomor_user'] . '</p>
    <p>Methode Pembayaran: ' . $fetch['method'] . '</p>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Total Product</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>' . $fetch["id"] . '</td>
                <td>' . $fetch["total_produk"] . '</td>
                <td>' . $fetch["total_harga"] . '</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <p>Alamat Pengirim:</p>
    <p>Jalan Dago, Bandung, Jawa Barat</p>
    <p>Alamat Penerima:</p>
    <p>' . $fetch["alamat_user"] . ', ' . $fetch["kota_user"] . ', ' . $fetch["provinsi"] . ', ' . $fetch["postcode_user"] . '</p>
</div>
</body>
</html>
';

$mpdf->WriteHTML("$order");
$mpdf->Output("Bukti Pembayaran", "I");
