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

if (isset($_POST['register'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
                alert('Berhasil mendaftar!');
                document.location.href = 'login.php'
              </script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>
<html>

<head>
  <title>Registrasi Keira Health Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      background: linear-gradient(to bottom, #7ad3a7, #00a4a9);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .panel_login {
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      background-color: #fff;
      width: 400px;
      text-align: center;
    }

    .alert {
      background-color: #f2dede;
      color: #a94442;
      border: 1px solid #a94442;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .tulisan_atas {
      font-size: 24px;
      font-weight: bold;
      color: #00a4a9;
      margin-bottom: 20px;
    }

    .form-control {
      background-color: #f2f2f2;
      border: none;
      height: 50px;
      border-radius: 5px;
    }

    .form-floating label {
      color: #00a4a9;
    }

    .form-check-label {
      color: #333;
    }

    .tombol_regis {
      background-color: #00a4a9;
      color: #fff;
      border: none;
      height: 50px;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
    }

    .tombol_regis:hover {
      background-color: #007982;
    }
  </style>
</head>

<body>
  <div class="panel_login">
    <p class="tulisan_atas fs-2">Silahkan Daftar</p>
    <form action="" method="post">
      <div class="form-floating mb-5">
        <input type="text" class="form-control fs-5" id="floatingInput" placeholder="Nama Lengkap" name="nama_user" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Nama Lengkap :</label>
      </div>

      <div class="form-floating mb-5">
        <input type="text" class="form-control fs-5" id="floatingInput" placeholder="Username" name="username" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Username :</label>
      </div>

      <div class="form-floating mb-5">
        <input type="email" class="form-control fs-5" id="floatingInput" placeholder="test@example.com" name="email" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Email :</label>
      </div>

      <div class="form-floating mb-5">
        <input type="password" class="form-control fs-5" id="floatingInput" placeholder="Password" name="password" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Password :</label>
      </div>

      <div class="form-floating mb-5">
        <input type="password" class="form-control fs-5" id="floatingInput" placeholder="Konfirmasi Password" name="password2" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Konfirmasi Password :</label>
      </div>

      <p style="margin-right: 180px; margin-top: -20px;">Have an account? <a href="login.php" style="color: #00a4a9; font-weight: bold;">Login</a>
      </p>

      <input type="submit" class="tombol_regis" value="Register" name="register" style="color: black; background-color: #0DCAF0;">
      <br />
      <br />
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>