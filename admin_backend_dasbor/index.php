<?php 
require_once '../database/config.php';
$hal = "dasbor";
if (isset($_SESSION['peran']))

{
  if ($_SESSION['peran']!='admin') 
  {
  echo "<script>window.location='../auth/logout.php';</script>";
}
else
      {

      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Dashboard</title>
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
    
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
            <?php
           include '../sidebar_admin.php';
           ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <div class="content">
      <div class="container-fluid" style="padding-top: 10px;">
      
      <!-- <?php
        // $sesi = $_SESSION['peran'];
        // echo $sesi;
        ?> -->
      <!-- ini adalah area untuk konten admin -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3>
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM tb_mahasiswa") or die (mysqli_error($con));
                  $jumlahmhs = mysqli_num_rows($query);
                  echo $jumlahmhs;
                  ?> 
                  </h3>

                <p>Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="../admin_backend_mahasiswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM tb_matkul") or die (mysqli_error($con));
                  $jumlahmhs = mysqli_num_rows($query);
                  echo $jumlahmhs;
                  ?> 
                  <sup style="font-size: 20px"></sup></h3>

                <p>Mata Kuliah</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../admin_backend_matakuliah" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3>
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM tb_kelasmatkul") or die (mysqli_error($con));
                  $jumlahmhs = mysqli_num_rows($query);
                  echo $jumlahmhs;
                  ?> 
                  </h3>

                <p>Kelas Mata Kuliah</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="../admin_backend_kelas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->


      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php
  include '../footer.php';
  ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php
  include '../script.php';
?>
</body>
</html>
