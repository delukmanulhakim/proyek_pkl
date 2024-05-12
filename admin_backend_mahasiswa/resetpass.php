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
      
      $nim         = @$_GET['id'];
      $encpass     = "pass".$nim;
      $pass        = sha1($encpass);

      mysqli_query($con, "UPDATE tb_pengguna SET pass='$pass' WHERE username='$nim'") or die (mysqli_error($con));

     
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Password telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 2000);
</script> 
</body>
</html>