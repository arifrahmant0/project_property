<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Ambil ID dari URL
$customers_id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query untuk menghapus data
$query = "DELETE FROM customers WHERE customers_id = '$customers_id'";

if (mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke halaman sebelumnya
    header("Location: ../index.php?status=deleted");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);

header('location: ../index.php?page=data-customer');
?>


