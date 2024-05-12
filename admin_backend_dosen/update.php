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
   
     
     $nid      = trim(mysqli_real_escape_string($con, $_POST['nid']));
     $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
     $kontak   = trim(mysqli_real_escape_string($con, $_POST['nohp']));
     $kelamin  = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
     $stat   = trim(mysqli_real_escape_string($con, $_POST['stat']));

    if($stat=='Aktif'){
      $stat2 = "A";
    }else{
      $stat2 = "T";
    }
    if($kelamin=='Laki-laki'){
      $kelamin = "L";
    }else{
      $kelamin = "P";
    }
   

   mysqli_query($con, "UPDATE tb_dosen SET nama='$nama',nohp ='$kontak', kelamin ='$kelamin', stat='$stat2' WHERE nid='$nid'") or die (mysqli_error($con));
   mysqli_query($con, "UPDATE tb_pengguna SET nama='$nama' WHERE username='$nid'") or die (mysqli_error($con));
  
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Dosen telah diperbarui", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_dosen";

  }, 2000);
</script> 
</body>
</html>