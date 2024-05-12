  
  <li class="nav-item">
    <a href="../mhs_backend_dasbor" class="nav-link <?php if ($hal=='dasbor') { echo 'active';} ?>">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
       Dashboard
      </p>
    </a>

    <li class="nav-item">
    <a href="../manualbook" class="nav-link <?php if ($hal=='manualbook') { echo 'active';} ?>">
      <i class="nav-icon fas fa-file-pdf"></i>
      <p>
       Manual Book
      </p>
    </a>
  </li>

  
  <li class="nav-item">
    <a href="../mhs_backend_presensi" class="nav-link <?php if ($hal=='presensi') { echo 'active';} ?>">
      <i class="nav-icon fas fa-qrcode "></i>
      <p>
      Presensi
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../mhs_backend_kelas" class="nav-link <?php if ($hal=='kelasmatkul') { echo 'active';} ?>">
      <i class="nav-icon fas fa-book"></i>
      <p>
       Rekap Presensi
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