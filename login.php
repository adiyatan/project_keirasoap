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

?>
<!DOCTYPE html>
<html>

<head>
  <title>Login to Keira Health Portal</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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

    .tombol_login {
      background-color: #00a4a9;
      color: #fff;
      border: none;
      height: 50px;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
    }

    .tombol_login:hover {
      background-color: #007982;
    }
  </style>
</head>

<body>

  <div class="panel_login">
    <p class="tulisan_atas">Welcome to Keira Health Portal</p>

    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
      echo "<div class='alert'>Username and Password are incorrect.</div>";
    }
    ?>

    <form action="php/checkrole.php" method="post">
      <div class="form-floating mb-5">
        <input type="text" class="form-control fs-5" id="floatingInput" placeholder="Username" name="username" required autocomplete="off">
        <label for="floatingInput">Username:</label>
      </div>

      <div class="form-floating mb-5">
        <input type="password" class="form-control fs-5" id="floatingPassword" placeholder="Password" name="password" required autocomplete="off">
        <label for="floatingPassword">Password:</label>
      </div>

      <p style="margin-right: 120px; margin-top: 10px;"> Don't have an account? <a href="registrasi.php" style="color: #00a4a9; font-weight: bold;">Register</a>
      </p>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember" style="margin-right: 130px;">
          Remember me for 30 days
        </label>
      </div>
      <br>

      <input type="submit" class="tombol_login" name="login" value="Login">
      <br />
      <br />
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>