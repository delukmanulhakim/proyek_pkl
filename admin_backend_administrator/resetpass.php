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
      
      $peran         = @$_GET['peran'];
      $encpass     = "pass".$id;
      $pass        = sha1($encpass);

      mysqli_query($con, "UPDATE tb_pengguna SET pass='$pass' WHERE username='$peran'") or die (mysqli_eror($con));

     
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Password telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_administrator";

  }, 2000);
</script> 
</body>
</html>