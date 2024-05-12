<?php
require_once '../database/config.php';
$hal = 'dasbor';
  if (isset($_SESSION['peran']))
    {
      if ($_SESSION['peran']!="dosen")
      {
         echo "<script>window.location='../auth/logout.php';</script>";
      }
      else
      {

      }
    }
  else
    {
      echo "<script>window.location='../auth/logout.php';</script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Dashboard I Grafik presensi </title>
  <?php
    include '../linksheet.php';
  ?>
</head>
<!--
body tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">

   <?php
    include '../navbar.php';
    ?>

  

    <!-- Sidebar -->
    <div class="sidebar">
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php
          include '../sidebar_dosen.php';
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SELAMAT DATANG <?php echo $_SESSION['nama']; ?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      


    
          
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

