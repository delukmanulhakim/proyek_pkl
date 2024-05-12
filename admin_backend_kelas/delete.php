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
      
      $id         = @$_GET['id'];
      mysqli_query($con, "DELETE FROM tb_kelasmatkul WHERE id='$id'") or die (mysqli_eror($con));
      mysqli_query($con, "DELETE FROM tb_pesertamatkul WHERE id_klsmatkul='$id'") or die (mysqli_eror($con));

    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data kelas matakuliah telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas";

  }, 1500);
</script> 
</body>
</html>