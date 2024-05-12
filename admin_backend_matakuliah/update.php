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
   
     
     $id      = trim(mysqli_real_escape_string($con, $_POST['id']));
     $kode    = trim(mysqli_real_escape_string($con, $_POST['kode']));
     $namaid  = trim(mysqli_real_escape_string($con, $_POST['nama_ind']));
     $namaeng = trim(mysqli_real_escape_string($con, $_POST['nama_eng']));

 mysqli_query($con, "UPDATE tb_matkul SET kode='$kode', nama_ind='$namaid', nama_eng='$namaeng' WHERE id='$id'") or die (mysqli_eror($con));
  
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah di perbarui", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matakuliah";

  }, 2000);
</script> 
</body>
</html>