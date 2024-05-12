  <nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background-color:#86090f;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>  [ <?php echo $_SESSION['peran']; ?> - ] Assalamu'alaikum, <?php echo $_SESSION['nama']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="../manualbook" class="dropdown-item">
            <i class="fas fa-book"></i> Manual book
          </a>
          <div class="dropdown-divider"></div>
          <a href="../gantipass" class="dropdown-item">
            <i class="fas fa-lock"></i> Ganti Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="../auth/logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt "></i> Keluar
          </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-red elevation-4" style="background-color:white;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../img/logoperadaban.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .9; background-color:white">
      <span class="brand-text font-weight-light"><b>PRESENSI MHS</b></span>
    </a>
