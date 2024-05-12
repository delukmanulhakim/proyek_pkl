<?php 
require_once '../database/config.php';
$hal = "kelasmatkul";
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
  <title>Admin Panel | Kelas Mata Kuliah</title>
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
    <br>
    <div class="content">
      <div class="container-fluid" style="padding: top 8px;">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header" style="background-color:#86090f;">
              <font color="ffffff">
                <h3 class="card-title"> <i class="nav-icon fas fa-calendar-alt"></i> Data Mata Kuliah </h3>
              </font>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
              <?php 
              $id_klsmatkul = @$_GET['id'];
                    
              $sql_kelasmatkul = mysqli_query($con, "SELECT tb_kelasmatkul.kode_jurusan as kode_jurusan,tb_jurusan.nama as nama_jurusan, tb_periode.tahun as tahun,tb_periode.semester as semester, tb_periode.id as id_periode, tb_dosen.nama as nama_dosen,tb_matkul.nama_ind as nama_mk_ind,tb_matkul.nama_eng as nama_mk_ing,tb_kelasmatkul.kelas as kelas FROM tb_jurusan,tb_periode,tb_dosen,tb_matkul,tb_kelasmatkul WHERE tb_kelasmatkul.id='$id_klsmatkul' AND tb_kelasmatkul.nid = tb_dosen.nid AND tb_periode.Id=tb_kelasmatkul.id_periode AND tb_matkul.kode=tb_kelasmatkul.kode AND tb_kelasmatkul.kode_jurusan=tb_jurusan.kode") or die (mysqli_error($con));
              $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);
              $id_periode = $dataklsmatkul['id_periode'];

              ?>

                <div class="row">
                <div class="col-lg-6">
                    <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                        <th>Tahun Akademik</th>
                        <td><?= $dataklsmatkul['tahun']?> - <?= $dataklsmatkul['semester']?></td>
                        </tr>
                        <tr>
                        <th>Dosen Pengampu</th>
                        <td><?= $dataklsmatkul['nama_dosen']?></td>
                        </tr>
                        <tr>
                        <th>Mata Kuliah</th>
                        <td><?= $dataklsmatkul['nama_mk_ind']?></td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="col-lg-6">
                    <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                        <th>Kelas</th>
                        <td><?= $dataklsmatkul['kelas']?></td>
                        </tr>
                        <tr>
                        <th>Kode Jurusan</th>
                        <td><?= $dataklsmatkul['kode_jurusan']?> - <?= $dataklsmatkul['nama_jurusan']  ?></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
                
              <a href="../admin_backend_kelas" class="btn btn-warning">
                <i class="nav-icon fas fa-reply"></i> Kembali
              </a>
              <button type="button" class="btn btn-danger" style="background-color:#86090f;" data-toggle="modal" data-target="#modal-tambahmhs"><i class="nav-icon fas fa-plus"></i>
                  Tambah Data
              </button>
              <a href="impormhs.php" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                <i class="nav-icon fas fa-file-excel"></i> Import Data
              </a>
              <a href="resetmhs.php?id=<?=$id_klsmatkul?>" class="btn btn-danger" style="background-color:#86090f;" onclick="return confirm('Anda akan mereset data mahasiswa?')">
                <i class="fas fa-times"></i> Reset Data
              </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th style='width:5%'>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                  </tr> 
                  </thead>
                  
                  <?php
                      $no = 1;
                      $query = "SELECT nim FROM tb_pesertamatkul WHERE id_klsmatkul='$id_klsmatkul'";
                      $sql_pesertamatkul = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_pesertamatkul) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_pesertamatkul))
                            {
                              $nim = $data['nim'];
                              $sql_datamahasiswa = mysqli_query($con, "SELECT nim, nama FROM tb_mahasiswa WHERE nim='$nim'") or die (mysqli_error($con));
                              $datamahasiswa = mysqli_fetch_assoc($sql_datamahasiswa);
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$datamahasiswa['nim'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$datamahasiswa['nama'];?>
                                   </h6>
                                 </td>

                                <td>
                                     <center>
                                      <a href="deletemhs.php?id=<?=$id_klsmatkul;?> && nim=<?=$datamahasiswa['nim'];?>" 
                                      class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data mahasiswa [ <?=$datamahasiswa['nama'];?> - <?=$datamahasiswa['nim'];?> ] ?')"><i class="fas fa-trash"></i> Hapus</a> 
                                     </center>
                                </td>
                              </tr>

                            <?php
                          }

                        }
                        else
                        {
                          echo "<tr><td colspan=\"6\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                          ?>

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

  

 


<div class="modal fade" id="modal-tambahmhs">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f";>
              <h4 class="modal-title">
                <font color="ffffff">
                Tambah Data Mahasiswa
                </font>
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#86090f;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div><form class="form-horizontal" action="createmhs.php" method="POST" id="tambahmhs">
            <div class="modal-body">

                 <div class="form-group">
                  <label for="mhs">Mahasiswa</label>
                  <select class="form-control" name="mhs">
                    <?php
                    $kode_jurusan = $dataklsmatkul['kode_jurusan'];
                    $sql_mhs = mysqli_query($con, "SELECT nim, nama FROM tb_mahasiswa WHERE kode_jurusan='$kode_jurusan'") or die (mysqli_error($con));
                    
                    while ($data_mhs = mysqli_fetch_array($sql_mhs)){
                     ?>
                     <option value = "<?=$data_mhs['nim'];?>"><b><?=$data_mhs['nim'];?></b> - <?=$data_mhs['nama'];?>
                    </option>
                    <?php
                    }
                    ?>
                  </select>
                  </div>

                  <div class="form-group">
                  <input class="form-control" name="id_klsmatkul" value='<?=$id_klsmatkul;?>' hidden>
                  <input class="form-control" name="id_periode" value='<?=$id_periode;?>' hidden>
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
      
</div>

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
            <form class="form-horizontal" action="impormhs.php" method="POST" id="impor" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
                <input type="teks" id="id_klsmatkul" name="id_klsmatkul" class="form-control" value="<?=$id_klsmatkul;?>" hidden>
              </div>
             <h6>Template Excel</h6>
             <a href="download.php?filename=templateklsmhs.xlsx" class="btn btn-success btn-sm">
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


<!-- ./wrapper -->



<!-- Control Sidebar -->
<aside 
class="control-sidebar control-sidebar-dark">
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
