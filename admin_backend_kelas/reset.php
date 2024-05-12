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
      mysqli_query($con, "TRUNCATE TABLE tb_kelasmatkul") or die (mysqli_error($con));
      mysqli_query($con, "TRUNCATE TABLE tb_pesertamatkul") or die (mysqli_error($con));
      
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas";

  }, 1500);
</script> 
</body>
</html>