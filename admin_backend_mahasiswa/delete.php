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
      $nim         = @$_GET['nim'];
      mysqli_query($con, "DELETE FROM tb_mahasiswa WHERE nim='$nim'") or die (mysqli_error($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 1000);
</script> 
</body>
</html>