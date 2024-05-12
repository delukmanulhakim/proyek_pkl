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
      
      $nim      = trim(mysqli_real_escape_string($con, $_POST['nim']));
      $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $kelamin  = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
      $nohp     = trim(mysqli_real_escape_string($con, $_POST['nohp']));
      $kode_jurusan     = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $foto = ""; 
      $status   = "A";
      $encpass  = 'pass'.$nim;
      $pass     = sha1 ($encpass);
      $peran    = 'mhs';
    } 

      $querycek   =  mysqli_query($con, "SELECT * FROM tb_mahasiswa WHERE nim ='$nim'") or die (mysqli_error($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Transaksi Gagal! Data Tahun dan Semester yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_mahasiswa';</script>";

       }
      else
       {
        mysqli_query($con, "INSERT INTO tb_mahasiswa VALUES ('$nim','$nama','$kelamin','$nohp','$status', '$foto', '$kode_jurusan')") or die (mysqli_error($con));
        mysqli_query($con, "INSERT INTO tb_pengguna VALUES ('','$nim','$pass','$peran','$nama')") or die (mysqli_error($con));
        }
          
    

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 1000);
</script>
</body>
</html>