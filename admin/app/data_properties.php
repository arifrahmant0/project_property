<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Project</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Project</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">
                                Tambah Project
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Property ID</th>
                                        <th>Property Name</th>
                                        <th>Price</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Foto</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Koneksi ke database
                                    $koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

                                    // Mengecek koneksi
                                    if (!$koneksi) {
                                        die("Koneksi Gagal: " . mysqli_connect_error());
                                    }

                                    // Query untuk mengambil data dari tabel properties
                                    $query = "SELECT * FROM properties";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    // Menampilkan data
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                                <td>{$no}</td>
                                                <td>{$row['property_id']}</td>
                                                <td>{$row['property_name']}</td>
                                                <td>Rp. " . number_format($row['price'], 0, ',', '.') . "</td>
                                                <td>{$row['location']}</td>
                                                <td>{$row['description']}</td>
                                                <td><img src='../../assets/img/project/{$row['foto']}' alt='Gambar' width='100'></td>
                                                <td>{$row['stock']}</td>
                                                <td>
                                                    <button class='btn btn-warning btn-edit' data-bs-dismiss='modal' data-id='{$row['property_id']}' 
                                                            data-name='{$row['property_name']}' 
                                                            data-price='{$row['price']}' 
                                                            data-location='{$row['location']}' 
                                                            data-description='{$row['description']}' 
                                                            data-foto='{$row['foto']}' 
                                                            data-stock='{$row['stock']}'>Edit
                                                    </button>
                                                    <button class='btn btn-danger btn-delete' data-id='{$row['property_id']}'>Hapus</button>
                                                </td>
                                            </tr>";
                                        $no++;
                                    }

                                    // Menutup koneksi
                                    mysqli_close($koneksi);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content -->

<script>
    $(document).on('click', '.btn-edit', function() {
        // Ambil data dari tombol edit
        var property_id = $(this).data('id');
        var property_name = $(this).data('name');
        var price = $(this).data('price');
        var location = $(this).data('location');
        var description = $(this).data('description');
        var stock = $(this).data('stock');
        var foto = $(this).data('foto');

        // Isi data ke dalam modal
        $('#edit-property-id').val(property_id);
        $('#edit-property-name').val(property_name);
        $('#edit-price').val(price);
        $('#edit-location').val(location);
        $('#edit-description').val(description);
        $('#edit-stock').val(stock);

        // Tampilkan foto saat edit
        if (foto) {
            $('#current_foto').attr('src', '../../assets/img/project/' + foto).show();
        } else {
            $('#current_foto').hide();
        }

        // Tampilkan modal edit
        $('#modal-edit').modal('show');
    });

    $(document).on('click', '.btn-delete', function() {
        var property_id = $(this).data('id');
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'proses/hapus_properties.php?id=' + property_id;
        }
    });
</script>

<!-- Modal Edit Property -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Tambah Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="proses/edit_properties.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="property_id" id="edit-property-id">
                    <div class="mb-3">
                        <label for="edit-property-name" class="form-label">Property Name</label>
                        <input type="text" class="form-control" name="property_name" id="edit-property-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="edit-price" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" id="edit-location" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit-description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="edit-stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" id="edit-foto">
                        <img id="current_foto" src="" alt="Current Image" width="100" style="display:none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Property -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Property</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="proses/tambah_property.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="property-name" class="form-label">Property Name</label>
                        <input type="text" class="form-control" name="property_name" id="property-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" id="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Property</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>