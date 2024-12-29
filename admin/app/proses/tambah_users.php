<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $phone = mysqli_real_escape_string($koneksi, $_POST['phone']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Hash password menggunakan MD5
    $hashed_password = md5($password);

    // Cek apakah username atau email sudah ada
    $query = "SELECT * FROM users WHERE user_name='$username' OR user_email='$email'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username or email already exists!'); window.location.href='index.php?page=data-users';</script>";
    } else {
        // Simpan data pengguna ke database
        $query = "INSERT INTO users (user_name, user_email, user_phone, user_level, user_status, user_password) VALUES ('$username', '$email', '$phone', '$level', '$status', '$hashed_password')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('User  added successfully!'); window.location.href='index.php?page=data-users';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='index.php?page=data-users';</script>";
        }
    }
}

// Menutup koneksi
mysqli_close($koneksi);

// Mengarahkan kembali ke halaman utama
header('location: ../index.php?page=data-users'); // Ganti 'index.php' dengan nama file halaman utama Anda
?>