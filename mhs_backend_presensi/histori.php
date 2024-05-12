<?php
require_once '../database/config.php';
$hal = 'presensi';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'mhs') {
    echo "<script>window.location='../auth';</script>";
  }
} else {
  echo "<script>window.location='../auth';</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mhs Panel | Histori Presensi</title>
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
    <br>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header" style="background-color: #86090f;">
              <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-book"></i>DATA PRESENSI MAHASISWA</h3>
              </font>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <a href="../admin_presensi" class="btn btn-warning">
                    <i class="nav-icon fas fa-reply"></i> Kembali </a>
                    
                <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                  <th style="width:5%" rowspan="2">No</th>
                    <th rowspan="2"><center>NAMA MAHASISWA</center></th>
                    <th colspan="16"><center>PERTEMUAN</center></th>
                    </tr>
                    <tr>
                    <td width:3%>
                                  <center>
                                   <h6>
                                   1
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   2
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   3
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   4
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   5
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   6
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   7
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   UTS
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   9
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   10
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   11
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   12
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   13
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   14
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   15
                                   </h6>
                                  </center>
                                 </td>
<td width:3%>
                                  <center>
                                   <h6>
                                   UAS
                                   </h6>
                                  </center>
                                 </td>
                    </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $id_klsmatkul =@$_GET['id'];
                  $sql_klsmk = mysqli_query($con, "SELECT nim FROM tb_pesertamatkul WHERE id_klsmatkul = '$id_klsmatkul'") or die(mysqli_error($con));
                  if (mysqli_num_rows($sql_klsmk) > 0) {
                    while ($data = mysqli_fetch_array($sql_klsmk)) {
                      $nim = $data['nim'];
                      $sql_mhs = mysqli_query($con, "SELECT nama FROM tb_mahasiswa WHERE nim = '$nim'") or die(mysqli_error($con));
                        $nama_mhs = mysqli_fetch_assoc($sql_mhs);
                        $nama = $nama_mhs['nama'];
                  ?>
                      <tr>
                        <td>
                          <?= $no++; ?>
                        </td>

                      
                        <td>
                          <h6>
                          <?=$nama;?>
                          </h6>
                        </td>
                      

                        <?php
                                 $sql_presensi =  mysqli_query($con, "SELECT kehadiran FROM tb_presensi WHERE id_klsmatkul = '$id_klsmatkul' AND nim = '$nim'") or die(mysqli_error($con));
                                 $jumlah = mysqli_num_rows($sql_presensi);
                                 $data_kehadiran = mysqli_fetch_array($sql_presensi);
                                 
                                
                                 for ($i=1; $i<=16;$i++) {
                            
                                  $src = '../admin_presensi/tanda/not.png';
                                  if ($i <= $jumlah) {
                                    $absen = $data_kehadiran['kehadiran']; 
                                    if ($absen == 'Y') {
                                      $src = '../admin_presensi/tanda/ya.png';
                                    }
                                    
                                  } 
                                  echo '<td>
                                  <center>
                                   <h6>
                                   <img src="'.$src.'" alt="absen" width="20px">
                                   </h6>
                                  </center>
                                 </td>';
                                 }
                                 ?>

                  

                    </tr>

                  <?php
                    }
                  } else {
                    echo "<tr><td colspan=\"18\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                  }

                  ?>

                </tbody>
              </table>


               
              
            </div>
            <!-- /.card-body -->
          </div>
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

   
    <!--/.modal-->
    <!-- REQUIRED SCRIPTS -->
    <!-- modal edit data mk -->
    


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

</body>

</html>