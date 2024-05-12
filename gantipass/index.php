<?php 
session_start(); 
$hal = "gantipass";
$hal = 'gantipass';
$peran = $_SESSION['peran'];
//data pengguna
$id = $_SESSION['id'];
$user = $_SESSION['user'];
$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
if ($peran == 'admin'){?>
    <title>Admin Panel | Ganti Password </title>
  <?php
} elseif ($peran == 'dosen') { ?>
    <title>Dosen Panel | Ganti Password </title>
  <?php
} elseif ($peran == 'mhs') { ?>
    <title>Mahasiswa Panel | Ganti Password </title>
  <?php
}
?>

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
          if ($peran == 'admin') {
            include '../sidebar_admin.php';
          } elseif ($peran == 'dosen') {
            include '../sidebar_dosen.php';
          } elseif ($peran == 'mhs') {
            include '../sidebar_mhs.php';
          }
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
            <div class="card-header" style="background-color:#86090f">
            <font color="ffffff">
              <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i> Ganti Password</h3>
            </font>
            </div>

            

               
              
            
            <!-- /.card-header -->
            <div class="card-body">

      <form class="form-horizontal" action="update.php" method="POST" id="tambahdosen">
          <div class="modal-body">
               <div class="form-group">
               <input type="text" name="id" class="form-control" value="<?= $id;?>" hidden>
               <?php 
               if ($peran == 'admin'){?>
                    <label for="pass">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $user;?>" disabled>
                    <input type="text" name="username" class="form-control" value="<?= $user;?>" hidden>
                </div>
                <div class="form-group">
                    <label for="pass">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $nama;?>" disabled>
                </div>
                <?php
              } elseif ($peran == 'dosen') { ?>
                    <label for="pass">NID</label>
                    <input type="text" name="username" class="form-control" value="<?= $user;?>" disabled>
                    <input type="text" name="username" class="form-control" value="<?= $user;?>" hidden>
                </div>
                <div class="form-group">
                    <label for="pass">Nama Dosen</label>
                    <input type="text" name="nama" class="form-control" value="<?= $nama;?>" disabled>
                </div>
                <?php
              } elseif ($peran == 'mhs') { ?>
                    <label for="pass">NIM</label>
                    <input type="text" name="username" class="form-control" value="<?= $user;?>" disabled>
                    <input type="text" name="username" class="form-control" value="<?= $user;?>" hidden>
                </div>
                <div class="form-group">
                    <label for="pass">Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control" value="<?= $nama;?>" disabled>
                </div>
                <?php
              }
               ?>
               <div class="form-group">
                <label for="nohp">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Masukan Password" name="password">
               </div>
               <div class="form-group">
                <label for="nohp">New Password</label>
                <input type="password" class="form-control" id="newpassword" placeholder="Masukan New Password" name="newpassword">
               </div>
               <div class="form-group">
                <label for="nohp">Confirm New Password</label>
                <input type="password" class="form-control" id="cnewpassword" placeholder="Masukan Confirm New Password" name="cnewpassword">
               </div>
          </div>
          <div class="modal-footer pull-rigt">
            <button type="submit" name="ganti_pw" class="btn btn-danger" style="background-color:#86090f;"><i class="fas fa-edit"></i> Ganti Password</button>
          </div>
        </form>
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
</body>
</html>