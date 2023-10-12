<?php 

$conn = mysqli_connect("localhost", "root", "", "keirasoap") or die('Connections_failed');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start(); // Make sure you start the session.

$product_gambar = $_GET['gambar'];
$product_nama = $_GET['product_nama'];
$product_bahan = $_GET['product_bahan'];
$product_kegunaan = $_GET['product_kegunaan'];
$product_harga = $_GET['product_harga'];
$id_user = $_GET['id_user'];
$product_quantity = 1;

$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE nama_sabun_cart = '$product_nama'") or die(mysqli_error($conn));

$insert_product = mysqli_query($conn, "INSERT INTO `cart`(id_cart, id_user, nama_sabun_cart, bahan_sabun_cart, kegunaan_sabun_cart, harga_sabun_cart, gambar_sabun_cart, quantity) VALUES(NULL, '$id_user','$product_nama', '$product_bahan', '$product_kegunaan', '$product_harga', '$product_gambar', '$product_quantity')") or die(mysqli_error($conn));

header("location:user.php");

