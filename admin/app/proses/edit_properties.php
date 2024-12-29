<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $property_name = $_POST['property_name'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    // Cek apakah ada foto baru yang diupload
    if ($_FILES['foto']['name']) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "../../assets/img/project/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
        
        // Update query dengan foto baru
        $query = "UPDATE properties SET property_name='$property_name', price='$price', location='$location', description='$description', foto='$foto', stock='$stock' WHERE property_id='$property_id'";
    } else {
        // Update query tanpa mengubah foto
        $query = "UPDATE properties SET property_name='$property_name', price='$price', location='$location', description='$description', stock='$stock' WHERE property_id='$property_id'";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location:../index.php?page=data-properties");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>