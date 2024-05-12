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
      
      $nid      = trim(mysqli_real_escape_string($con, $_POST['nid']));
      $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $kelamin  = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
      $nohp     = trim(mysqli_real_escape_string($con, $_POST['nohp']));
      $foto = "";
      if($kelamin=='Laki-laki'){
        $kelamin = "L";
      }else{
        $kelamin = "P";
      }
      $stat   = "A";
      $encpass  = 'pass'.$nid;
      $pass     = sha1 ($encpass);
      $peran    = 'dosen';
    } 

      $querycek   =  mysqli_query($con, "SELECT * FROM tb_dosen WHERE nid ='$nid'") or die (mysqli_eror($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Transaksi Gagal! Data Tahun dan Semester yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_dosen';</script>";

       }
      else
       {
        mysqli_query($con, "INSERT INTO tb_dosen VALUES ('$nid','$nama','$kelamin','$nohp','$stat','$foto')") or die (mysqli_eror($con));
        mysqli_query($con, "INSERT INTO tb_pengguna VALUES ('','$nid','$pass','$peran','$nama')") or die (mysqli_eror($con));
        }
  ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Dosen Telah Ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_dosen";

  }, 1000);
</script>
</body>
</html>