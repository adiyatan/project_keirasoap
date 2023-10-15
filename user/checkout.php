<?php

require '../php/functions.php';

session_start();
$id_user = $_SESSION['id_user'];

$select = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$id_user'") or die('query failed');

if (mysqli_num_rows($select) > 0) {
   $fetch = mysqli_fetch_assoc($select);
}
if (isset($_POST['order_btn'])) {

   $nama_user = $_POST['nama_user'];
   $nomor_user = $_POST['nomor_user'];
   $email_user = $_POST['email_user'];
   $method = $_POST['method'];
   $alamat_user = $_POST['alamat_user'];
   $provinsi = $_POST['provinsi_user'];
   $kota_user = $_POST['kota_user'];
   $postcode_user = $_POST['postcode_user'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user= '$id_user'");
   $price_total = 0;
   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $product_name[] = $product_item['nama_sabun_cart'] . ' (' . $product_item['quantity'] . ') ';
         $product_price = ($product_item['harga_sabun_cart'] * $product_item['quantity']);
         $tp = number_format($product_price);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(id, id_user, nama_user, nomor_user, email_user, method, alamat_user, provinsi, kota_user, postcode_user, total_produk, total_harga, status) VALUES(NULL,'$id_user','$nama_user','$nomor_user','$email_user','$method','$alamat_user','$provinsi','$kota_user', '$postcode_user','$total_product','$price_total', 'Penjual Memproses pesanan')") or die('query failed');

   if ($detail_query) {
      // Order is successful, set a success message
      mysqli_query($conn, "DELETE FROM `cart` WHERE id_user = '$id_user'");
      echo "<script>
      alert('Pesanan successful!');
      document.location.href = 'user.php'
            </script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <style>
      body {
         background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
      }

      .container {
         max-width: 800px;
         margin: 0 auto;
         padding: 20px;
      }

      .checkout-form {
         padding: 20px;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      }

      .inputBox {
         margin-bottom: 20px;
      }

      label {
         display: block;
         font-weight: bold;
      }

      input[type="text"],
      input[type="tel"],
      input[type="email"],
      select {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
         outline: none;
      }

      .btn {
         display: inline-block;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         font-size: 18px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .btn-primary {
         background-color: #007883;
         color: #fff;
      }

      .btn-primary:hover {
         background-color: #00a4a9;
      }

      .btn-secondary {
         background-color: #ccc;
         color: #333;
      }

      .btn-secondary:hover {
         background-color: #999;
      }

      /* Add these styles to your existing CSS */

      .cart-table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      .cart-table th,
      .cart-table td {
         padding: 10px;
         text-align: center;
         border: 1px solid #ccc;
      }

      .cart-table th {
         background-color: #007883;
         color: #fff;
      }

      .product-name {
         display: flex;
         align-items: center;
      }

      .product-image {
         margin-right: 10px;
         width: 50px;
         height: 50px;
         object-fit: cover;
      }

      .grand-total {
         font-weight: bold;
         text-align: right;
         margin-top: 10px;
         font-size: 18px;
      }
   </style>

</head>

<body>

   <div class="container">

      <section class="checkout-form">

         <h1 class="heading">Selesaikan Order</h1>

         <form action="" method="post">

            <div class="display-order">
               <h2>Your Cart</h2>
               <table class="cart-table">
                  <thead>
                     <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user='$id_user'");
                     $total = 0;
                     $grand_total = 0;
                     if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                           $total_price = $fetch_cart['harga_sabun_cart'] * $fetch_cart['quantity'];
                           $grand_total += $total_price; // Accumulate the total price of each item
                           $tp = number_format($total_price);
                     ?>
                           <tr>
                              <td class="product-name">
                                 <img src="<?= $fetch_cart['gambar_sabun_cart']; ?>" alt="<?= $fetch_cart['nama_sabun_cart']; ?>" class="product-image">
                                 <span><?= $fetch_cart['nama_sabun_cart']; ?></span>
                              </td>
                              <td><?= $fetch_cart['quantity']; ?></td>
                              <td>Rp.<?= $tp; ?>/-</td>
                           </tr>
                     <?php
                        }
                     } else {
                        echo "<tr><td colspan='4'>Your cart is empty!</td></tr>";
                     }
                     ?>
                  </tbody>
               </table>
               <p class="grand-total">Total Harga : Rp.<?= $grand_total; ?>/-</p>
            </div>

            <div class="alert alert-success" role="alert">
               Update <a href="profile.php">profile</a> agar tidak perlu mengisi alamat manual
            </div>


            <div class="inputBox">
               <label for="nama_user">Nama :</label>
               <input type="text" id="nama_user" value="<?= $fetch['nama_user']; ?>" name="nama_user" required>
            </div>
            <div class="inputBox">
               <label for="nomor_user">Nomor Telpon :</label>
               <input type="tel" id="nomor_user" value="<?= $fetch['nomor_user']; ?>" name="nomor_user" required>
            </div>
            <div class="inputBox">
               <label for="email_user">Email :</label>
               <input type="email" id="email_user" value="<?= $fetch['email_user']; ?>" name="email_user" required>
            </div>
            <div class="inputBox">
               <label for="method">Metode Pembayaran:</label>
               <select id="method" name="method">
                  <option value="cash on delivery" selected>Cash on Delivery</option>
               </select>
            </div>
            <div class="inputBox">
               <label for="alamat_user">Alamat Lengkap :</label>
               <input type="text" id="alamat_user" value="<?= $fetch['alamat_user']; ?>" name="alamat_user" required>
            </div>
            <div class="inputBox">
               <label for="provinsi_user">Provinsi :</label>
               <input type="text" id="provinsi_user" value="<?= $fetch['provinsi']; ?>" name="provinsi_user" required>
            </div>
            <div class="inputBox">
               <label for="kota_user">Kota :</label>
               <input type="text" id="kota_user" value="<?= $fetch['kota_user']; ?>" name="kota_user" required>
            </div>
            <div class="inputBox">
               <label for="postcode_user">Postcode :</label>
               <input type="text" id="postcode_user" value="<?= $fetch['postcode_user']; ?>" name="postcode_user" required>
            </div>
            <input type="submit" value="Pesan Sekarang" name="order_btn" class="btn btn-primary" onclick="return confirm('Buat Pesanan?');">
            <a href="cart.php" class="btn btn-secondary" onclick="return confirm('Batalkan checkout?');">Kembali</a>
         </form>
      </section>

   </div>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>