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
      
      if (isset($_POST['ganti_pw']))
      {
        $id = trim(mysqli_real_escape_string($con, $_POST['id']));
        $password = trim(mysqli_real_escape_string($con, $_POST['password']));
        $enc_password = SHA1($password);
        $newpassword      = trim(mysqli_real_escape_string($con, $_POST['newpassword']));
        $cpassword   = trim(mysqli_real_escape_string($con, $_POST['cnewpassword']));


        $query_pengguna = mysqli_query($con, "SELECT * FROM tb_pengguna WHERE id='$id'") or die (mysqli_error($con));
        $data = mysqli_fetch_assoc($query_pengguna);
        $passworddb = $data['pass'];

        if ($enc_password == $passworddb) {
          if ($newpassword !== $cpassword){
            echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Chek Password", "Confirmasi New Password tidak sesuai!", "warning");
                setTimeout(function(){ 
                window.location.href = "../gantipwd";
                }, 2000);
            </script>
            ';
          } else
          {
            $pass  = sha1($cpassword);
  
            mysqli_query($con, "UPDATE tb_pengguna SET pass='$pass' WHERE id='$id'") or die (mysqli_error($con));
            
            echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Berhasil", "Password berhasil diganti!", "success");
                setTimeout(function(){ 
                window.location.href = "../auth/logout.php";
                }, 2000);
            </script>
            ';
          }          
        } else {
          echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Password Salah!", "Silahkan hubungi Admin untuk reset Password jika lupa", "warning");
                setTimeout(function(){ 
                window.location.href = "../gantipwd";
                }, 5000);
            </script>
            ';

        }
        
      }
      
    ?>


</script> 
</body>
</html>