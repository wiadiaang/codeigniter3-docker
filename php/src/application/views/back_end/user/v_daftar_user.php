<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title; ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><?= $title; ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title"><?= $title; ?></h2>
      <p class="section-lead">
        <?= $title; ?>
      </p>

      <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h4><?= $title; ?></h4>
              <div class="float-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-fw fa-plus"></i> Tambah User</button>
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
                      <th class="text-center">Email</th>
                      <th class="text-center">Lokal</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $key => $value) : ?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-left"><?= $value->nama; ?></td>
                        <td class="text-left"><?= $value->callsign; ?></td>
                        <td class="text-left"><?= $value->email; ?></td>
                        <td class="text-left"><?= $value->nama_lokal; ?></td>
                        <td class="text-center">
                          <?php if ($value->role_id != 1) : ?>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $value->id_user; ?>">
                              <i class="fas fa-fw fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $value->id_user; ?>"><i class="fas fa-trash"></i> Hapus</button>
                            <?php else : ?>
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $value->id_user; ?>">
                              <i class="fas fa-fw fa-edit"></i> Edit
                            </button>

                          <?php endif; ?>
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
<!-- edit Modal -->
<?php
foreach ($users as $key => $value) : ?>
  <div class="modal fade" id="edit<?= $value->id_user; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="<?= base_url('user/edituser/' . $value->id_user); ?>">
            <div class="form-group">
              <label for="name">Nama Lengkap</label>
              <input id="name" type="text" class="form-control" name="name" tabindex="1" autofocus value="<?= $value->nama; ?>" readonly>
              <small class="text-danger "><?= form_error('nama') ?></small>
            </div>
            <div class="form-group">
            <label for="callsign">Callsign</label>
            <input id="callsign" type="callsign" class="form-control" name="callsign"   value="<?= $value->callsign; ?>" tabindex="1" required>
            <small class="text-danger "><?= form_error('callsign') ?></small>
          </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="text" class="form-control" name="email" tabindex="1" autofocus value="<?= $value->email; ?>" readonly>
              <small class="text-danger "><?= form_error('email') ?></small>
            </div>

            <div class="form-group">
            <label for="role_id">Lokal</label>
            <select name="lokal" class="form-control selectric">
            <option value="">-- pilih salah satu --</option>
            <?php 
            
                foreach ($lokal as $key => $values) :  if ($value->local  == $values->id_lokal) { ?>


                <option value="<?= $values->id_lokal; ?>" selected><?= $values->nama_lokal; ?></option>
                <?php  } else {  ?>
                  <option value="<?= $values->id_lokal; ?>" ><?= $values->nama_lokal; ?></option>
           

            
           


              <?php  } ?>

              <?php endforeach; ?>
                      
            </select>
          </div>

            <div class="form-group">
              <div class="d-block">
                <label for="password" class="control-label">Password</label>
              </div>
              <input id="password" type="password" class="form-control" name="password" tabindex="2" readonly>
              <small class="text-danger "><?= form_error('password') ?></small>
            </div>



            <div class="form-group">
              <label for="role_id">Level</label>
              <select name="role_id" class="form-control">
              <?php
            
              if ($value->role_id == 1) { ?>

              <option value="1" selected >Admin</option>
              <option value="2">Staff Lokal</option>
               
              <?php  } else {  ?>
            
               <option value="1"  >Admin</option>
               <option value="2" selected>Staff Lokal</option>
              <?php  } ?>
            
           
              
                
              </select>
            </div>

            <div class="form-group">
              <label for="is_active">Aktivasi</label>
              <select name="is_active" class="form-control">
              <?php
           
              if ($value->is_active == 1) { ?>
                <option value="1" selected >Aktif</option>
                <option value="0">Tidak Aktif</option>
             <?php } else { ?>
              <option value="1">Aktif</option>
              <option value="0" selected>Tidak Aktif</option>
             <?php } ?>
             
               
               
               
              </select>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- edit Modal -->
<?php
foreach ($users as $key => $value) : ?>
  <div class="modal fade" id="hapus<?= $value->id_user; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title mr-1">Menghapus Akun <h6 class="text-center badge badge-danger"><?= $value->nama; ?></h6>
          </h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="<?= base_url('user/hapus/' . $value->id_user); ?>">
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


<!-- Tambah Data Modal -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?= base_url('user/adduser'); ?>" class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input id="name" type="text" class="form-control" name="name" tabindex="1" autofocus required>
            <small class="text-danger "><?= form_error('name') ?></small>
          </div>
          <div class="form-group">
            <label for="callsign">Callsign</label>
            <input id="callsign" type="callsign" class="form-control" name="callsign" tabindex="1" required>
            <small class="text-danger "><?= form_error('callsign') ?></small>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" tabindex="1" required>
            <small class="text-danger "><?= form_error('email') ?></small>
          </div>
          <div class="form-group">
            <label for="role_id">Lokal</label>
            <select name="lokal" class="form-control selectric" tabindex="1">
                      <option value="">-- pilih salah satu --</option>
                      <?php foreach ($lokal as $key => $value) : ?>
                        <option value="<?= $value->id_lokal; ?>"><?= $value->nama_lokal; ?></option>
                      <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" tabindex="1" required>
            <small class="text-danger "><?= form_error('password') ?></small>
          </div>
          <div class="form-group">
            <label for="role_id">Level</label>
            <select name="role_id" class="form-control">
              <option value="1">Admin</option>
              <option value="2">Staff Lokal</option>
            </select>
          </div>

          <div class="form-group">
            <label for="is_active">Aktivasi</label>
            <select name="is_active" class="form-control">
              <option value="1">Active</option>
              <option value="0">Non-Active</option>
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