<?php 
require_once '../database/config.php';
$hal="presensi";
if(isset($_SESSION['peran'])){
  if($_SESSION['peran']!='mhs'){
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
  <title>Mahasiswa Panel Presensi| Dashboard</title>
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
<br>
      <div class="card">

      <div class="card-header" style="background-color:#86090f;">
              
               <font color="ffffff">
                <h3 class="card-title"> <i class="nav-icon fas fa-clipboard"></i>  PRESENSI MAHASISWA</h3>
                </font>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
      
      <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th style="width:25%">Mata Kuliah</th>
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
                                 
                                    <?php 
                                    $on = "ON";
                                    $sql_cektemppresensi = mysqli_query($con, "SELECT * FROM tb_temp WHERE id_klsmatkul='$id_klsmatkul' AND ket='$on'");
                                    if(mysqli_num_rows($sql_cektemppresensi) > 0)
                                    {
                                    ?>
                                      <a href="presensi.php?id=<?=$id_klsmatkul;?>&nim=<?=$nimmhs;?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-qrcode"></i>
                                        Presensi
                                      </a>
                                    <?php 
                                    }
                                    ?>
                                     
                                     <a href="histori.php?id=<?=$id_klsmatkul;?>&nim=<?=$nimmhs; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Histori
                                        </a> 
                             
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
 include("../footer.php");
 ?>
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
</body>
</html>