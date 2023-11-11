<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="">JBFD2023
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">JBFD</a>
    </div>
    <ul class="sidebar-menu">

      <li class="nav-item">
        <a href="<?= base_url('dashboard'); ?>" class="nav-link "><i class="fas fa-home"></i> <span>Dashoard</span></a>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Pengguna</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link beep beep-sidebar" href="<?= base_url('user/profile'); ?>">Profile</a></li>
          <?php if ($user['role_id'] == 1) : ?>
            <li><a class="nav-link" href="<?= base_url('user/daftar_user'); ?>">Pengguna</a></li>
          <?php endif; ?>
        </ul>
      </li>
      <?php if ($user['role_id'] == 1) : ?>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tie"></i> <span>Lokal</span></a>
        <ul class="dropdown-menu">
         
            <li><a class="nav-link beep beep-sidebar" href="<?= base_url('lokal/tambahlokal'); ?>">Menambah Lokal</a></li>
       
          <li><a class="nav-link" href="<?= base_url('lokal'); ?>">Daftar Lokal</a></li>
        </ul>
      </li>
      <?php endif; ?>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Peserta</span></a>
        <ul class="dropdown-menu">
          <?php if ($user['role_id'] == 2) :
               $peserta = $this->db->get_where('tb_staff', array('id_lokal'=>$user['local']))->num_rows(); 
               if ($peserta == 10) {

               }else{ ?>

<li><a class="nav-link beep beep-sidebar" href="<?= base_url('peserta/tambahpeserta'); ?>">Tambah Peserta</a></li>

              <?php }

           
             ?>


           
          <?php endif; ?>
          <li><a href="<?= base_url('peserta'); ?>">Daftar Peserta</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-holding-usd"></i> <span>Lomba</span></a>
        <ul class="dropdown-menu">
        <?php if ($user['role_id'] == 1) : ?>
          <li><a class="nav-link beep beep-sidebar" href="<?= base_url('layanan/tambah'); ?>">Tambah Lomba</a></li>
        <?php endif; ?>
          <li><a class="nav-link " href="<?= base_url('layanan'); ?>">Daftar Lomba</a></li>
        </ul>
      </li>
      <!-- <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-briefcase"></i> <span>Portfolio</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link beep beep-sidebar" href="<?= base_url('portfolio/tambah'); ?>">Menambah Portfolio</a></li>
          <li><a class="nav-link" href="<?= base_url('portfolio'); ?>">Daftar Portfolio</a></li>
        </ul>
      </li> -->
      <?php if ($user['role_id'] == 1) : ?>
      <li class="menu-header">Artikel</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i> <span>Berita</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link beep beep-sidebar" href="<?= base_url('berita/tambah'); ?>">Tulis Berita</a></li>
          <li><a class="nav-link " href="<?= base_url('berita'); ?>">Daftar Berita</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-tags"></i> <span>Kategori</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link " href="<?= base_url('kategori/kategoriberita'); ?>">Kategori Berita</a></li>
          <?php // if ($user['role_id'] == 1) : ?>
            <!-- <li><a class="nav-link " href="<?= base_url('kategori/kategoristaff'); ?>">Kategori Staff</a></li>
            <li><a class="nav-link " href="<?= base_url('kategori/kategoriclient'); ?>">Kategori Client</a></li> -->
          <?php // endif; ?>
        </ul>
      </li>
      <li class="nav-item">
       
          <hr>
          <a href="<?= base_url('settings'); ?>" class="nav-link"><i class="fas fa-cog"></i> <span>Settings</span></a>
     
      </li>
      <?php endif; ?>
      <hr>
      <li class="nav-item">
        <a href="<?= base_url('auth/logout'); ?>" class="nav-link bg-danger"><i class="fas fa-sign-out-alt text-white"></i> <span class="text-light">Keluar</span></a>
      </li>
    </ul>
  </aside>
</div>