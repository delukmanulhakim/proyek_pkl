<?php 
require_once '../database/config.php';
$hal = "periode";
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
  <title>Admin Panel | Periode Akademik</title>
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
                <h3 class="card-title"> <i class="nav-icon fas fa-calendar-alt"></i> Periode Akademik </h3>
              </font>
              </div>


              <!-- /.card-header -->
              <div class="card-body">
              <button type="button" class="btn btn-danger" style="background-color:#86090f;" data-toggle="modal" data-target="#modal-tambahperiode"><i class="nav-icon fas fa-plus"></i>
                  Tambah Data
              </button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th style='width:5%'>No</th>
                    <th>Tahun</th>
                    <th>Semester</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr> 
                  </thead>
                  


                  <?php
                      $no = 1;
                      $query = "SELECT * FROM tb_periode";
                      $sql_periode = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_periode) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_periode))
                            {
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['tahun'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['semester'];?>
                                   </h6>
                                 </td>

                                 <td>
                                  <?php
                                  $stt = $data['stat'];
                                  if ($stt=='T')
                                    {
                                     ?>
                                     <center>
                                     <button type="button" class="btn btn-default btn-sm"> 
                                      Tidak Aktif
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                    else
                                    {
                                      ?>
                                    <center>
                                     <button type="button" class="btn btn-success btn-sm"> 
                                      Aktif
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                  ?>
                                 </td>

                                <td>
                                <?php
                                  if ($stt=='T')
                                    {
                                      $encodeid = sha1($data['id']);
                                     ?>
                                     <center>
                                      <a href="update.php?id=<?=$encodeid;?>&real=<?=$data['id'];?>" 
                                      class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin akan mengaktifkan periode [ <?=$data['tahun'];?> - <?=$data['semester'];?> ] ?')"><i class="fas fa-sync"></i> Aktifkan</a> 

                                      <a href="delete.php?id=<?=$encodeid;?>&real=<?=$data['id'];?>" 
                                      class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data periode [ <?=$data['tahun'];?> - <?=$data['semester'];?> ] ?')"><i class="fas fa-trash"></i> Hapus</a> 
                                     </center>
                                     <?php
                                    }
                                  ?>
                                </td>
                                   
                              </tr>

                            <?php
                          }

                        }
                        else
                        {
                          echo "<tr><td colspan=\"5\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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

  

 


<div class="modal fade" id="modal-tambahperiode">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f";>
              <h4 class="modal-title">
                <font color="ffffff">
                Tambah Periode Akademik
                </font>
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#86090f;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div><form class="form-horizontal" action="create.php" method="POST" id="tambahperiode">
            <div class="modal-body">

                 <div class="form-group">
                  <label for="tahunakademik">Tahun Akademik</label>
                  <select class="form-control" name="tahunakademik">
                          <option>2021</option>
                          <option>2022</option>
                          <option>2023</option>
                          <option>2024</option>
                      </select>
                  </div>

                  <div class="form-group">
                  <label for="semester">Semester</label>
                  <select class="form-control" name="semester">
                          <option>Ganjil</option>
                          <option>Genap</option>
                        </select>
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
