<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $property_name = mysqli_real_escape_string($koneksi, $_POST['property_name']);
    $price = mysqli_real_escape_string($koneksi, $_POST['price']);
    $location = mysqli_real_escape_string($koneksi, $_POST['location']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    $stock = mysqli_real_escape_string($koneksi, $_POST['stock']);

    // Proses upload foto
    $target_dir = "../../../assets/img/project/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar adalah gambar sebenarnya atau palsu
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    
    // Cek ukuran file
    if ($_FILES["foto"]["size"] > 1000000) { // 1MB
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya izinkan format file tertentu
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
        echo "Maaf, hanya file JPG, JPEG, WEBP, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek jika $uploadOk diatur ke 0 oleh kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file tidak diupload.";
    } else {
        // Jika semuanya baik-baik saja, coba upload file
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Query untuk menambahkan data ke tabel properties
            $query = "INSERT INTO properties (property_name, price, location, description, foto, stock) VALUES ('$property_name', '$price', '$location', '$description', '" . basename($_FILES["foto"]["name"]) . "', '$stock')";

            if (mysqli_query($koneksi, $query)) {
                // Jika berhasil, redirect ke halaman sebelumnya
                header("Location:../index.php?page=data-properties");
                exit(); // Pastikan untuk keluar setelah redirect
            } else {
                // Jika gagal, tampilkan pesan error
                echo "Error: " . mysqli_error($koneksi);
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}

// Menutup koneksi
mysqli_close($koneksi);

?>