<?php
require_once '../database/config.php';
$hal = 'matakuliah';
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
  <title> Data Mata Kuliah</title>
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
   

<!-- Main content -->
<div class="content">
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header" style="background-color:#86090f;">
            <font color="ffffff">
              <h3 class="card-title"> <i class="nav-icon fas fa-users"></i>  Data Mata Kuliah</h3>
            </font>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahmahasiswa" style="background-color:#86090f;">
                <i class="nav-icon fas fa-plus"></i> Tambah Data
              </button>
              <a href="impor.php" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                <i class="nav-icon fas fa-file-excel"></i> Import Data
              </a>
              <a href="reset.php" class="btn btn-danger" style="background-color:#86090f;" onclick="return confirm('Anda akan mereset data matakuliah?')">
                <i class="fas fa-times"></i> Reset Data
              </a>
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th><center>Nama Indonesia</center></th>
                      <th><center>Nama Inggris</center></th>
                      <th><center>SKS</center></th>
                      <th><center>Aksi</center></th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT * FROM tb_matkul";
                      $sql_mahasiswa = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_mahasiswa) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_mahasiswa))
                            {
                                ?>
                            <tr>
                              <td>
                                <?=$no++;?>
                              </td>
                              <td>
                                <h6>
                                  <?=$data['kode'];?>
                                </h6>
                              </td>
                              <td>
                                <h6>
                                  <?=$data['nama_ind'];?>
                                </h6>
                              </td>
                              <td>
                                <h6>
                                  <?=$data['nama_eng'];?>
                                </h6>
                              </td>
                              <td>
                                <h6>
                                  <?=$data['sks'];?>
                                </h6>
                              </td>
                              <td>
                                <center> 
                                  <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editmatakuliah" data-id="<?=$data['id'];?>" data-kode="<?=$data['kode'];?>" data-namaid="<?=$data['nama_id'];?>" data-namaeng="<?=$data['nama_eng'];?>">
                                    <i class="fas fa-edit"></i>Edit
                                  </button> 
                                  <a href="delete.php?id=<?=$data['id'];?>" 
                                  class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data Mata Kuliah [ <?=$data['id'];?> - <?=$data['kode'];?> ] ?')"><i class="fas fa-trash"> 
                                    </i> Hapus</a> 
                                </center>   
                              </td>                                   
                            </tr>

                            <?php
                            }
                            }
                              else
                            {
                              echo "<tr><td colspan=\"7\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                            }
                            ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

                    
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


<!-- /.modal -->
  <div class="modal fade" id="modal-tambahmahasiswa"> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#86090f;">
          <h5 class="modal-title"> 
            <font color="ffffff">
            <i class="fas fa-calendar-alt"></i> Tambah Data Mata Kuliah</h5>
            </font>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="create.php" method="POST" id="tambahmahasiswa">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Kode Mata Kuliah</label>
              <input type="teks" class="form-control" id="kode" placeholder="Enter Kode" name='kode'>
            </div>
            <div class="form-group">
              <label for="nama">Nama Indonesia</label>
              <input type="teks" class="form-control" id="nama_ind" placeholder="Enter Nama" name='nama_ind'>
            </div>
            <div class="form-group">
              <label for="nama">Nama Inggris</label>
              <input type="teks" class="form-control" id="nama_eng" placeholder="Enter Name" name='nama_eng'>
            </div>
            <div class="form-group">
              <label for="number">SKS</label>
              <input type="number" class="form-control" id="sks" placeholder="Enter SKS" name='sks'>
            </div>                                                             
            <div class="modal-footer pull-rigt">
              <button type="submit" name="tambahdata" class="btn btn-danger" style="background-color:#86090f;"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
          </div>
        </form>
      </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->

<div class="modal fade" id="modal-editmatakuliah"> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#86090f;">
          <h5 class="modal-title"> 
            <font color="ffffff">
            <i class="fas fa-calendar-alt"></i> Edit Mata Kuliah</h5>
            </font>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form class="form-horizontal" action="update.php" method="POST" id="editmatakulaih">
        <div class="modal-body">
          <div class="form-group">
            <label for="id">ID</label>
              <input type="number" class="form-control" id="id2" placeholder="Enter ID" name='id' disabled>
              <input type="number" class="form-control" id="id" placeholder="Enter ID" name='id' hidden>
          </div>
          <div class="form-group">
            <label for="kode">Kode</label>
              <input type="teks" class="form-control" id="kode" placeholder="Enter Kode" name='kode'>
          </div>
          <div class="form-group">
            <label for="nama_ind">Nama Indonesia</label>
              <input type="teks" class="form-control" id="nama_ind" placeholder="Enter Nama" name='nama_ind'>
          </div>
          <div class="form-group">
            <label for="nama_eng">Nama Inggris</label>
              <input type="teks" class="form-control" id="nama_eng" placeholder="Enter Nama" name='nama_eng'>
          </div>
          <div class="form-group">
            <label for="sks">SKS</label>
              <input type="teks" class="form-control" id="sks" placeholder="Enter SKS" name='sks'>
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

<!-- modal edit data mhs -->
<div class="modal fade" id="modal-importdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data Mata Kuliah
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="impor.php" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
              </div>
             <h6>Template Excel</h6>
             <a href="download.php?filename=templatematkul.xls" class="btn btn-success btn-sm">
                  <i class="nav-icon fas fa-file-excel"></i> Download
                </a>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="impor" style="background-color:#86090f"><i class="nav-icon fas fa-file-excel"></i>Import Data</button>
              </form>
            </div>
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

$('#modal-editmatakuliah').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var id         = $(e.relatedTarget).data('id');
     var kode       = $(e.relatedTarget).data('kode');
     var namaid     = $(e.relatedTarget).data('nama_ind');
     var namaeng    = $(e.relatedTarget).data('nama_eng');
     var sks        = $(e.relatedTarget).data('sks');
     
     $(e.currentTarget).find('input[name="id"]').val(id);
     $(e.currentTarget).find('input[name="id2"]').val(id);
     $(e.currentTarget).find('input[name="kode"]').val(kode);
     $(e.currentTarget).find('input[name="nama_ind"]').val(namaid);
     $(e.currentTarget).find('input[name="nama_eng"]').val(namaeng);
          
 });
</script>


</body>
</html>