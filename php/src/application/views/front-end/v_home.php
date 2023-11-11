<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Jabar Field Day 2023</h1>
        <!-- <h2 data-aos="fade-up" data-aos-delay="400">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, quaerat.</h2> -->
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Pendaftaran</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="<?= base_url(); ?>assets/img/jbfd2023.jpg" class="img-fluid" alt="">
      </div>
    </div>
  </div>

</section><!-- End Hero -->

<main id="main">
  <!-- ======= About Section ======= -->
  <section id="about" class="about">

    <div class="container" data-aos="fade-up">
      <div class="row gx-0">

        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="content card">
            <h3>Informasi</h3>
            <p>
              <?= $setting->profile; ?>
            </p>
            <div class="text-center text-lg-start">

            </div>
          </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
        <div class="row">
              <!-- <div class="box" data-aos="fade-up" data-aos-delay="200"> -->
                    <video width="320" height="240" controls>
                            <source src="<?= base_url(); ?>assets/img/media2.mp4" type="video/mp4">
                            <source src="<?= base_url(); ?>assets/img/media2.ogg" type="video/ogg">
                      
                          </video>
              <!-- </div> -->
              <!-- <div class="box" data-aos="fade-up" data-aos-delay="200"> -->

                      <img src="<?= base_url(); ?>assets/img/orari-jbfd2023.png" class="img-fluid" alt="">
                      </div>
              <!-- </div> -->
        </div>

      </div>
    </div>

  </section><!-- End About Section -->





  <!-- ======= F.A.Q Section ======= -->
  <section id="services" class="faq">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Juklak</h2>
        <!-- <p>Frequently Asked Questions</p> -->
      </header>

      <div class="row">
        <div class="col-lg-12">
          <!-- F.A.Q List 1-->
          <div class="accordion accordion-flush" id="faqlist1">

          <?php foreach ($layanan as $key => $value) :

              if ($value->status_layanan == "Publish") : ?>

                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?= $value->id_layanan; ?>">
                          <?= $value->judul_layanan; ?>
                      </button>
                    </h2>
                    <div id="faq-content-<?= $value->id_layanan; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                      <div class="accordion-body">
                      <embed src="<?= base_url('assets/img/layanan/') . $value->gambar_layanan; ?>"  class="col-lg-12" height="500" type="application/pdf">
                      <!-- <img src="" alt="" class="img-fluid rounded " style="height: 100px; width:100px;"> -->
                   
                      </div>
                    </div>
                  </div>





              <?php endif; ?>

          <?php endforeach; ?>

           

  

          </div>
        </div>


      </div>

    </div>

  </section><!-- End F.A.Q Section -->


  <!-- ======= Features Section ======= -->
  <section id="features" class="features">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Pendaftaran</h2>
        <hr>
        <p>Yang Harus dipersiapkan</p>
      </header>

      <div class="row">

        <div class="col-lg-6">
          <img src="<?= base_url(); ?>vendor/front-end/assets/img/features.png" class="img-fluid" alt="">
        </div>

        <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
          <div class="row align-self-center gy-4">

            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
              <div class="feature-box d-flex align-items-center">
                <i class="bi bi-check"></i>
                <h3>Lokal</h3>
              </div>
            </div>

            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
              <div class="feature-box d-flex align-items-center">
                <i class="bi bi-check"></i>
                <h3>Callsign</h3>
              </div>
            </div>

            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
              <div class="feature-box d-flex align-items-center">
                <i class="bi bi-check"></i>
                <h3>Penanggung Jawab</h3>
              </div>
            </div>

            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
              <div class="feature-box d-flex align-items-center">
                <i class="bi bi-check"></i>
                <h3>Email</h3>
              </div>
            </div>

            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
              <div class="feature-box d-flex align-items-center">
                <i class="bi bi-check"></i>
                <h3>No Hp</h3>
              </div>
            </div>

            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
              <div class="feature-box d-flex align-items-center">
                <i class="bi bi-check"></i>
                <h3>Jumlah Kontingen</h3>
              </div>
            </div>

          </div>
        </div>

      </div> <!-- / row -->

      <!-- Feature Tabs -->
      <div class="row feture-tabs" data-aos="fade-up">
        <div class="col-lg-12">
          <h3>Ketentuan</h3>

          <!-- Tabs -->
          <ul class="nav nav-pills mb-3">
            <li>
              <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Informasi Biaya</a>
            </li>
            <!-- <li>
              <a class="nav-link" data-bs-toggle="pill" href="#tab2">Misi</a>
            </li>
            <li>
              <a class="nav-link" data-bs-toggle="pill" href="#tab3">Sejarah</a>
            </li> -->
          </ul><!-- End Tabs -->

          <!-- Tab Content -->
          <div class="tab-content">

            <div class="card card-info tab-pane fade show active" id="tab1">
              <p class=""><?= $setting->visi; ?></p>
            </div><!-- End Tab 1 Content -->


          </div>

        </div>

        <!-- <div class="col-lg-6">
          <img src="<?= base_url(); ?>vendor/front-end/assets/img/features-2.png" class="img-fluid" alt="">
        </div> -->

      </div><!-- End Feature Tabs -->

      <!-- Feature Icons -->
      <!-- <div class="row feature-icons" data-aos="fade-up">
        <h3>Ratione mollitia eos ab laudantium rerum beatae quo</h3>

        <div class="row">

          <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
            <img src="<?= base_url(); ?>vendor/front-end/assets/img/features-3.png" class="img-fluid p-4" alt="">
          </div>

          <div class="col-xl-8 d-flex content">
            <div class="row align-self-center gy-4">

              <div class="col-md-6 icon-box" data-aos="fade-up">
                <i class="ri-line-chart-line"></i>
                <div>
                  <h4>Corporis voluptates sit</h4>
                  <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                </div>
              </div>

              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="ri-stack-line"></i>
                <div>
                  <h4>Ullamco laboris nisi</h4>
                  <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                </div>
              </div>

              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                <i class="ri-brush-4-line"></i>
                <div>
                  <h4>Labore consequatur</h4>
                  <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                </div>
              </div>

              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                <i class="ri-magic-line"></i>
                <div>
                  <h4>Beatae veritatis</h4>
                  <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                </div>
              </div>

              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                <i class="ri-command-line"></i>
                <div>
                  <h4>Molestiae dolor</h4>
                  <p>Et fuga et deserunt et enim. Dolorem architecto ratione tensa raptor marte</p>
                </div>
              </div>

              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                <i class="ri-radar-line"></i>
                <div>
                  <h4>Explicabo consectetur</h4>
                  <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div> -->
      <!-- End Feature Icons -->

    </div>

  </section>
  <!-- End Features Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Contact</h2>
        <p>Hubungi Kami</p>
      </header>

      <div class="row gy-4">

        <div class="col-lg-12">

          <div class="row gy-4">
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Ketua Panitia</h3>
                <p>Adhisunu Harimurti <strong>YB1LLF</strong> 08121051115</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Bendahara</h3>
                <p>Kokom Komariah <strong>YF1AYT</strong> 0822-1704-7044</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Sekretaris</h3>
                <p>Elang Erwiana Hermawan RA <strong>YC1CCQ </strong> 0877-2232-6909</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Dana Usaha </h3>
                <p>Neneng Dewi <string>YB1OVY </strong> 0852-2139-1100</p>
              </div>
            </div>
          </div>
   

        </div>

        <div class="col-lg-12">

          <div class="row gy-4">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bi bi-envelope"></i>
                <h3>Email</h3>
                <p>jbfd2023@orarijabar.or.id</p>
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Bendahara</h3>
                <p>Kokom Komariah <strong>YF1AYT</strong> 0822-1704-7044</p>
              </div>
            </div> -->
   
          </div>
   

        </div>

      </div>

    </div>

    

  </section><!-- End Contact Section -->

</main><!-- End #main -->