<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Ambil data dari formulir
$nama = $_POST['nama'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$property_id = $_POST['property_id'];
$pesan = $_POST['pesan'];

// Validasi data (contoh sederhana)
if (empty($nama) || empty($email) || empty($whatsapp) || empty($property_id) || empty($pesan)) {
    die("Semua field harus diisi.");
}

// Cek apakah pelanggan sudah terdaftar
$query = "SELECT customers_id FROM customers WHERE email = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $customers_id);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Jika pelanggan tidak terdaftar, tambahkan mereka ke tabel customers
if (!$customers_id) {
    $query = "INSERT INTO customers (nama, email, whatsapp,type_rumah, pesan) VALUES (?, ?, ?,?,?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $whatsapp,$property_id,$pesan);
    mysqli_stmt_execute($stmt);
    $customers_id = mysqli_insert_id($koneksi); // Ambil ID pelanggan yang baru ditambahkan
    mysqli_stmt_close($stmt);
}

// Menyimpan data ke tabel inquiries
$query = "INSERT INTO inquiries (customers_id, property_id, pesan) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "iis", $customers_id, $property_id, $pesan);

// Eksekusi pernyataan
if (mysqli_stmt_execute($stmt)) {
    echo "Pertanyaan berhasil dikirim!";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);

// Mengarahkan kembali ke halaman utama
header('location: ../index.php?page=data-customer'); // Ganti 'index.php' dengan nama file halaman utama Anda
exit();
?>