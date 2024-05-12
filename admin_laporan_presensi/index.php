<?php
require_once '../database/config.php';
$hal = 'laporanpresensi';
  if (isset($_SESSION['peran']))
    {
      if ($_SESSION['peran']!="admin")
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
  <title> Grafik presensi </title>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LAPORAN GRAFIK PRESENSI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flot</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      

        <div class="row">
          <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  GRAFIK MAHASISWA
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

            <!-- Area chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Area Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->

          <div class="col-md-6">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  GRAFIK DOSEN
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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



<div class="modal fade" id="modal-tambahmahasiswa"> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f;">
              <h5 class="modal-title"> 
                <font color="ffffff">
                <i class="fas fa-calendar-alt"></i> Tambah Data Admin</h5>
                </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-horizontal" action="create.php" method="POST" id="tambahmahasiswa">
            <div class="modal-body">

                  <div class="form-group">
                  <label for="username">Username</label>
                  <input type="teks" class="form-control" id="username" placeholder="Enter Username" name='username'>
                  </div>
                  <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="teks" class="form-control" id="nama" placeholder="Enter Nama" name='nama'>
                  </div>
            </div>
                         
            <div class="modal-footer pull-rigt">
              <button type="submit" name="tambahdata" class="btn btn-danger" style="background-color:#86090f;"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <div class="modal fade" id="modal-editmahasiswa"> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f;">
              <h5 class="modal-title"> 
                <font color="ffffff">
                <i class="fas fa-calendar-alt"></i> Edit Admin</h5>
                </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          <form class="form-horizontal" action="update.php" method="POST" id="editmahasiswa">
            <div class="modal-body">
              <div class="form-group">
                <label for="username">Username</label>
                  <input type="teks" class="form-control" id="username" placeholder="Enter Username" name='username' >
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                  <input type="teks" class="form-control" id="nama" placeholder="Enter Nama" name='nama'>
              </div>
            </div>

            <div class="modal-footer pull-rigt">
              <button type="submit" name="tambahdata" class="btn btn-danger" style="background-color:#86090f;"><i class="fas fa-plus"></i> Edit Data</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<?php
include '../footer.php';
?>


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php
 include '../script.php';
 ?>
<script type="text/javascript">

$('#modal-editmahasiswa').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var nim          = $(e.relatedTarget).data('nim');
     var nama         = $(e.relatedTarget).data('nama');
     var kelamin      = $(e.relatedTarget).data('kelamin');
     var kontak       = $(e.relatedTarget).data('nohp');
     var status       = $(e.relatedTarget).data('status');

    if(status=='A'){
      status = "Aktif";
    }else{
      status = "Tidak Aktif";
    }
    if(kelamin=='L'){
      kelamin = "Laki-laki";
    }else{
      kelamin = "Perempuan";
    }
     
     
     $(e.currentTarget).find('input[name="nim"]').val(nim);
     $(e.currentTarget).find('input[name="nim2"]').val(nim);
     $(e.currentTarget).find('input[name="nama"]').val(nama);
     $(e.currentTarget).find('select[name="kelamin"]').val(kelamin);
     $(e.currentTarget).find('input[name="nohp"]').val(kontak);
     $(e.currentTarget).find('select[name="status"]').val(status);
     
      
 });
</script>

</body>
</html>