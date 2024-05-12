<?php 
require_once '../database/config.php';
$hal = "presensimhs"; 
if(isset($_SESSION['peran'])){
  if($_SESSION['peran']!='admin'){
    echo "<script>window.location='../auth/logout.php';</script>";
  }else{

  }
}else{
  echo "<script>window.location='../auth/logout.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel Presensi| Periode</title>
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
      <div class="container-fluid" style="padding-top:10px">
      
      <div class="card">
            <div class="card-header" style="background-color:#86090f">
            <font color="ffffff">
              <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i> Kelas Matakuliah</h3>
            </font>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <?php
            $id_klsmatkul = @$_GET['id'];
           
                $sql_kelasmatkul = mysqli_query($con, "SELECT tb_periode.tahun as tahun,tb_periode.semester as semester, tb_periode.id as id_periode, tb_dosen.nama as nama_dosen,tb_matkul.nama_ind as nama_mk_ind,tb_matkul.nama_eng as nama_mk_ing,tb_kelasmatkul.kelas as kelas FROM tb_periode,tb_dosen,tb_matkul,tb_kelasmatkul WHERE tb_kelasmatkul.id='$id_klsmatkul' AND tb_kelasmatkul.nid = tb_dosen.nid AND tb_periode.id=tb_kelasmatkul.id_periode AND tb_matkul.kode=tb_kelasmatkul.kode") or die (mysqli_error($con));
                $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);


                $sql_datamhs = mysqli_query($con, "SELECT * FROM tb_pesertamatkul WHERE id_klsmatkul='$id_klsmatkul'") or die (mysqli_error($con));
                if (mysqli_num_rows($sql_datamhs) > 0)
                {
                  $tgl = date('Y-m-d');
                  $kehadiran = "N";
                  while($data = mysqli_fetch_array($sql_datamhs))
                  {
                    $nim = $data['nim'];
                    $sql_cekdata = mysqli_query($con, "SELECT * FROM tb_presensi WHERE id_klsmatkul='$id_klsmatkul' AND nim='$nim' AND tanggal='$tgl'") or die (mysqli_error($con));
                    if (mysqli_num_rows($sql_cekdata) == 0)
                    {
                    $sql_createdatapresensi = mysqli_query($con, "INSERT INTO tb_presensi VALUES ('$id_klsmatkul','$tgl','$nim','$kehadiran')") or die (mysqli_error($con));
                    }
                    
                  }
                }
            ?>
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
                      <td><?= $dataklsmatkul['tahun']?> - <?=$dataklsmatkul['semester'] ?></td>
                    </tr>
                    <tr>
                      <td><b>Dosen Pengampu</b></td>
                      <td><?= $dataklsmatkul['nama_dosen']?></td>
                    </tr>
                    <tr>
                      <td><b>Mata Kuliah</b></td>
                      <td><?= $dataklsmatkul['nama_mk_ind']?></td>
                    </tr>
                    <tr>
                      <th>Kelas </th>
                      <td><?= $dataklsmatkul['kelas']?></td>
                    </tr>
                    </tbody>
                  </table>
                  </div>
                   <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background-color:#808080">
              
                <h3 class="card-title">QR Code</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                <center>
                  <div class="form-group">
                  <label><b>Presensi akan ditutup dalam waktu :</b>
                                <div id="timer"></div>
                              </label>
                    
                        <?php 
                         $hari_ini = date('d F Y H:i');
                        // isi qrcode yang ingin dibuat. akan muncul saat di scan
                        $isi = $id_klsmatkul;

                        // memanggil library php qrcode
                        include "../assets_adminLTE/dist/phpqrcode/qrlib.php"; 

                        // nama folder tempat penyimpanan file qrcode
                        $penyimpanan = "../dosen_backend_kelas/temp/";

                        // membuat folder dengan nama "temp"
                        if (!file_exists($penyimpanan))
                         mkdir($penyimpanan);

                        // perintah untuk membuat qrcode dan menyimpannya dalam folder temp
                        // atur level pemulihan datanya dengan QR_ECLEVEL_L | QR_ECLEVEL_M | QR_ECLEVEL_Q | QR_ECLEVEL_H
                        // atur pixel qrcode pada parameter ke 4
                        // atur jarak frame pada parameter ke 5
                        // $nama_qr = $nama_ind.'-'.$kelas.'-'.$hari_ini;
                        $file_qr = $penyimpanan.$id_klsmatkul.round(microtime(true)).'.png';
                        QRcode::png($isi, $file_qr, QR_ECLEVEL_L, 10, 5); 

                        // menampilkan qrcode 
                        echo '<img src="'.$file_qr.'">';
                        ?>
                    
                  </div>
                  <div class="form-group">
                    <label>Generate By : <?=$dataklsmatkul['nama_dosen'];?> <br> At : <?=$hari_ini;?></label>
    
                  </div>
                  <a href="../admin_presensi" class="btn btn-warning">
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

                <div id = 'presensi'>
                
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

<div class="modal fade" id="modal-qrcode">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
           
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-importklsmk">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data kelas MK
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="import.php" method="POST" id="import" enctype="multipart/form-data"> 
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


      <div class="modal fade" id="modal-importklsmkkon">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data kelas Terkonsolidasi
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="importtk.php" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
              </div>
              <br>
              <div class="row">
                <div class="form-group col-lg-4">
                  <center>
                  <h6>Template Excel</h6>
                  <a href="download.php?filename=templatekonsolidasi.xls" class="btn btn-success btn-sm">
                    <i class="nav-icon fas fa-file-excel"></i> Download
                  </a>
                  </center>
                </div>
                <div class="form-grup col-lg-4">
                  <center>
                  <h6>Data Dosen</h6>
                  <a href="ekspordosen.php" class="btn btn-success btn-sm">
                    <i class="nav-icon fas fa-file-excel"></i> Download
                  </a>
                  </center>
                </div>
                <div class="form-grup col-lg-4">
                  <center>
                  <h6>Data Matkul</h6>
                  <a href="download.php?filename=templatemkik.xls" class="btn btn-success btn-sm">
                    <i class="nav-icon fas fa-file-excel"></i> Download
                  </a>
                  </center>
                </div>
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="importtk" style="background-color:#86090f"><i class="nav-icon fas fa-file-excel"></i>Import Data</button>
              </form>
            </div>
          </div>
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

<script language="javascript">
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
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
if ( key==null || key==0 || key==8 || key==9 || key==27 )
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
    $(document).ready(function(){
      refreshTable();
    });

    function refreshTable(){
        $('#presensi').load('tabelpresensi.php?id_klsmk=<?= $id_klsmatkul;?>', function(){
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