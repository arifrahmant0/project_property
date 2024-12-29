<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Query untuk menghapus data
    $query = "DELETE FROM properties WHERE property_id='$property_id'";
    
    if (mysqli_query($koneksi, $query)) {
        header('location: ../index.php?page=data-properties');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);



?>