<?php

require '../php/functions.php';

session_start();
$id_user = $_SESSION['id_user'];

if (isset($_POST['update_update_btn'])) {
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id_cart = '$update_id'");
   if ($update_quantity_query) {
      echo "
         <script>
            alert('data berhasil diubah!!');
            document.location.href = 'cart.php'
         </script>
        ";
   };
};

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id_cart = '$remove_id'");
   echo "
         <script>
            alert('data berhasil dihapus!!');
            document.location.href = 'cart.php'
         </script>
        ";
};

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart` WHERE id_user = '$id_user'");
   echo "
         <script>
            alert('semua data berhasil diubah!!');
            document.location.href = 'cart.php'
         </script>
        ";
}

$select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = $id_user") or die('query failed');
$row_count = mysqli_num_rows($select_rows);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Keranjang</title>

   <!-- font awesome cdn link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      /* Reset some default styles */
      body,
      h1,
      h2,
      h3,
      p,
      ul,
      li {
         margin: 0;
         padding: 0;
      }

      body {
         background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
         font-family: 'Arial', sans-serif;
         height: 100vh;
      }

      .container {
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
      }

      .navbar {
         background: #00a4a9;
         padding: 5px 20px;
      }

      /* Cart Styles */
      .shopping-cart {
         background-color: #fff;
         padding: 20px;
         border-radius: 10px;
         margin-top: 20px;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }

      table,
      th,
      td {
         border: 1px solid #ccc;
         text-align: center;
      }

      th,
      td {
         padding: 10px;
      }

      th {
         background-color: #1ABC9C;
         color: #fff;
      }

      tbody tr:nth-child(even) {
         background-color: #f8f8f8;
      }

      .table-bottom td {
         text-align: right;
         font-weight: bold;
      }

      .option-btn {
         text-decoration: none;
         background-color: #1ABC9C;
         color: #fff;
         padding: 8px 16px;
         border-radius: 5px;
         transition: background-color 0.3s;
      }

      .option-btn:hover {
         background-color: #17A894;
      }

      .checkout-btn {
         text-align: right;
         margin-top: 20px;
      }

      .btn {
         background-color: #1ABC9C;
         color: #fff;
         padding: 12px 20px;
         border: none;
         border-radius: 5px;
         font-weight: bold;
         text-decoration: none;
         cursor: pointer;
      }

      .btn.disabled {
         background-color: #ccc;
         cursor: not-allowed;
      }

      /* Footer Styles */
      footer {
         background-color: #1ABC9C;
         color: #fff;
         padding: 1rem 0;
         text-align: center;
      }
   </style>

</head>

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

   <div class="container">
      <section class="shopping-cart">
         <h1 class="heading">Keranjang</h1>
         <table>
            <thead>
               <th>Gambar</th>
               <th>Nama</th>
               <th>Harga</th>
               <th>Jumlah Item</th>
               <th>total Harga</th>
               <th>Aksi</th>
            </thead>
            <tbody>
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user= '$id_user'");
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
               ?>
                     <tr>
                        <td><img src="<?php echo $fetch_cart['gambar_sabun_cart']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['nama_sabun_cart']; ?></td>
                        <td>Rp.<?php echo number_format($fetch_cart['harga_sabun_cart']); ?>/-</td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id_cart']; ?>">
                              <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                              <input type="submit" value="Perbarui" name="update_update_btn">
                           </form>
                        </td>
                        <?php $sub_total = $fetch_cart['harga_sabun_cart'] * $fetch_cart['quantity']; ?>
                        <td>Rp.<?php echo number_format($sub_total); ?>/-</td>
                        <td><a href="cart.php?remove=<?php echo $fetch_cart['id_cart']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Hapus</a></td>
                     </tr>
               <?php
                     $grand_total += $sub_total;
                  };
               };
               ?>
               <td colspan="3">Total Harga</td>
               <td>Rp.<?php echo $grand_total; ?>/-</td>
               <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Hapus Semua </a></td>
               </tr>

            </tbody>

         </table>

         <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proses checkout</a>
         </div>

      </section>

   </div>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>