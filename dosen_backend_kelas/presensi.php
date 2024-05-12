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
  <title>Dosen Panel I Presensi</title>
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
                <h3 class="card-title"><i class="nav-icon fas fa-clipboard"></i> Absensi mahasiswa </h3>
              </font>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <?php
              $id_klsmatkul = @$_GET['id'];
              $pertemuan_ke = 1;
              $validasi = 0;
              $tgl = date('Y-m-d');

              $sql_kelasmatkul = mysqli_query($con, "SELECT tb_periode.tahun as tahun,tb_periode.semester as semester, tb_periode.id as id_periode, tb_dosen.nama as nama_dosen,tb_matkul.nama_ind as nama_mk_ind,tb_matkul.nama_eng as nama_mk_ing,tb_kelasmatkul.kelas as kelas, tb_pertemuan.id_klsmatkul as id_klsmatkul, tb_pertemuan.pertemuan as pertemuan FROM tb_periode,tb_dosen,tb_matkul,tb_kelasmatkul,tb_pertemuan WHERE tb_kelasmatkul.id='$id_klsmatkul' AND tb_kelasmatkul.nid = tb_dosen.nid AND tb_periode.id=tb_kelasmatkul.id_periode AND tb_matkul.kode=tb_kelasmatkul.kode") or die(mysqli_error($con));
              $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);

              $query_jumlah_pertemuan = mysqli_query($con, "SELECT COUNT(id_klsmatkul) AS pertemuan FROM tb_pertemuan") or die(mysqli_error($con));
                    $data_pertemuan = mysqli_fetch_assoc($query_jumlah_pertemuan);
                    $pertemuan_ke = $data_pertemuan['pertemuan'];
                    $pertemuan = $pertemuan_ke + 1;
                    $query_peserta_mk = mysqli_query($con, "SELECT id_klsmatkul, tb_pesertamatkul.nim, nama FROM tb_pesertamatkul, tb_mahasiswa WHERE tb_pesertamatkul.nim = tb_mahasiswa.nim AND id_klsmatkul='$id_klsmatkul' ") or die (mysqli_error($con));


              $sql_datamhs = mysqli_query($con, "SELECT * FROM tb_pesertamatkul WHERE id_klsmatkul='$id_klsmatkul'") or die(mysqli_error($con));
              if (mysqli_num_rows($sql_datamhs) > 0) {
                $tgl = date('Y-m-d');
                $kehadiran = "N";
                $validasi = "0";
                while ($data = mysqli_fetch_array($sql_datamhs)) {
                  $nim = $data['nim'];
                  $sql_cekdata = mysqli_query($con, "SELECT * FROM tb_presensi WHERE id_klsmatkul='$id_klsmatkul' AND nim='$nim' AND tanggal='$tgl'") or die(mysqli_error($con));
                  if (mysqli_num_rows($sql_cekdata) == 0) {
                    $sql_createdatapresensi = mysqli_query($con, "INSERT INTO tb_presensi VALUES ('$id_klsmatkul','$tgl','$nim','$kehadiran')") or die(mysqli_error($con));
                  }
                }
              }

              

                    $query_cek_pertemuan = mysqli_query($con, "SELECT * FROM tb_pertemuan WHERE id_klsmatkul='$id_klsmatkul' AND tanggal='$tgl'") or die(mysqli_error($con));
                    if (mysqli_num_rows($query_cek_pertemuan) > 0){

                    }else {
                      mysqli_query($con, "INSERT INTO tb_pertemuan VALUES ('$id_klsmatkul','$tgl','$pertemuan','$validasi')") or die(mysqli_error($con));
                    }


              $sql_cektempdata = mysqli_query($con, "SELECT * FROM tb_temp WHERE id_klsmatkul='$id_klsmatkul'") or die(mysqli_error($con));
              $ket = "ON";
              if (mysqli_num_rows($sql_cektempdata) > 0) {
                $sql_cektempdataon = mysqli_query($con, "SELECT * FROM tb_temp WHERE id_klsmatkul='$id_klsmatkul'AND ket='OFF'") or die(mysqli_error($con));
                if (mysqli_num_rows($sql_cektempdata) > 0) {
                  mysqli_query($con, "UPDATE tb_temp SET ket='$ket' WHERE id_klsmatkul='$id_klsmatkul'") or die(mysqli_error($con));
                } else {
                  echo "ppp";
                }
              } else {
                mysqli_query($con, "INSERT INTO tb_temp VALUE ('$id_klsmatkul','$ket')") or die(mysqli_error($con));
              }

              //pertemuan
              $sql_cekpertemuan = mysqli_query($con, "SELECT * FROM tb_pertemuan WHERE id_klsmatkul='$id_klsmatkul' AND tanggal='$tgl'") or die (mysqli_error($con));
              $sql_pertemuan = mysqli_query($con, "SELECT pertemuan FROM tb_pertemuan WHERE id_klsmatkul='$id_klsmatkul' GROUP BY tanggal") or die (mysqli_error($con));
              if(mysqli_num_rows($sql_cekpertemuan)>0){
                $pertemuan_ke = mysqli_num_rows($sql_pertemuan);
              }else{
                $pertemuan_ke = mysqli_num_rows($sql_pertemuan) + 1;
                mysqli_query($con,"INSERT INTO tb_pertemuan VALUE ('$id_klsmatkul','$tgl','$pertemuan_ke','$validasi')") or die(mysqli_error($con));
              }
            
              $display_tgl= date_format(date_create_from_format('Y-m-d', $tgl), 'd F Y');
              ?>
