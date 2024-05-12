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
      $username = trim(mysqli_real_escape_string($con, $_POST['username']));
      $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $encpass  = 'pass'.$username;
      $pass     = sha1 ($encpass);
      $peran    = 'admin';
    } 

      $querycek   =  mysqli_query($con, "SELECT * FROM tb_pengguna WHERE username ='$username'") or die (mysqli_eror($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Transaksi Gagal! Data Tahun dan Semester yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_administrator';</script>";
 }
      else
       {
        mysqli_query($con, "INSERT INTO tb_pengguna VALUES ('','$username','$pass','$peran','$nama')") or die (mysqli_eror($con));
        }
          
    

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_administrator";

  }, 1000);
</script>
</body>
</html>