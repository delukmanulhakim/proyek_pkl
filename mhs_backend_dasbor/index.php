<?php
$hal = "dasbor"; 
session_start();
if (isset($_SESSION['peran']))

{
  if ($_SESSION['peran']!='mhs') 
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
  <title>Mahasiswa Panel | Dashboard</title>
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
    <div class="content">
      <div class="container-fluid">
      
      <?php
        $sesi = $_SESSION['peran'];
        echo $sesi;
        ?>
        ini adalah area untuk konten mahasiswa



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
