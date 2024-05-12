  
  <li class="nav-item">
    <a href="../dosen_backend_dasbor" class="nav-link <?php if ($hal=='dasbor') { echo 'active';}?>">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
       Dashboard
      </p>
    </a>
  </li>

 

  <li class="nav-item">
    <a href="../dosen_backend_kelas" class="nav-link <?php if ($hal=='kelas') { echo 'active';} ?>">
      <i class="nav-icon fas fa-qrcode "></i>
      <p>
    QR Absensi
      </p>
    </a>
  </li>

  
  <li class="nav-item">
    <a href="../dosen_backend_laporan" class="nav-link <?php if ($hal=='laporan') { echo 'active';} ?>">
      <i class="fas fa-chart-line"></i>
      <p>
   Grafik Presensi
      </p>
    </a> 
  </li>

 

  <li class="nav-item">
    <a href="../gantipass" class="nav-link <?php if ($hal=='gantipass') { echo 'active';} ?>">
      <i class="nav-icon fas fa-lock"></i>
      <p>
      Ganti Password
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../auth/logout.php" class="nav-link">
      <i class="nav-icon fas fa-sign-out-alt "></i>
      <p>
      Keluar
      </p>
  </a>
  </li>