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
      
      $id_klsmatkul = @$_GET['id'];
      $ket = "OFF";

      mysqli_query($con, "UPDATE tb_temp SET ket='$ket' WHERE id_klsmatkul='$id_klsmatkul' AND ket='ON'") or die (mysqli_error($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Presensi Ditutup", "success");
  
  setTimeout(function(){ 
   window.location.href = "../dosen_backend_kelas";

  }, 1500);
</script> 
</body>
</html>