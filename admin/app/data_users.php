<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Admin Users</li>
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
                            <h3 class="card-title">Data Admin Amarta Groups</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">
                                Tambah Admin
                            </button>
                            <br><br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
                                        <th>User Level</th>
                                        <th>User Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Koneksi ke database
                                    $koneksi = mysqli_connect('localhost', 'root', '', 'db_amarta');

                                    if (!$koneksi) {
                                        die("Koneksi Gagal: " . mysqli_connect_error());
                                    }

                                    // Query untuk mengambil data users
                                    $query = "SELECT * FROM users";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    // Menampilkan data dalam tabel
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                                <td>{$row['user_id']}</td>
                                                <td>{$row['user_name']}</td>
                                                <td>{$row['user_email']}</td>
                                                <td>{$row['user_phone']}</td>
                                                <td>{$row['user_level']}</td>
                                                <td>{$row['user_status']}</td>
                                                <td>{$row['user_created']}</td>
                                                <td>
                                                    <a href='proses/hapus_users.php?id={$row['user_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
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

<!-- Modal Tambah Users -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-label">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="proses/tambah_users.php" method="post">
                    <div class="form-group">
                        <label for="username">User  Name</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">User  Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">User  Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="level">User  Level</label>
                        <select name="level" class="form-control" id="level" required>
                            <option value="1">Admin</option>
                            <option value="2">User </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">User  Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">User  Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>