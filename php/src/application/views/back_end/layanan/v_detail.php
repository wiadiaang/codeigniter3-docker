<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="<?= base_url('layanan'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1><?= $subtitle; ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?= base_url('layanan'); ?>">Daftar Lomba</a></div>
        <div class="breadcrumb-item"><?= $subtitle; ?></div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title"><?= $subtitle; ?></h2>
      <p class="section-lead">
      </p>

      <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h4><?= $title; ?></h4>
              <div class="float-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-fw fa-plus"></i> Tambah Peserta</button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="example1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        No
                      </th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Callsign</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($layanan as $key => $value) : ?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-left"><?= $value->nama_staff; ?></td>
                        <td class="text-left"><?= $value->callsign; ?></td>
                
           
                        <td class="text-center">
                
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $value->id_ikut_lomba; ?>"><i class="fas fa-trash"></i> Hapus</button>
           
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<!-- Tambah Data Modal -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?= base_url('layanan/addPeserta'); ?>" class="needs-validation" novalidate>
        <div class="modal-body">
   
          <div class="form-group">
            <label for="role_id">Peserta</label>
            <input type="hidden" name="id_layanan" value="<?= $id_layanan; ?>">
            <select name="peserta" class="form-control selectric" tabindex="1" required >
                      <option value="">-- pilih salah satu --</option>
                      <?php foreach ($peserta_lokal as $key => $value) : ?>
                        <option value="<?= $value->id_staff; ?>"><?= $value->nama_staff; ?> <?= $value->callsign; ?></option>
                      <?php endforeach; ?>
            </select>
          </div>
     
      

        

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary ">Simpan</button>
      </form>
    </div>
  </div>
</div>


</div>

<?php
foreach ($layanan as $key => $value) : ?>
  <div class="modal fade" id="hapus<?= $value->id_ikut_lomba; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title mr-1">Menghapus Akun <h6 class="text-center badge badge-danger"><?= $value->nama_staff; ?></h6>
          </h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="<?= base_url('layanan/hapus_peserta/' . $value->id_ikut_lomba."/". $value->id_lomba); ?>">
            <h5>Apakah Anda Yakin?</h5>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>