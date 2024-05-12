<?php
require_once '../database/config.php';
$hal = 'dosen';
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
<title> Data Dosen | Presensi</title>
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
   
  <div class="content">
  <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header" style="background-color:#86090f;">
            <font color="ffffff">
              <h3 class="card-title"> <i class="nav-icon fas fa-users"></i>  Data Dosen</h3>
            </font>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahdosen" style="background-color:#86090f;">
                  <i class="nav-icon fas fa-plus"></i> Tambah Data
                </button>
                <a href="impor.php" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                  <i class="nav-icon fas fa-file-excel"></i> Import Data
                </a>
                <a href="reset.php" class="btn btn-danger" style="background-color:#86090f;" onclick="return confirm('Anda akan mereset data dosen?')">
                  <i class="fas fa-times"></i> Reset Data
                </a>
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NID</th>
                    <th>Nama</th>
                    <th><center>Kelamin</center></th>
                    <th><center>Kontak</center></th>
                    <th><center>Status</center></th>
                    <th><center>Foto</center></th>
                    <th><center>Aksi</center></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT * FROM tb_dosen";
                      $sql_dosen = mysqli_query($con, $query) or die (mysqli_error($con));
                        if (mysqli_num_rows($sql_dosen) > 0)
                        {
                        while($data = mysqli_fetch_array($sql_dosen))
                        {
                    ?>
                      <tr>
                        <td>
                          <?=$no++;?>
                        </td>
                        <td>
                          <h6>
                            <?=$data['nid'];?>
                          </h6>
                        </td>
                        <td>
                          <h6>
                            <?=$data['nama'];?>
                          </h6>
                        </td>
                        <td>
                          <?php
                          $stat = $data['kelamin'];
                          if ($stat=='L')
                          {
                          ?>
                          <center>
                            <button type="button" class="btn btn-default btn-sm"> Laki - Laki</button>
                          </center>
                          <?php 
                          }
                          else
                          {
                          ?>
                          <center>
                            <button type="button" class="btn btn-default btn-sm"> Perempuan</button>
                          </center>
                          <?php 
                          }
                          ?>
                          </td>
                          <td>
                            <center>
                              <h6>
                                <a href="https://wa.me/<?=$data['nohp'];?>" target="blank">
                                <i class="fas fa-phone"></i> <?=$data['nohp'];?> </a>
                              </h6>
                            </center>
                          </td>
                          <td>
                            <?php
                            $stat = $data['stat'];
                            if ($stat=='T')
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
                              <center>
                                <?php 
                                if (($data['kelamin'] == 'L') && ($data['foto'] == ''))
                                {
                                ?>
                                <button class="btn" style="background-color:transparent"  data-toggle="modal" data-target="#modal-gantifoto" data-nidosen="<?=$data['nid'];?>" data-fotodosen="template/img/dosen-lanang.png">
                                  <img src="template/img/dosen-lanang.png" width="32px" height="32px" alt="">
                                </button> 
                                <?php 
                                  }
                                  elseif (($data['kelamin'] == 'P') && ($data['foto'] == ''))
                                  {
                                ?>
                                <button class="btn" style="background-color:transparent"  data-toggle="modal" data-target="#modal-gantifoto" data-nidosen="<?=$data['nid'];?>" data-fotodosen="template/img/dosen-wadon.png">
                                  <img src="template/img/dosen-wadon.png" width="32px" height="32px" alt="">
                                </button> 
                                <?php 
                                  }
                                  else 
                                  {
                                ?>
                                <button class="btn" style="background-color:transparent"  data-toggle="modal" data-target="#modal-gantifoto" data-nidosen="<?=$data['nid'];?>" data-fotodosen="<?=$data['foto'];?>">
                                  <img src="<?= $data['foto']; ?>" width="32px" height="32px" >
                                </button> 
                              <?php
                                }
                              ?>
                            <img src="" alt="">
                          </center>
                        </td>
                        <td>
                          <center>
                            <a href="resetpass.php?id=<?=$data['nid'];?>" 
                            class="btn btn-warning btn-sm" onclick="return confirm('Anda yakin akan mereset password [ <?=$data['nid'];?> - <?=$data['nama'];?> ] ?')"><i class="fas fa-edit"></i> Reset Password
                            </a> 
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editdosen" data-nid="<?=$data['nid'];?>" data-nama="<?=$data['nama'];?>" data-kelamin="<?=$data['kelamin'];?>" data-nohp="<?=$data['nohp'];?>" stat="<?=$data['stat'];?>">
                              <i class="fas fa-edit"></i>edit
                            </button> 
                            <a href="delete.php?nid=<?=$data['nid'];?>" 
                            class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data dosen [ <?=$data['nid'];?> - <?=$data['nama'];?> ] ?')">
                            <i class="fas fa-trash"></i> Hapus
                            </a> 
                          </center>
                        </td>
                      </tr>
                              <?php
                              }
                              }
                              else
                              {
                              echo "<tr><td colspan=\"8\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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



<div class="modal fade" id="modal-tambahdosen"> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f;">
              <h5 class="modal-title"> 
                <font color="ffffff">
                <i class="fas fa-calendar-alt"></i> Tambah Data Dosen</h5>
                </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-horizontal" action="create.php" method="POST" id="tambahdosen">
            <div class="modal-body">
              <div class="form-group">
                  <label for="nid">NID</label>
                  <input type="number" class="form-control" id="nid" placeholder="Enter NID" name='nid'>
                  </div>
                  <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="teks" class="form-control" id="nama" placeholder="Enter Nama" name='nama'>
                  </div>
                  <div class="form-group">
                  <label for="kelamin">Kelamin</label>
                  <select class="form-control" name="kelamin">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="kontak">Kontak</label>
                  <input type="teks" class="form-control" id="nohp" placeholder="Enter No Hp" name='nohp'>
                  </div>
                  <div class="form-group">
                  <label for="stat">Status</label>
                  <select class="form-control" name="stat">
                    <option>Aktif</option>
                    <option>Tidak Aktif</option>
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


      <div class="modal fade" id="modal-editdosen"> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f;">
              <h5 class="modal-title"> 
                <font color="ffffff">
                <i class="fas fa-calendar-alt"></i> Edit Data Dosen</h5>
                </font>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-horizontal" action="update.php" method="POST" id="editdosen">
            <div class="modal-body">
              <div class="form-group">
                <label for="nid">NID</label>
                  <input type="number" class="form-control" id="nid2" placeholder="Enter NID" name='nid2' disabled>
                  <input type="number" class="form-control" id="nid" placeholder="Enter NID" name='nid' hidden>
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                  <input type="teks" class="form-control" id="nama" placeholder="Enter Nama" name='nama'>
              </div>
              <div class="form-group">
                <label for="kelamin">Kelamin</label>
                  <select class="form-control" name="kelamin">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="kontak">Kontak</label>
                  <input type="teks" class="form-control" id="nohp" placeholder="Enter No Hp" name='nohp'>
              </div>
              <div class="form-group">
                <label for="stat">Status</label>
                  <select class="form-control" name="stat">
                    <option>Aktif</option>
                    <option>Tidak Aktif</option>
                  </select>
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


    <!-- modal edit data mhs -->
    <div class="modal fade" id="modal-importdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data Dosen
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
              <a href="download.php?filename=templatedosen.xls" class="btn btn-success btn-sm">
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

      <div class="modal fade" id="modal-gantifoto">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-image"></i> 
                Ganti Foto
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="gantifoto.php" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <center>
                <img src="" id="fotodosen" name="fotodosen" width="200px" height="200px"/>
              </center>
            <div class="form-group">
              <label for="Nama">Ambil file Foto</label>
              <input type="file" id="filefoto" name="filefoto" class="form-control" accept=".png,.jpg" required>
              <input type="text" id="nidosen" name="nidosen" class="form-control" hidden>
            </div>
          
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="gantifoto" style="background-color:#86090f"><i class="nav-icon fas fa-upload"></i>Upload Foto</button>
              </form>
            </div>
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

$('#modal-editdosen').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var nid          = $(e.relatedTarget).data('nid');
     var nama         = $(e.relatedTarget).data('nama');
     var kelamin      = $(e.relatedTarget).data('kelamin');
     var kontak       = $(e.relatedTarget).data('nohp');
     var stat       = $(e.relatedTarget).data('stat');

    if(stat=='A'){
      stat = "Aktif";
    }else{
      stat = "Tidak Aktif";
    }
    if(kelamin=='L'){
      kelamin = "Laki-laki";
    }else{
      kelamin = "Perempuan";
    }
     
     
     $(e.currentTarget).find('input[name="nid"]').val(nid);
     $(e.currentTarget).find('input[name="nid2"]').val(nid);
     $(e.currentTarget).find('input[name="nama"]').val(nama);
     $(e.currentTarget).find('select[name="kelamin"]').val(kelamin);
     $(e.currentTarget).find('input[name="nohp"]').val(kontak);
     $(e.currentTarget).find('select[name="stat"]').val(stat);
     
      
 });
</script>

<script type="text/javascript">
$('#modal-gantifoto').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var nidosen          = $(e.relatedTarget).data('nidosen');
     var fotodosen          = $(e.relatedTarget).data('fotodosen');
     
     $(e.currentTarget).find('input[name="nidosen"]').val(nidosen);
     document.getElementById('fotodosen').src = fotodosen;
    
});
</script>

</body>
</html>