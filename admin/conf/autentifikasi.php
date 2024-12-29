<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Hash password yang dimasukkan
    $hashed_password = md5($password);

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM users WHERE user_name='$username' AND user_password='$hashed_password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika berhasil, set session dan redirect
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_level'] = $user['user_level']; // Jika Anda ingin menyimpan level pengguna
        header("Location:../app");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Username atau password salah!'); window.location.href='index.php';</script>";
    }
}

mysqli_close($koneksi);
?>