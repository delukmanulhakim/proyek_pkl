<?php 
require_once '../database/config.php';
$hal = "kelasmatkul";
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
  <title>Mahasiswa Panel | Kelas Mata Kuliah</title>
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
                <h3 class="card-title"> <i class="nav-icon fas fa-clipboard"></i> REKAP DATA PRESENSI</h3>
              </font>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
              <!-- <button type="button" class="btn btn-danger" style="background-color:#86090f;" data-toggle="modal" data-target="#modal-tambahklsmatkul"><i class="nav-icon fas fa-plus"></i>
                  Tambah Data
              </button>
              <a href="impor.php" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                <i class="nav-icon fas fa-file-excel"></i> Import Data
              </a>
              <a href="imporkonsolidasi.php" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-importklsmatkul">
                <i class="nav-icon fas fa-file-excel"></i> Import Terkonsolidasi
              </a>
              <a href="reset.php" class="btn btn-danger" style="background-color:#86090f;" onclick="return confirm('Anda akan mereset data kelas mata kuliah?')">
                <i class="fas fa-times"></i> Reset Data
              </a> -->
              <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>Mata Kuliah</th>
                      <th>Dosen Pengampu</th>
                      <th><center>Kelas</center></th>
                      <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php
                      $no = 1;
                      $aktif = 'A';
                      $nimmhs = $_SESSION['user'];
                      $query_periode = mysqli_query($con, "SELECT id FROM tb_periode WHERE stat='$aktif'");
                      $data_periode_aktif = mysqli_fetch_assoc($query_periode);
                      $periode_aktif = $data_periode_aktif['id'];
                      $query = "SELECT * FROM tb_pesertamatkul WHERE id_periode ='$periode_aktif' AND nim='$nimmhs'";
                      $sql_klsmatkul = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_klsmatkul) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_klsmatkul))
                            {
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                    <?php
                                    $id_klsmatkul = $data['id_klsmatkul'];
                                   $queryklsmatkul= mysqli_query($con, "SELECT * FROM tb_kelasmatkul WHERE id ='$id_klsmatkul'");
                                   $datakls=mysqli_fetch_array($queryklsmatkul);
                                   $idmk=$datakls['kode'];
                                   $querimk = mysqli_query($con, "SELECT * FROM tb_matkul WHERE kode='$idmk'");
                                    $datamk= mysqli_fetch_array($querimk);
                                    $kode_mk=$idmk;
                                    $nama_mk=$datamk['nama_ind'];
                                    $nama_mk_eng = $datamk['nama_eng'];
                                    $kelas=$datakls['kelas'];

                                    ?>
                                    <b><?=$kode_mk;?></b>
                                    <br> <?= $nama_mk;?>
                                    <br> <?= $nama_mk_eng;?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?php
                                    $nid = $datakls['nid'];
                                    $query_dosen = mysqli_query($con, "SELECT nama FROM tb_dosen WHERE nid ='$nid' ");
                                    $data_dosen = mysqli_fetch_assoc($query_dosen);
                                    $nama_dosen = $data_dosen['nama'];
                                    ?>
                                    <b><?=$nid;?></b>
                                    <br> <?= $nama_dosen;?>
                                   </h6>
                                 </td>

                                 <td>
                                  <center>
                                  <?= $kelas;?>
                                  </center>
                            </td>

                                <td>
                                  <center>
                                <a href="presensi.php?id=<?=$id_klsmatkul;?>&nim=<?=$nimmhs;?>" class="btn btn-primary btn-sm">
                                  <i class="fas fa-qrcode"></i>
                                   Presensi
                                </a>
                                <a href="delete.php"class="btn btn-danger btn-sm" ><i class="fas fa-history"></i> Histori</a> 
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
                  
                  
                    <tfoot>

                    </tfoot>
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


  <div class="modal fade" id="modal-tambahklsmatkul">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
            <font color="ffffff">
              <h4 class="modal-title"><i class="nav-icon fas fa-plus"></i>Tambah Kelas Matakuliah</h4>
              </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="create.php" method="POST" id="tambahperiode">
            <div class="modal-body">

                 <div class="form-group">
                  <label for="dosen">Dosen</label>
                  <select class="form-control" name="dosen">
                    <?php
                    $sql_dosen =  mysqli_query($con, "SELECT nid, nama FROM tb_dosen") or die (mysqli_error($con));
                    
                    while($data_dosen = mysqli_fetch_array($sql_dosen)){
                      ?>
                      <option value = "<?=$data_dosen['nid'];?>"><b><?=$data_dosen['nid'];?></b> - <?=$data_dosen['nama'];?></option>
                      <?php
                    }
                    ?>
                      </select>
                  </div>

                  <div class="form-group">
                  <label for="matakuliah">Matakuliah</label>
                  <select class="form-control" name="matakuliah">
                  <?php
                    $sql_matkul =  mysqli_query($con, "SELECT kode, nama_ind, nama_eng FROM tb_matkul") or die (mysqli_error($con));
                    
                    while($data_matkul = mysqli_fetch_array($sql_matkul)){
                      ?>
                      <option value = "<?=$data_matkul['kode'];?>"><b><?=$data_matkul['kode'];?></b> - [<?=$data_matkul['nama_ind'];?>] - [<?=$data_matkul['nama_eng'];?>]</option>
                      <?php
                    }
                    ?>
                        </select>
                  </div>

                  <div class="form-group">
                  <label for="kelas">Kelas</label>
                  <input type="text" class="form-control" id="kelas" placeholder="Masukan Kelas" name="kelas" maxlength="2" onKeyPress="return goodchars(event,'ABCDEFGHIJKLMNOPQRSTUVWXYZ',this)">
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
             <a href="download.php?filename=templatemk.xls" class="btn btn-success btn-sm">
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

      <!-- modal edit data mhs -->
<div class="modal fade" id="modal-importklsmatkul">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Terkonsolidasi
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="imporkonsolidasi.php" method="POST" id="impor" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <h6>Template Excel</h6>
                  <a href="download.php?filename=templatemkkonsol.xls" class="btn btn-success btn-sm">
                    <i class="nav-icon fas fa-file-excel"></i> Download
                  </a>
                </div>
                <div class="col-lg-4"> 
                 <h6>Data Dosen</h6>
                  <a href="ekspordosephpn." class="btn btn-primary btn-sm">
                    <i class="nav-icon fas fa-eye"></i> lihat Data
                  </a>
                </div>
                <div class="col-lg-4">
                 <h6>Data Matakuliah</h6>
                  <a href="ekspormk.php" class="btn btn-primary btn-sm">
                    <i class="nav-icon fas fa-eye"></i> Lihat Data
                  </a>
                </div>
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="imporkonsolidasi" style="background-color:#86090f"><i class="nav-icon fas fa-file-excel"></i>Import Data</button>
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
