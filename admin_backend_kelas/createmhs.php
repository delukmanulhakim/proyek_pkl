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
    if (isset($_POST['tambahdata']))
    {
      
      $nim   = trim(mysqli_real_escape_string($con, $_POST['mhs']));
      $id    = trim(mysqli_real_escape_string($con, $_POST['id_klsmatkul']));
      $id_periode    = trim(mysqli_real_escape_string($con, $_POST['id_periode']));
      $empty = '';
      

      $querycek     =  mysqli_query($con, "SELECT * FROM tb_pesertamatkul WHERE nim='$nim' AND id_klsmatkul='$id'") or die (mysqli_error($con));
           if (mysqli_num_rows($querycek) > 0)
           {
               echo "<script>alert('Maaf, Transaksi Gagal! Data mahasiswa di kelasmatakuliah yang diinput sudah ada..');</script>";
               echo "<script>window.location='../backend_klsmatkul_admin';</script>";
           }
          else
           {
               mysqli_query($con, "INSERT INTO tb_pesertamatkul VALUES ('$id','$nim','$id_periode')") or die (mysqli_error($con));
           }
    }

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas/kelasmatkul.php?id=<?=$id?> " ;

  }, 1500);
</script>
</body>
</html>