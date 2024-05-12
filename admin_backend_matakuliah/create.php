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
      
      $kode     = trim(mysqli_real_escape_string($con, $_POST['kode']));
      $namaid   = trim(mysqli_real_escape_string($con, $_POST['nama_ind']));
      $namaeng  = trim(mysqli_real_escape_string($con, $_POST['nama_eng']));
      $sks      = trim(mysqli_real_escape_string($con, $_POST['sks'])); 
    } 

      $querycek   =  mysqli_query($con, "SELECT * FROM tb_matkul WHERE kode ='$kode'") or die (mysqli_eror($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Transaksi Gagal! Data Tahun dan Semester yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_mahasiswa';</script>";

       }
      else
       {
        mysqli_query($con, "INSERT INTO tb_matkul VALUES ('','$kode','$namaid','$namaeng', '$sks')") or die (mysqli_eror($con));
        }
          
    

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata Kuliah telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matakuliah";

  }, 1000);
</script>
</body>
</html>