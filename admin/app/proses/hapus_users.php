<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk menghapus pengguna
    $query = "DELETE FROM users WHERE user_id='$user_id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('User  deleted successfully!'); window.location.href='../../app/index.php?page=data-users';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($koneksi) . "'); window.location.href='../../app/index.php?page=data-users';</script>";
    }
} else {
    echo "<script>alert('No user ID provided!'); window.location.href='../../app/index.php?page=data-users';</script>";
}

// Menutup koneksi
mysqli_close($koneksi);

?>