<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php
   
     
     $nim      = trim(mysqli_real_escape_string($con, $_POST['nim']));
     $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
     $kontak   = trim(mysqli_real_escape_string($con, $_POST['nohp']));
     $kelamin  = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
     $status   = trim(mysqli_real_escape_string($con, $_POST['stat']));

    if($status=='Aktif'){
      $status = "A";
    }else{
      $status = "T";
    }
    if($kelamin=='Laki-laki'){
      $kelamin = "L";
    }else{
      $kelamin = "P";
    }
   

   mysqli_query($con, "UPDATE tb_mahasiswa SET nama='$nama',nohp ='$kontak', kelamin ='$kelamin', stat='$status' WHERE nim='$nim'") or die (mysqli_error($con));
   mysqli_query($con, "UPDATE tb_pengguna SET nama='$nama' WHERE username='$nim'") or die (mysqli_error($con));
  
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah di perbarui", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 2000);
</script> 
</body>
</html>