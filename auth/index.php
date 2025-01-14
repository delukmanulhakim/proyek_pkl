<?php 
require_once "../database/config.php"; ?>
<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Sisfo Presensi Mahasiswa | Univ Peradaban</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="styles/app.min.css"/>
  <link rel="shortcut icon" href="img/logo-peradaban.png?>">

</head>

<body class="page-loading">
  <!-- page loading spinner -->
  <div class="pageload">
    <div class="pageload-inner">
      <div class="sk-rotating-plane"></div>
    </div>
  </div>
  <!-- /page loading spinner -->
  <div class="app signin v2 usersession">
    <div class="session-wrapper">
      <div class="session-carousel slide" data-ride="carousel" data-interval="3000">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active" style="background-image:url(img/foto3.jpg);background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
          </div>
           <div class="item" style="background-image:url(img/foto1.jpg);background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
          </div>
          <div class="item" style="background-image:url(img/foto2.jpeg);background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
          </div>
        </div>
      </div>
      <div class="card bg-white  blue no-border" style="background-color:#ffffff;">
        <div class="card-block">
          <form role="form" class="form-layout" action="" method="post">
            <div class="text-center m-b">    

              <img src="img/logo-peradaban.png?>" style='width:300px; height:100px;'/> 
              <h4 class="text-uppercase"><b><font color="#000000">SISTEM PRESENSI MAHASISWA</font></b></h4>
              <h4 class="text-uppercase"><font color="#000000">UNIVERSITAS PERADABAN</font></h4>
            </div>
            <div class="form-inputs p-b">
              <label class="text-uppercase"><font color="#000000">Username</font></label>
              <input type="username" class="form-control input-lg" name="username" id="username" placeholder="input username" required>
              <label class="text-uppercase"><font color="#000000">Password</font></label>
              <input type="password" class="form-control input-lg" name="password" id="password"  placeholder="input password" required>
              <!-- <a href="lupapassword.php"><font color="#ffffff">Lupa Password?</font></a>
             --></div>
              
               <button class="btn btn-warning btn-block btn-lg" type="submit" name= "login" style="background-color:#86090f;"><font color="#ffffff"><img src="img/personkey-white.png">&nbsp<b>Login</b></font></button> 
               <?php 
                        if(isset($_POST['login']))
                        {

                         $username = trim(mysqli_real_escape_string($con, $_POST['username']));
                         $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
                         $sql_login = mysqli_query($con, "SELECT * FROM tb_pengguna WHERE username = '$username' AND pass = '$password'") or die(mysqli_error($con));
                        
                           if(mysqli_num_rows($sql_login) > 0 )
                           {
                              $datanya = mysqli_fetch_assoc($sql_login);
                              if($datanya['peran']=="admin" )
                              {
                                session_start();
                                $_SESSION['user'] = $username;
                                $_SESSION['id'] = $datanya['id'];
                                $_SESSION['peran'] = $datanya['peran'];
                                $_SESSION['nama'] = $datanya['nama'];
                                echo "<script>window.location='../admin_backend_dasbor';</script>";
                              }
                              
                              elseif($datanya['peran']=="dosen" )
                              {
                                session_start();
                                $_SESSION['user'] = $username;
                                $_SESSION['id'] = $datanya['id'];
                                $_SESSION['peran'] = $datanya['peran'];
                                $_SESSION['nama'] = $datanya['nama'];
                                echo "<script>window.location='../dosen_backend_dasbor';</script>";
                              }
                              
                              elseif($datanya['peran']=="mhs" )
                              {
                                session_start();
                                $_SESSION['user'] = $username;
                                $_SESSION['id'] = $datanya['id'];
                                $_SESSION['peran'] = $datanya['peran'];
                                $_SESSION['nama'] = $datanya['nama'];
                                echo "<script>window.location='../mhs_backend_dasbor';</script>";
                              }
                               else
                               {

                               }
                      
                           }
                           else
                           {
                             echo "<script>window.location='../gagal';</script>"; 
                              
                           }
                        }

                      ?>
          <br>
          <center><font color="#000000"><small><em> Copyright &copy; Universitas Peradaban </a></em></</small></font>
          <br/>  
           <font color="#000000"><?php echo date("Y"); ?></</small></font>
            </center>
          </form>
          

        </div>
      </div>
    </div>
  </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="scripts/app.min.js"></script>
</body>

</html>
