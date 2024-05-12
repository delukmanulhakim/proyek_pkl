<?php
require_once '../database/config.php';
$hal = "manualbook";
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'mhs') {
    echo "<script>window.location='../auth/logout.php';</script>";
  } else {
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Periode Akademik</title>
  <?php
  include '../linksheet.php';
  ?>

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-miniprs
-->

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php
    include '../navbar.php';
    ?>


    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php
          include '../sidebar_mhs.php';
          ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <br>
      <div class="content">
        <div class="container-fluid" style="padding: top 8px;">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header" style="background-color:#86090f;">
                  <font color="ffffff">
                    <h3 class="card-title"> <i class="nav-icon fas fa-book"></i> Daftar Manual Book </h3>
                  </font>
                </div>


                <!-- /.card-header -->
                <div class="card-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>

                      <tr>
                        <th style='width:5%'>No</th>
                        <th>
                          <center>Judul</center>
                        </th>
                        <th>
                          <center>Aksi</center>
                        </th>
                      </tr>
                    </thead>
                    <tr>
                      <td>
                        1
                      </td>

                      <td>
                        <h6>
                          Pengisian Absensi Mahasiswa
                        </h6>
                      </td>

                      <td>
                        <a href="download.php?filename=templatemhs.xls" class="btn btn-danger btn-sm">
                          <i class="nav-icon fas fa-file-pdf"></i> Download Pdf
                        </a>
                      </td>

                    </tr>
                    <tr>
                      <td>
                        2
                      </td>

                      <td>
                        <h6>
                          Generate QR absensi
                        </h6>
                      </td>

                      <td>
                        <a href="download.php?filename=templatemhs.xls" class="btn btn-danger btn-sm">
                          <i class="nav-icon fas fa-file-pdf"></i> Download Pdf
                        </a>
                      </td>

                    </tr>



                  </table>

                  <!-- /.card-body -->
                </div>
              </div>
            </div>


          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->







    </div>


    <!-- ./wrapper -->



    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->


    <?php
    include '../footer.php';
    ?>


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <?php
    include '../script.php';
    ?>
</body>

</html>