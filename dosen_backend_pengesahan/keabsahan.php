<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengesahan | Presensi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets_adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <img src="../img/logo_upb.png" height="100px" width="200px" srcset="">
      </div>
      <!-- User name -->
      <div class="lockscreen-name">
        <h3><b>SISTEM PRESENSI MAHASISWA</b></h3>
        <h3>UNIVERSITAS PERADABAN</h3>
      </div>
      <br>

      <center>

        <h5>Menyatakan : </h5>
      </center>
      <br>

      <!-- START LOCK SCREEN ITEM -->
      <!-- <div class="lockscreen-item"> -->
      <!-- lockscreen image -->
      <!-- <div class="lockscreen-image">
      <img src="../img/verifikasi.png" alt="User Image">
    </div> -->

      <center>
        <button type="button" class="btn btn-success">Dokumen ini telah disahkan oleh : </button>
      </center>

      <br>

      <div class="row">
        <?php
        $nama = @$_GET['nama'];
        $tahun = @$_GET['tahun'];
        $matkul = @$_GET['matkul'];
        $tanggal = @$_GET['tanggal'];

        ?>
        <table class="table table-bordered table-sm">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td><b>Tahun Akademik </b></td>
              <td>:</td>
              <td><?= $tahun; ?></td>
            </tr>
            <tr>
              <td><b>Dosen Pengampu</b></td>
              <td>:</td>
              <td><?= $nama; ?></td>
            </tr>
            <tr>
              <td><b>Mata Kuliah</b></td>
              <td>:</td>
              <td><?= $matkul; ?> </td>
            </tr>
            <tr>
              <th>Kelas </th>
              <td>:</td>
              <td><?= $tanggal; ?></td>
            </tr>
          </tbody>
        </table>
      </div>

   





    <!-- jQuery -->
    <script src="./assets_adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./assets_adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>


</html>