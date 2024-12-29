<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Leads</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title">Project The Amarta Green Residence</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Lokasi</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Leads</th>   
                                    
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

        // Query untuk mengambil data dari properties dan customers
        $query = "
            SELECT 
        p.property_name,
        p.price,
        p.location,
        p.description,
        p.foto,
        c.customers_id,  -- Pastikan kolom ini ada
        CONCAT(c.nama, ', ', c.whatsapp, ', ', c.email) AS leads
    FROM 
        properties p
    LEFT JOIN 
        inquiries i ON p.property_id = i.property_id
    LEFT JOIN 
        customers c ON i.customers_id = c.customers_id
        ";

        $result = mysqli_query($koneksi, $query);
        $no = 1;

        // Menampilkan data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['property_name']}</td>
                    <td>Rp. " . number_format($row['price'], 0, ',', '.') . "</td>
                    <td>{$row['location']}</td>
                    <td>{$row['description']}</td>
                    <td><img src='../../assets/img/project/{$row['foto']}' alt='Gambar' width='100'></td>
                    <td>{$row['leads']}</td>
                    
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

 



  <!-- /.content-wrapper -->
   <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="proses/tambah_data.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" placeholder="Masukkan Nama">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Masukkan Email">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Whatsapp</label>
            <input type="number" class="form-control" name="whatsapp" id="exampleFormControlInput1" placeholder="Masukkan Whatsapp">
          </div>
          <div class="mb-4">
                        <label for="property_select" class="form-label">Pilih Type Rumah</label>
                        <select class="form-select" name="property_id" id="property_select" required onchange="setPropertyId(this.value)">
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
            <label for="exampleFormControlInput1" class="form-label">Pesan</label>
            <textarea class="form-control" name="pesan" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          
        </div>
        
      </div>

      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="proses/tambah_data.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" placeholder="Masukkan Nama">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Masukkan Email">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Whatsapp</label>
            <input type="number" class="form-control" name="whatsapp" id="exampleFormControlInput1" placeholder="Masukkan Whatsapp">
          </div>
          <div class="mb-4">
                        <label for="property_select" class="form-label">Pilih Type Rumah</label>
                        <select class="form-select" name="property_id" id="property_select" required onchange="setPropertyId(this.value)">
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
            <label for="exampleFormControlInput1" class="form-label">Pesan</label>
            <textarea class="form-control" name="pesan" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          
        </div>
        
      </div>