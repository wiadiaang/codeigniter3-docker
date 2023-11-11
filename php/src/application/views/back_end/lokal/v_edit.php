<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="<?= base_url('lokal'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1><?= $subtitle; ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?= base_url('lokal'); ?>">Daftar Lokal</a></div>
        <div class="breadcrumb-item"><?= $subtitle; ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title"><?= $subtitle; ?></h2>
      <p class="section-lead">
        Di halaman ini Anda dapat mengedit <strong><?= $client->nama_lokal; ?></strong>
      </p>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Lokal</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="<?= base_url('lokal/edit/' . $client->id_lokal); ?>" enctype="multipart/form-data">
                <div class="row">
                  <div class="form-group col-lg-4 col-sm-12 col-md-12">
                    <label class="">Nama Lokal</label>
                    <input type="text" class="form-control" name="name" autofocus value="<?= $client->nama_lokal; ?>">
                    <small class="text-danger "><?= form_error('name') ?></small>
                  </div>
           
                  <div class="form-group col-lg-4 col-sm-12 col-md-12">
                    <label class="">Callsign</label>
                    <input type="text" class="form-control" name="callsign" value="<?= $client->callsign; ?>">
                    <small class="text-danger "><?= form_error('callsign') ?></small>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-floatings">
                    <label for="keywords">Alamat</label>
                    <textarea class="form-control" name="alamat" placeholder="Isi Alamat" id="floatingTextarea2" style="height: 60px; resize: none;"><?= $client->alamat; ?></textarea>
                    <small class="text-danger "><?= form_error('alamat') ?></small>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary ">Edit Lokal</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>