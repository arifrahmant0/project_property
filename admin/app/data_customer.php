<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Customer</li>
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
                            <h3 class="card-title">Permintaan Brosur / Price List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">
                                Tambah Customer
                            </button>
                            <br><br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Whatsapp</th>
                                        <th>Type Rumah</th>
                                        <th>Pesan</th>
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

                                    // Query untuk mengambil data dari tabel customers
                                    $query = "SELECT * FROM customers";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    // Menampilkan data
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                                <td>{$no}</td>
                                                <td>{$row['nama']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['whatsapp']}</td>
                                                <td>{$row['type_rumah']}</td> 
                                                <td>{$row['pesan']}</td>
                                                <td>
                                                    <button class='btn btn-warning' onclick='editCustomer({$row['customers_id']}, \"{$row['nama']}\", \"{$row['email']}\", \"{$row['whatsapp']}\", \"{$row['type_rumah']}\", \"{$row['pesan']}\")'>Edit</button>
                                                    <button class='btn btn-danger' onclick='confirmDelete({$row['customers_id']})'>Hapus</button>
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Edit Customer -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Customer</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses/edit_data.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="customers_id" id="edit-customers-id"> <!-- Input tersembunyi untuk ID customer -->
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="edit-nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="edit-email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-whatsapp" class="form-label">Whatsapp</label>
                        <input type="number" class="form-control" name="whatsapp" id="edit-whatsapp" placeholder="Masukkan Whatsapp" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-property-select" class="form-label">Pilih Type Rumah</label>
                        <select class="form-select" name="type_rumah" id="edit-property-select" required>
                            <option value="" disabled selected>Pilih salah satu</option>
                            <?php
                            // Koneksi ke database
                            $koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

                            // Mengecek koneksi
                            if (!$koneksi) {
                                die("Koneksi Gagal: " . mysqli_connect_error());
                            }

                            // Ambil data properti dari database
                            $result = mysqli_query($koneksi, "SELECT property_id, property_name FROM properties");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['property_id'] . "'>" . $row['property_name'] . "</option>";
                            }

                            mysqli_close($koneksi);
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-pesan" class="form-label">Pesan</label>
                        <textarea class="form-control" name="pesan" id="edit-pesan" rows="3" placeholder="Masukkan Pesan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Edit Customer -->

<!-- Modal Tambah Customer -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses/tambah_data.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="mb -3">
                        <label for="exampleFormControlInput2" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleFormControlInput2" placeholder="Masukkan Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleForm ControlInput3" class="form-label">Whatsapp</label>
                        <input type="number" class="form-control" name="whatsapp" id="exampleFormControlInput3" placeholder="Masukkan Whatsapp" required>
                    </div>
                    <div class="mb-4">
                        <label for="property_select" class="form-label">Pilih Type Rumah</label>
                        <select class="form-select" name="property_id" id="property_select" required>
                            <option value="" disabled selected>Pilih salah satu</option>
                            <?php
                            // Koneksi ke database
                            $koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

                            // Mengecek koneksi
                            if (!$koneksi) {
                                die("Koneksi Gagal: " . mysqli_connect_error());
                            }

                            // Ambil data properti dari database
                            $result = mysqli_query($koneksi, "SELECT property_id, property_name FROM properties");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['property_id'] . "'>" . $row['property_name'] . "</option>";
                            }

                            mysqli_close($koneksi);
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Pesan</label>
                        <textarea class="form-control" name="pesan" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan Pesan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Tambah Customer -->

<script>
    function editCustomer(id, nama, email, whatsapp, property_id, pesan) {
        // Mengisi data ke dalam modal edit
        document.getElementById('edit-customers-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-whatsapp').value = whatsapp;
        document.getElementById('edit-property-select').value = property_id;
        document.getElementById('edit-pesan').value = pesan;

        // Menampilkan modal edit
        $('#modal-edit').modal('show');
    }

    function confirmDelete(customers_id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'proses/hapus_data.php?id=' + customers_id;
        }
    }

    function confirmDelete(customers_id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'proses/hapus_data.php?id=' + customers_id;
        }
    }
</script>