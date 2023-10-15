<?php

require '../php/functions.php';

session_start();
$id_user = $_SESSION['id_user'];

if (isset($_POST['update_profile'])) {

   if (profile($_POST) > 0) {
      echo "
         <script>
            alert('data berhasil diubah!!');
            document.location.href = 'profile.php'
         </script>
        ";
   } else {
      echo "
         <script>
            alert('data gagal diubah!!');
            document.location.href = 'profile.php'
         </script>
        ";
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ubah Profil</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../asset/css/style.css">

   <link rel="stylesheet" href="../asset/css/style2.css">
</head>

<body>

   <div class="update-profile">

      <?php
      $select = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$id_user'") or die('query failed');
      if (mysqli_num_rows($select) > 0) {
         $fetch = mysqli_fetch_assoc($select);
      }
      ?>

<form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="id_user" value="<?= $fetch['id'] ?>">
         <input type="hidden" name="gambar_user" value="<?= $fetch["gambar_user"]; ?>">
         <?php
         if ($fetch['gambar_user'] == '') {
            echo '<img src="../asset/img/default-avatar.png">';
         } else {
            echo '<img src="../asset/uploaded-img/' . $fetch['gambar_user'] . '">';
         }
         if (isset($message)) {
            foreach ($message as $msg) {
               echo '<div class="message">' . $msg . '</div>';
            }
         }
         ?>
         <div class="flex">
            <div class="inputBox">
               <span>Username:</span>
               <input type="text" name="update_name" value="<?php echo $fetch['nama_user']; ?>" class="box">
               <span>Your Email:</span>
               <input type="email" name="update_email" value="<?php echo $fetch['email_user']; ?>" class="box">
               <span>Mobile Phone:</span>
               <input type="number" name="update_phone" value="<?php echo $fetch['nomor_user']; ?>" class="box">
               <span>Alamat:</span>
               <textarea name="update_alamat" id="alamat" class="box"><?= $fetch['alamat_user'] ?></textarea>
            </div>
            <div class="inputBox">
               <span>Provinsi:</span>
               <input type="text" name="update_provinsi" value="<?php echo $fetch['provinsi']; ?>" class="box">
               <span>Kota:</span>
               <input type="text" name="update_kota" value="<?php echo $fetch['kota_user']; ?>" class="box">
               <span>Postcode:</span>
               <input type="number" name="update_postcode" value="<?php echo $fetch['postcode_user']; ?>" class="box">
            </div>
         </div>
         <input type="submit" value="Update Profile" name="update_profile" class="btn" onclick="return confirm('Ubah profil?');">
         <a href="user.php" class="delete-btn">Go Back</a>
      </form>

   </div>

</body>
<script src="../asset/js/script3.js"></script>

</html>