<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data
$query = "
    SELECT 
        p.property_name,
        p.price,
        p.location,
        p.description,
        p.foto,
        CONCAT(c.nama, ', ', c.whatsapp, ', ', c.email) AS leads
    FROM 
        properties p
    LEFT JOIN 
        inquiries i ON p.property_id = i.property_id
    LEFT JOIN 
        customers c ON i.customers_id = c.customers_id
";

$result = mysqli_query($koneksi, $query);

// Menampilkan data
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Property Name</th>
                <th>Price</th>
                <th>Location</th>
                <th>Description</th>
                <th>Foto</th>
                <th>Leads</th>
            </tr>
          </thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        // Pastikan path foto benar
        $fotoPath = '../../assets/img/project/' . $row['foto']; // Tambahkan '/' sebelum nama file

        echo "<tr>
                <td>{$row['property_name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['location']}</td>
                <td>{$row['description']}</td>
                <td><img src='{$fotoPath}' alt='Property Image' width='100'></td>
                <td>{$row['leads']}</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Tidak ada data yang ditemukan.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>

<!-- Tambahkan CSS untuk mempercantik tabel -->
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
    }
    .table thead tr {
        background-color: #007BFF;
        color: white;
    }
    .table th, .table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }
    .table tbody tr {
        border-bottom: 1px solid #ddd;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table img {
        border-radius: 5px;
    }
</style>