<div class="row">
                <div class="col-lg-12">
                  Pertemuan Ke :
                </div>
              </div>
              <div class="row">
              
                <div class="col-lg-4">
                <form class="form-horizontal" action="history_presensi.php?id=<?= $id_klsmatkul; ?> " method="POST">
                    <div class="form-group">
                      <select class="form-control" name="pertemuan" requried>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                      </select>
                    </div>
                 
                </div>



                <div class="col-lg-6">
                  <label for="tahun akademik"></label>
                  <button type="submit" class="btn btn-primary btn-md" name="cari">
                    <i class="nav-icon fas fa-search"></i> Tampilkan
                  </button>
                 
                </div>
                </form>
              </div>

              <div class="row">
                <div class="col-lg-6">

                  <form role="form">
                    <div class="card-body">
                      <div class="form-group">
                        <table class="table table-bordered table-sm">
                          <thead>
                          </thead>
                          <tbody>
                            <tr>
                              <td><b>Tahun Akademik </b></td>
                              <td><?= $dataklsmatkul['tahun'] ?> - <?= $dataklsmatkul['semester'] ?></td>
                            </tr>
                            <tr>
                              <td><b>Dosen Pengampu</b></td>
                              <td><?= $dataklsmatkul['nama_dosen'] ?></td>
                            </tr>
                            <tr>
                              <td><b>Mata Kuliah</b></td>
                              <td><?= $dataklsmatkul['nama_mk_ind'] ?></td>
                            </tr>
                            <tr>
                              <th>Kelas </th>
                              <td><?= $dataklsmatkul['kelas'] ?></td>
                            </tr>
                            <tr>
                              <th>Pertemuan </th>
                              <td><?= $pertemuan_ke; ?> <?php if($tgl!="00")echo " [$display_tgl]"; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- general form elements -->
                      <div class="card card-primary">
                        <div class="card-header" style="background-color:#505251 ">
                          <h3 class="card-title">QR Code Absensi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                          <div class="card-body">
                            <center>
                              <label><b>Presensi akan ditutup dalam waktu :</b>
                                <div id="timer"></div>
                              </label>

                              <div class="form-group">

                                <?php
                                $hari_ini = date('d F Y H:i');
                                // isi qrcode yang ingin dibuat. akan muncul saat di scan
                                $isi = $id_klsmatkul;

                                // memanggil library php qrcode
                                include "../assets_adminLTE/dist/phpqrcode/qrlib.php";

                                // nama folder tempat penyimpanan file qrcode
                                $penyimpanan = "temp/";

                                // membuat folder dengan nama "temp"
                                if (!file_exists($penyimpanan))
                                  mkdir($penyimpanan);

                                // perintah untuk membuat qrcode dan menyimpannya dalam folder temp
                                // atur level pemulihan datanya dengan QR_ECLEVEL_L | QR_ECLEVEL_M | QR_ECLEVEL_Q | QR_ECLEVEL_H
                                // atur pixel qrcode pada parameter ke 4
                                // atur jarak frame pada parameter ke 5
                                $file_qr = $penyimpanan . $id_klsmatkul . round(microtime(true)) . '.png';
                                QRcode::png($isi, $file_qr, QR_ECLEVEL_L, 10, 5);

                                // menampilkan qrcode 
                                echo '<img src="' . $file_qr . '">';
                                ?>

                              </div>
                              <div class="form-group">
                                <label>Generate By : <?= $dataklsmatkul['nama_dosen']; ?> <br> At : <?= $hari_ini; ?></label>
                              </div>
                            </center>
                            <center>
                              <a href="../dosen_backend_kelas" class="btn btn-warning btn-sm">
                                <i class="nav-icon fas fa-reply"></i> Kembali
                              </a>
                              <a href="offpresensi.php?id=<?= $id_klsmatkul; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menutup Presensi ?')">Tutup Presensi</a>
                            </center>
                          </div>
                          <!-- /.card-body -->


                        </form>
                      </div>
                      <!-- /.card -->

                    </div>
                  </form>

                </div>
                <div class="col-lg-6">

                  <br>
                  <!-- general form elements -->
                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">Data Mahasiswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="card-body">

                        <div id='presensi'>

                        </div>

                      </div>
                      <!-- /.card-body -->
                    </form>
                  </div>
                  <!-- /.card -->


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


    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php
    include '../script.php';
    ?>

    <script language="javascript">
      function getkey(e) {
        if (window.event)
          return window.event.keyCode;
        else if (e)
          return e.which;
        else
          return null;
      }

      function goodchars(e, goods, field) {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;

        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();

        // check goodkeys
        if (goods.indexOf(keychar) != -1)
          return true;
        // control keys
        if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
          return true;

        if (key == 13) {
          var i;
          for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i])
              break;
          i = (i + 1) % field.form.elements.length;
          field.form.elements[i].focus();
          return false;
        };
        // else return false
        return false;
      }
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        refreshTable();
      });

      function refreshTable() {
        $('#presensi').load('tabelpresensi.php?id_klsmk=<?= $id_klsmatkul; ?>&tanggal=<?= $tgl; ?>', function() {
          setTimeout(refreshTable, 10000);
        });
      }
    </script>

    <script>
      function countdownTimer() {
        var countDownDate = new Date().getTime() + 600000; // 1 menit (60000 milidetik)

        var x = setInterval(function() {
          var now = new Date().getTime();
          var distance = countDownDate - now;

          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

          if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "Waktu telah habis!";
            // Aktifkan fungsi PHP setelah waktu selesai
            window.location.href = "offpresensi.php?id=<?= $id_klsmatkul; ?>";
          }
        }, 1000);
      }
      countdownTimer();
    </script>
</body>

</html>