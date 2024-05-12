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
      
      $kode         = trim(mysqli_real_escape_string($con, $_POST['matakuliah']));
      $nid          = trim(mysqli_real_escape_string($con, $_POST['dosen']));
      $kelas        = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      $kode_jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $stat         = "A";

      $querycekstat   =  mysqli_query($con, "SELECT id FROM tb_periode WHERE stat='$stat'") or die (mysqli_error($con));
      if (mysqli_num_rows($querycekstat) > 0)
       {
           $data_periode = mysqli_fetch_assoc($querycekstat);
           $id_periode = $data_periode['id'];

           $querycekklsmk =  mysqli_query($con, "SELECT * FROM tb_kelasmatkul WHERE kode='$kode' AND nid='$nid' AND kelas='$kelas' AND id_periode='$id_periode'") or die (mysqli_error($con));

           if (mysqli_num_rows($querycekklsmk) > 0)
           {
               echo "<script>alert('Maaf, Transaksi Gagal! Data kelas matakuliah yang diinput sudah ada..');</script>";
               echo "<script>window.location='../backend_klsmatkul_admin';</script>";
    
           }
          else
           {
               mysqli_query($con, "INSERT INTO tb_kelasmatkul VALUES ('','$nid','$kode','$id_periode','$kelas','$kode_jurusan')") or die (mysqli_error($con));
           }
           
       }
      else
       {
        echo "<script>alert('Maaf, Transaksi Gagal! Error logic atau query!!!');</script>";
        echo "<script>window.location='../backend_klsmatkul_admin';</script>";

       }
     
          
    }

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas";

  }, 1500);
</script>
</body>
</html>