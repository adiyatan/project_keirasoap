<?php
$conn = mysqli_connect("localhost", "root", "", "keirasoap") or die('Connections_failed');


function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function queryorder($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
	global $conn;
	//ambil data dari tiap elemen dalam form
	$nama_sabun = htmlspecialchars($data["nama_sabun"]);
	$bahan_sabun = htmlspecialchars($data["bahan_sabun"]);
	$kegunaan_sabun = htmlspecialchars($data["kegunaan_sabun"]);
	$harga_sabun = htmlspecialchars($data["harga_sabun"]);

	$gambar_sabun = upload();
	if (!$gambar_sabun) {
		return false;
	}

	//query insert data
	$query = "INSERT INTO data_sabun
				VALUES
				 ('', '$nama_sabun', '$bahan_sabun', '$kegunaan_sabun', '$harga_sabun', '$gambar_sabun')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus($id_sabun)
{
	global $conn;

	$sabun = query("SELECT * FROM data_sabun WHERE id_sabun = $id_sabun")[0];
	if ($sabun["gambar_sabun"] !== 'adiya.jpg') {
		unlink("../asset/uploaded-img/" . $sabun["gambar_sabun"]);
	}

	mysqli_query($conn, "DELETE FROM data_sabun WHERE id_sabun = $id_sabun");
	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;

	$id_sabun = $data["id_sabun"];
	$nama_sabun = htmlspecialchars($data["nama_sabun"]);
	$bahan_sabun = htmlspecialchars($data["bahan_sabun"]);
	$kegunaan_sabun = htmlspecialchars($data["kegunaan_sabun"]);
	$harga_sabun = htmlspecialchars($data["harga_sabun"]);
	$gambar_sabun = htmlspecialchars($data["gambar_sabun"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar_sabun']['error'] === 4) {
		$gambar_soap = $gambar_sabun;
	} else {
		$gambar_soap = upload();
	}


	$query = "UPDATE data_sabun SET
				nama_sabun = '$nama_sabun',
				bahan_sabun = '$bahan_sabun',
				kegunaan_sabun = '$kegunaan_sabun',
				harga_sabun = '$harga_sabun',
				gambar_sabun = '$gambar_soap'
			  WHERE id_sabun = $id_sabun
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahorder($data)
{
	global $conn;

	$id_sabun = $data["id_sabun"];
	$nama_sabun = htmlspecialchars($data["nama_sabun"]);
	$bahan_sabun = htmlspecialchars($data["bahan_sabun"]);
	$kegunaan_sabun = htmlspecialchars($data["kegunaan_sabun"]);
	$harga_sabun = htmlspecialchars($data["harga_sabun"]);
	$gambar_sabun = htmlspecialchars($data["gambar_sabun"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar_sabun']['error'] === 4) {
		$gambar_soap = $gambar_sabun;
	} else {
		$gambar_soap = upload();
	}


	$query = "UPDATE data_sabun SET
				nama_sabun = '$nama_sabun',
				bahan_sabun = '$bahan_sabun',
				kegunaan_sabun = '$kegunaan_sabun',
				harga_sabun = '$harga_sabun',
				gambar_sabun = '$gambar_soap'
			  WHERE id_sabun = $id_sabun
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload()
{
	$namaFile_sabun = $_FILES['gambar_sabun']['name'];
	$ukuranFile_sabun = $_FILES['gambar_sabun']['size'];
	$error_sabun = $_FILES['gambar_sabun']['error'];
	$tmpName_sabun = $_FILES['gambar_sabun']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error_sabun === 4) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid_sabun = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar_sabun = explode('.', $namaFile_sabun);
	$ekstensiGambar_sabun = strtolower(end($ekstensiGambar_sabun));
	if (!in_array($ekstensiGambar_sabun, $ekstensiGambarValid_sabun)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile_sabun > 1000000) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru_sabun = uniqid();
	$namaFileBaru_sabun .= '.';
	$namaFileBaru_sabun .= $ekstensiGambar_sabun;

	move_uploaded_file($tmpName_sabun, '../asset/uploaded-img/' . $namaFileBaru_sabun);

	return $namaFileBaru_sabun;
}

function registrasi($data)
{
	global $conn;

	$nama_user = htmlspecialchars(ucwords($data["nama_user"]));
	$username = htmlspecialchars(strtolower(stripslashes($data["username"])));
	$email = htmlspecialchars(strtolower(stripslashes($data["email"])));
	$password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
	$password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));

	//agar username dan email tidak kosong dan tanpa spasi
	if (preg_match_all('/\s/', $username)) {
		echo "<script>
				alert('username cannot contain any spaces');
			  </script>";
		return false;
	}

	if (preg_match_all('/\s/', $email)) {
		echo "<script>
				alert('email cannot contain any spaces');
			  </script>";
		return false;
	}

	//cek username udah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar!!');
			  </script>";
		return false;
	}

	$cekemail = mysqli_query($conn, "SELECT email_user FROM user WHERE email_user = '$email'");
	if (mysqli_fetch_assoc($cekemail)) {
		echo "<script>
				alert('email sudah terdaftar!!');
			  </script>";
		return false;
	}

	//cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('Password tidak sesuai!!');
			  </script>";
		return false;
	}

	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahlan userbaru ke database
	mysqli_query($conn, "INSERT INTO user (nama_user, username, password, email_user, role, Gambar_user) VALUES ('$nama_user', '$username', '$password', '$email', 'user', 'default-avatar.png')");
	return mysqli_affected_rows($conn);
}

