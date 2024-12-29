<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$customers_id = $_POST['customers_id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$type_rumah = $_POST['type_rumah'];
$pesan = $_POST['pesan'];

// Query untuk memperbarui data
$query = "UPDATE customers SET 
            nama = '$nama', 
            email = '$email', 
            whatsapp = '$whatsapp', 
            type_rumah = '$type_rumah', 
            pesan = '$pesan' 
          WHERE customers_id = '$customers_id'";

if (mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke halaman sebelumnya
    header("Location: ../index.php?status=success");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);


header('location: ../index.php?page=data-customer'); // Redirect ke halaman utama
