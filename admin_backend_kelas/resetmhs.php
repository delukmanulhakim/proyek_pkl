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
      $id  =@$_GET['id'];
      mysqli_query($con, "DELETE FROM tb_pesertamatkul WHERE id_klsmatkul='$id' ") or die (mysqli_error($con));
      
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas/kelasmatkul.php?id=<?=$id?>";

  }, 1500);
</script> 
</body>
</html>