function profile($data)
{
    global $conn;

    $id_user = mysqli_real_escape_string($conn, $data["id_user"]);
    $update_name = ucwords(mysqli_real_escape_string($conn, $data['update_name']));
    $update_email = mysqli_real_escape_string($conn, $data['update_email']);
    $update_phone = mysqli_real_escape_string($conn, $data['update_phone']);
    $update_alamat = ucwords(mysqli_real_escape_string($conn, $data['update_alamat']));
    $update_postcode = ucwords(mysqli_real_escape_string($conn, $data['update_postcode']));
    $update_kota = ucwords(mysqli_real_escape_string($conn, $data['update_kota']));
    $update_provinsi = ucwords(mysqli_real_escape_string($conn, $data['update_provinsi']));

    // Gunakan prepared statement untuk menghindari SQL injection
    $update_query = $conn->prepare("UPDATE `user` SET nama_user = ?, email_user = ?, nomor_user = ?, alamat_user = ?, postcode_user = ?, kota_user = ?, provinsi = ? WHERE id = ?");
    $update_query->bind_param("sssssssi", $update_name, $update_email, $update_phone, $update_alamat, $update_postcode, $update_kota, $update_provinsi, $id_user);

    if ($update_query->execute()) {
        // Query berhasil dieksekusi
    } else {
        // Query gagal
        die('Query failed');
    }

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = '../asset/uploaded-img/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            // Gambar terlalu besar
            $message[] = 'Image is too large';
        } else {
            // Validasi tipe file gambar
            $allowed_image_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
            $image_type = exif_imagetype($update_image_tmp_name);

            if (in_array($image_type, $allowed_image_types)) {
                $image_update_query = $conn->prepare("UPDATE `user` SET gambar_user = ? WHERE id = ?");
                $image_update_query->bind_param("si", $update_image, $id_user);

                if ($image_update_query->execute()) {
                    // Pindahkan file gambar
                    if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                        $message[] = 'Image updated successfully!';
                    } else {
                        $message[] = 'Failed to move uploaded file';
                    }
                } else {
                    $message[] = 'Failed to update image in database';
                }
            } else {
                $message[] = 'Invalid image file type';
            }
        }
    }

    return mysqli_affected_rows($conn);
}

