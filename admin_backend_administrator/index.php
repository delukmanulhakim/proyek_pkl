<?php
require_once '../database/config.php';
$hal = 'administrator';
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
  <title> Data Administrator</title>
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
                <h3 class="card-title"> <i class="nav-icon fas fa-users"></i>  Data Pengguna</h3>
                </font>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahmahasiswa" style="background-color:#86090f;">
                  <i class="nav-icon fas fa-plus"></i> Tambah Data
                </button>
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th><center>Aksi</center></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $admin = 'admin';
                      $sesion = $_SESSION["user"];
                      $query = "SELECT * FROM tb_pengguna WHERE peran ='$admin' AND username!='$sesion'";
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
                                   <?=$data['username'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['nama'];?>
                                   </h6>
                                 </td>

                                <td>
                                <?php
                                if (mysqli_num_rows($sql_mahasiswa) > 1)
                                {
                                ?>
                                 <center>
                                  <a href="resetpass.php?id=<?=$data['Id'];?>" 
                                  class="btn btn-warning btn-sm" onclick="return confirm('Anda yakin akan meriset password [ <?=$data['Id'];?> - <?=$data['username'];?> ] ?')">
                                    <i class="fas fa-edit"></i> Reset Password</a>
                                  <a href="delete.php?Id=<?=$data['Id'];?>" 
                                  class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus admin [ <?=$data['Id'];?> - <?=$data['username'];?> ] ?')">
                                    <i class="fas fa-trash"></i> Hapus</a> 
                                 </center>
                                 <?php
                                }
                                else {
                                 ?>
                                 <center>
                                  <button type="button" class="btn btn-warning btn-sm"  disabled>
                                    <i class="fas fa-edit"></i> Reset Password</button>
                                  <button type="button" class="btn btn-danger btn-sm"  disabled>
                                    <i class="fas fa-trash"></i> Hapus</button> 
                                </center>
                                <?php }
                                ?>
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



<div class="modal fade" id="modal-tambahmahasiswa"> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f;">
              <h5 class="modal-title"> 
                <font color="ffffff">
                <i class="fas fa-calendar-alt"></i> Tambah Data Admin</h5>
                </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-horizontal" action="create.php" method="POST" id="tambahmahasiswa">
            <div class="modal-body">

                  <div class="form-group">
                  <label for="username">Username</label>
                  <input type="teks" class="form-control" id="username" placeholder="Enter Username" name='username'>
                  </div>
                  <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="teks" class="form-control" id="nama" placeholder="Enter Nama" name='nama'>
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


      <div class="modal fade" id="modal-editmahasiswa"> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f;">
              <h5 class="modal-title"> 
                <font color="ffffff">
                <i class="fas fa-calendar-alt"></i> Edit Admin</h5>
                </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          <form class="form-horizontal" action="update.php" method="POST" id="editmahasiswa">
            <div class="modal-body">
              <div class="form-group">
                <label for="username">Username</label>
                  <input type="teks" class="form-control" id="username" placeholder="Enter Username" name='username' >
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                  <input type="teks" class="form-control" id="nama" placeholder="Enter Nama" name='nama'>
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

<?php
include '../footer.php';
?>


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php
 include '../script.php';
 ?>
<script type="text/javascript">

$('#modal-editmahasiswa').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var nim          = $(e.relatedTarget).data('nim');
     var nama         = $(e.relatedTarget).data('nama');
     var kelamin      = $(e.relatedTarget).data('kelamin');
     var kontak       = $(e.relatedTarget).data('nohp');
     var status       = $(e.relatedTarget).data('status');

    if(status=='A'){
      status = "Aktif";
    }else{
      status = "Tidak Aktif";
    }
    if(kelamin=='L'){
      kelamin = "Laki-laki";
    }else{
      kelamin = "Perempuan";
    }
     
     
     $(e.currentTarget).find('input[name="nim"]').val(nim);
     $(e.currentTarget).find('input[name="nim2"]').val(nim);
     $(e.currentTarget).find('input[name="nama"]').val(nama);
     $(e.currentTarget).find('select[name="kelamin"]').val(kelamin);
     $(e.currentTarget).find('input[name="nohp"]').val(kontak);
     $(e.currentTarget).find('select[name="status"]').val(status);
     
      
 });
</script>

</body>
</html>