<?php
require_once '../database/config.php';
$hal = "kelas";
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'dosen') {
    echo "<script>window.location='../auth/logout.php';</script>";
  } else {
  }
} else {
  echo "<script>window.location='../auth/logout.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dosen Panel Presensi| kelas</title>
  <?php
  include '../linksheet.php';
  ?>

</head>
<!--
body tag options:

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
    <!-- Main Sidebar Container -->

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
      <div class="content">
        <div class="container-fluid" style="padding-top:10px">

          <div class="card">
            <div class="card-header" style="background-color:#86090f">
              <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-clipboard"></i> DATA PRESENSI </h3>
              </font>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            
              <?php
              $id_klsmatkul = @$_GET['id'];

              $sql_kelasmatkul = mysqli_query($con, "SELECT tb_periode.tahun as tahun,tb_periode.semester as semester, tb_periode.id as id_periode, tb_dosen.nama as nama_dosen,tb_matkul.nama_ind as nama_mk_ind,tb_matkul.nama_eng as nama_mk_eng,tb_kelasmatkul.kelas as kelas FROM tb_periode,tb_dosen,tb_matkul,tb_kelasmatkul WHERE tb_kelasmatkul.id='$id_klsmatkul' AND tb_kelasmatkul.nid = tb_dosen.nid AND tb_periode.id=tb_kelasmatkul.id_periode AND tb_matkul.kode=tb_kelasmatkul.kode") or die(mysqli_error($con));
              $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);

              ?>
             

              <div class="row">
                <div class="col-lg-12">
                <!-- <a href="expordosen.php" class="btn btn-success ">
                  <i class="nav-icon fas fa-file-excel"></i> Export Excel
                </a> -->
               
              <a href="rekapabsensiall.php" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                  <i class="nav-icon fas fa-file"></i> Export PDF ALL
                </a>
             
                 

                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th style='width:5%'>No</th>
                        <th>Dosen</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>
                          <center>Presentase</center>
                        </th>
                        <th>
                          <center>Aksi</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $aktif = 'A';
                      $nid = $_SESSION['user'];
                      $query_periode = mysqli_query($con, "SELECT id FROM tb_periode WHERE stat='$aktif'");
                      $data_periode_aktif = mysqli_fetch_assoc($query_periode);
                      $periode_aktif = $data_periode_aktif['id'];
                      $query = "SELECT * FROM tb_kelasmatkul WHERE id_periode ='$periode_aktif' AND nid ='$nid'";
                      $sql_klsmatkul = mysqli_query($con, $query) or die(mysqli_error($con));
                      if (mysqli_num_rows($sql_klsmatkul) > 0) {
                        while ($data = mysqli_fetch_array($sql_klsmatkul)) {
                          $id_klsmatkul = $data['id'];
                      ?>
                      
                          <tr> 
                            <td>
                              <?= $no++; ?>
                            </td>

                            <td>
                            <h6>
                            <?php
                            $nid = $data['nid'];
                            $query_dosen = mysqli_query($con, "SELECT nama FROM tb_dosen WHERE nid ='$nid' ");
                            $data_dosen = mysqli_fetch_assoc($query_dosen);
                            $nama_dosen = $data_dosen['nama'];
                            ?>
                            <b><?= $nid; ?></b>
                            <br> <?= $nama_dosen; ?>
                          </h6>
                            </td>

                            <td>
                            <h6>
                            <?php
                            $kode_mk = $data['kode'];
                            $query_mk = mysqli_query($con, "SELECT nama_ind, nama_eng, sks FROM tb_matkul WHERE kode ='$kode_mk'");
                            $data_mk = mysqli_fetch_assoc($query_mk);
                            $nama_mk = $data_mk['nama_ind'];
                            $nama_mk_eng = $data_mk['nama_eng'];
                            $sks = $data_mk['sks'];
                            $kelas = $data['kelas'];
                            ?>
                            <b><?= $kode_mk; ?></b>
                            <br> <?= $nama_mk; ?>
                            <br> <?= $nama_mk_eng; ?>
                          </h6>
                            </td>

                            <td>
                            <center>
                            <?= $kelas ?>
                          </center>
                            </td>

                            <td>
                            <h6>
                            <?php 
                                        $hadir = 'Y';
                                        $pertemuan = 16;
                                        $query_total_peserta = mysqli_query($con, "SELECT * FROM tb_pesertamatkul WHERE id_klsmatkul='$id_klsmatkul' AND id_periode ='$periode_aktif'") or die(mysqli_error($con));
                                        $total_peserta = mysqli_num_rows($query_total_peserta);
                                        $total_presensi = $pertemuan*$total_peserta;
                                        $query_total_hadir = mysqli_query($con, "SELECT * FROM tb_presensi WHERE id_klsmatkul='$id_klsmatkul' AND kehadiran = '$hadir'") or die(mysqli_error($con));
                                        $total_hadir = mysqli_num_rows($query_total_hadir);
                                        $presentase = number_format(($total_hadir/$total_presensi)*100,2);
                                        echo $presentase.'%';
                                        ?>
                                </h6>
                            </td>
                               
                            <td>
                              <center>
                              <a href="presensi.php?id=<?= $data['id']; ?>" class="btn btn-primary btn-sm">
                              <i class="nav-icon fas fa-qrcode"></i>
                             QR Aksi
                            </a>

                            <a href="rekapabsensi.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm">
                              <i class="nav-icon fas fa-file-pdf"></i>
                              Ekspor PDF
                            </a>
                            <!-- <a href="#" class="btn btn-success btn-sm">
                              <i class="nav-icon fas fa-file-excel"></i>
                              Ekspor Excel
                            </a> -->
                            <a href="histori.php?id=<?= $data['id']; ?>" class="btn btn-secondary btn-sm">
                              <i class="nav-icon fas fa-history"></i>
                              History
                            </a>
                              </center>

                            </td>

                          </tr>

                      <?php
                        }
                      } else {
                        echo "<tr><td colspan=\"6\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                      }

                      ?>

                    </tbody>
                  </table>
                </div>
              </div>


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

  
  <!-- Main Footer -->
  <?php
  include("../footer.php");
  ?>

  <div class="modal fade" id="modal-tambahmhs">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#86090f">
          <font color="ffffff">
            <h4 class="modal-title"><i class="nav-icon fas fa-plus"></i>Tambah Data Mahasiswa</h4>
          </font>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="createmhs.php" method="POST" id="tambahmhs">
          <div class="modal-body">

            <div class="form-group">
              <label for="mhs">Mahasiswa</label>
              <select class="form-control" name="mhs">
                <?php
                $sql_mhs =  mysqli_query($con, "SELECT nim, nama FROM tbl_mahasiswa") or die(mysqli_error($con));

                while ($data_mhs = mysqli_fetch_array($sql_mhs)) {
                ?>
                  <option value="<?= $data_mhs['nim']; ?>"><b><?= $data_mhs['nim']; ?></b> - <?= $data_mhs['Nama']; ?></option>
                <?php
                }
                ?>
              </select>
              <input type="text" class="form-control" id="id_klsmatkul" placeholder="Masukan Kelas" value='<?= $id_klsmatkul; ?>' name="id_klsmatkul" hidden>
              <input type="text" class="form-control" id="id_periode" placeholder="Masukan Kelas" value='<?= $dataklsmatkul['id_periode']; ?>' name="id_periode" hidden>
            </div>
          </div>
          <div class="modal-footer pull-rigt">
            <button type="submit" name="tambahdata" class="btn btn-danger" style="background-color:#86090f;"><i class="fas fa-plus"></i> Tambah Data</button>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <?php
  include '../script.php';
  ?>
</body>

</html>