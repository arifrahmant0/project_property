<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Amarta Groups</title>

  <!-- Koneksi  -->
  <?php include('../conf/config.php'); ?>
  <?php include('header.php'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">


    <!-- Preloader -->
    <?php include('preloader.php'); ?>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->




    <?php
    $allowed_pages = ['data-leads', 'data-customer', 'data-properties', 'data-users'];

    if (isset($_GET['page']) && in_array($_GET['page'], $allowed_pages)) {
      switch ($_GET['page']) {
        case 'data-leads':
          include('data_leads.php');
          break;
        case 'data-customer':
          include('data_customer.php');
          break;
        case 'data-properties':
          include('data_properties.php');
          break;
        case 'data-users':
          include('data_users.php');
          break;
      }
    } else {
      include('data_leads.php'); // Default page
    }
    ?>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
      <div class="alert alert-success" role="alert">
        Data berhasil dihapus!
      </div>
    <?php endif; ?>

    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>

</body>

</html>