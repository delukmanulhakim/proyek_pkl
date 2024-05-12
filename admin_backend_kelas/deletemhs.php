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
      $nim        = @$_GET['nim'];
      mysqli_query($con, "DELETE FROM tb_pesertamatkul WHERE nim='$nim' AND id_klsmatkul='$id'") or die (mysqli_eror($con));

    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas/kelasmatkul.php?id=<?=$id?>";

  }, 1500);
</script> 
</body>
</html>