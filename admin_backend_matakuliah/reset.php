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
      mysqli_query($con, "TRUNCATE TABLE tb_matkul") or die (mysqli_eror($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Matakuliah telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matakuliah";

  }, 1000);
</script> 
</body>
</html>