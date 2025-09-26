<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem kehadiran Digital - FGroupIndonesia.</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url();?>/assets/img/favicon.ico" rel="icon">
  <link href="<?=base_url();?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="<?=base_url();?>/assets/css/fonts-googleapis.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url();?>/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=base_url();?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url();?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url();?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url();?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=base_url();?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url();?>/assets/css/style-landing-page.css" rel="stylesheet">

 </head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="<?=base_url(); ?>">kehadiran</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li class="dropdown"><a href="#about"><span>Keuntungan</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="nav-link scrollto" href="#about">Pelajari Lebih Lanjut</a></li>
              <li><a class="nav-link scrollto" href="#team">Dukungan Lain</a></li>
              <li><a class="nav-link scrollto" href="#testimonials">Testimonials</a></li>
              
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#services">Alasan</a></li>
         
          <li><a class="nav-link scrollto" href="#pricing">Pilihan Paket</a></li>
          <li><a class="nav-link scrollto" href="#contact">Hubungi Kami</a></li>
           <li><a class="nav-link scrollto" href="<?=base_url();?>portal/admin">Portal</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links d-flex align-items-center">
        <a href="http://twitter.com/fgroupindonesia" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="http://facebook.com/fgroupindonesia" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="http://instagram.com/fgroup.indonesia" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="http://youtube.com/fgroupindonesia" class="youtube"><i class="bi bi-youtube"></i></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
          <div>
            <h1>Ingin kontrol kehadiran karyawan lebih efisien?</h1>
<h2>Gunakan sistem absensi online kami untuk pengelolaan yang praktis, hemat waktu, dan bantu bisnis Anda berkembang lebih cepat!</h2>

            <a href="<?= base_url();?>portal/register" class="btn-get-started scrollto">Daftar Sekarang</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
          <img src="<?=base_url();?>/assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6" data-aos="zoom-in">
            <img src="<?=base_url();?>/assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex flex-column justify-contents-center" data-aos="fade-left">
            <div class="content pt-4 pt-lg-0">
              <h3>Pelajari Lebih Lanjut</h3>
              <p class="fst-italic">
                Anda perlu menggunakan kehadiran secara digital untuk memudahkan pengelolaan karyawan / tim tanpa kesulitan! 
              </p>
              <ul>
                <li><i class="bi bi-check-circle"></i> Pengelolaan Mudah.</li>
                <li><i class="bi bi-check-circle"></i> Akses Ringan &amp; Cepat.</li>
                <li><i class="bi bi-check-circle"></i> Hemat SDM Impian para pemilik bisnis.</li>
              </ul>
              <p>
                <b>Notes*:</b> <br>
                Bagi kamu yang ingin mencoba gratis bersegeralah untuk mendaftar sebelum <b id="tanggal-limit">Tanggal LIMIT</b>. Sekarang tinggal <span id="count-time">
                <b id="jam-sisa">0</b> jam, <b id="menit-sisa">0</b> menit, <b id="detik-sisa">0</b> detik lagi. Waktu akan cepat Habis...</span>
              </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="row">
          <div data-aos="fade-up" class="col-lg-6 mt-2 mb-tg-0 order-2 order-lg-1">
             <h4>Hanya Disini!</h4>
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item" >
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                  <h4>Keamanan Terbaik</h4>
                  <p>Dengan dashboard khusus terancang dengan keamanan data kehadiran terbaik!</p>
                </a>
              </li>
              <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="100">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                  <h4>Dashboard Komplit &amp; Mudah Dipakai</h4>
                  <p>Teknologi kami menggunakan dirancang lengkap bagi multi entity bisnis.</p>
                </a>
              </li>
              <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="200">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                  <h4>Hemat SDM impian para pemilik bisnis</h4>
                  <p>Tidak perlu khawatir membayar mahal karyawan HRD.</p>
                </a>
              </li>
              <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="300">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">
                  <h4>Kesempatan Terbatas</h4>
                  <p>Quota pendaftaran tiap kawasan memiliki akses bebas 5 data karyawan lho!</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <figure>
                  <img src="<?=base_url();?>/assets/img/features-1.png" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-2">
                <figure>
                  <img src="<?=base_url();?>/assets/img/features-2.png" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-3">
                <figure>
                  <img src="<?=base_url();?>/assets/img/features-3.png" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-4">
                <figure>
                  <img src="<?=base_url();?>/assets/img/features-4.png" alt="" class="img-fluid">
                </figure>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kenapa Harus kehadiran Digital?</h2>
          <p>Ramai orang menggunakan kehadiran dengan menerapkan geolocation dengan keuntungan komplit lainnya!</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
            <div class="icon-box icon-box-pink">
              <div class="icon"><i class="bx bx-doughnut-chart"></i></div>
              <h4 class="title"><a href="">Kemudahan Akses dan Pemantauan Real-time</a></h4>
              <p class="description">Akses cepat memantau kehadiran karyawan secara real-time, memungkinkan respons instan terhadap perubahan dan kebutuhan perusahaan.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Automatisasi Proses kehadiran</a></h4>
              <p class="description">Otomatisasi pencatatan masuk dan keluar hingga perhitungan jam kerja dan cuti, mengurangi potensi kesalahan manusia, memastikan keakuratan data kehadiran.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box icon-box-green">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Laporan dan Analisis Mudah</a></h4>
              <p class="description">Keputusan strategis dapat diambil berdasarkan data yang akurat dan dapat dipercaya.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box icon-box-blue">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Skalabilitas dan Integrasi</a></h4>
              <p class="description">Tingkat skalabilitas yang tinggi dan mudah untuk tiap keterhubungan yang mulus antara berbagai fungsi bisnis.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

   

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="row" data-aos="zoom-in">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Kenali Lebih Lanjut</h3>
            <p>Hubungi kami melalui tombol hijau ini untuk mendapatkan informasi lebih lanjut dan penawaran khusus. Kami siap membantu Anda meningkatkan produktivitas dan efektivitas dalam pengelolaan kehadiran karyawan. Jangan lewatkan kesempatan untuk merubah cara Anda bekerja, gapai segera!</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn btn-green align-middle" href="https://wa.me/c/6285795569337">Kontak Whatsapp</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Testimonials</h2>
          <p>Simak kisah sukses dan pengalaman terbaik dari para pengguna setia kami dalam penggunaan sistem kehadiran digital yang telah meningkatkan efisiensi dan ketertiban dalam pengelolaan kehadiran karyawan.</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Sistem kehadiran web ini telah membawa transparansi dalam proses kehadiran. Karyawan dapat dengan mudah mengakses dan memverifikasi catatan kehadiran mereka sendiri, menciptakan lingkungan kerja yang lebih terbuka dan akuntabel.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="<?=base_url();?>/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Kartinah Sari</h3>
                <h4>OLShop Kartinah</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Fitur integrasi dengan sistem lainnya membuat manajemen sumber daya manusia menjadi lebih efisien. Sistem ini secara otomatis menyinkronkan data kehadiran dengan platform lainnya, menghemat waktu dan mengurangi risiko kesalahan manusiawi.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="<?=base_url();?>/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Nina Safitri</h3>
                <h4>Freelancer UpWork</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Sebagai pengguna baru, saya sangat senang dengan dukungan pelanggan yang diberikan. Tim dukungan sangat responsif dan membantu kami dengan setiap pertanyaan atau kendala yang kami hadapi selama implementasi.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="<?=base_url();?>/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Iwan Saputra</h3>
                <h4>Karyawan Wiraswasta</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                 Saya terkesan dengan fitur pelaporan yang canggih. Dengan sistem ini, kami dapat dengan mudah menganalisis data kehadiran, memonitor keterlambatan, dan membuat keputusan strategis untuk meningkatkan manajemen karyawan.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="<?=base_url();?>/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Pa Ahmat Sandi</h3>
                <h4>CV. Bangunan Tegas</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Pilihan sistem kehadiran web ini memberikan fleksibilitas luar biasa. Kami dapat mengaksesnya dari mana saja, memudahkan kami untuk melacak kehadiran karyawan bahkan saat bepergian.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="<?=base_url();?>/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>Joni Kurniawan</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Dukungan Lainnya</h2>
          <p>Seperti halnya perkembangan industri dan teknologi dan dunia digitalisasi senantiasa perlu untuk maju dalam kontribusi dan sinergi!</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in">
              <div class="pic"><img src="<?=base_url();?>/assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Triawan Munaf</h4>
                <span>Head of Bekraf</span>
                <div class="social">
                  <a href="https://twitter.com/Triawan"><i class="bi bi-twitter"></i></a>
                  <a href="https://www.youtube.com/channel/UCAGA1_v6EB4fUoZVJ5mxJtA"><i class="bi bi-youtube"></i></a>
                  <a href="https://www.instagram.com/triawanmunaf/"><i class="bi bi-instagram"></i></a>
                  <a href="https://id.linkedin.com/in/triawan-munaf-a8781918b"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?=base_url();?>/assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Pevita Pearce</h4>
                <span>Artist</span>
                <div class="social">
                  <a href="https://twitter.com/pevpearce"><i class="bi bi-twitter"></i></a>
                  <a href="https://www.youtube.com/channel/UCO3zGkhRmH3ecpd5-HpYIDg"><i class="bi bi-youtube"></i></a>
                  <a href="https://www.instagram.com/pevpearce/"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.facebook.com/profile.php?id=100044466998072"><i class="bi bi-facebook"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="200">
              <div class="pic"><img src="<?=base_url();?>/assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Benny Moza</h4>
                <span>Content Creator</span>
                <div class="social">
                  <a href="https://www.youtube.com/channel/UC0x-l6AeW65rTVI8z8NsbXg"><i class="bi bi-youtube"></i></a>
                  <a href="https://www.facebook.com/alif.chimeng/"><i class="bi bi-facebook"></i></a>
                  
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Clients</h2>
          <p>Di mana inovasi dan efisiensi bertemu disitulah sistem kehadiran kami digunakan bersama setiap klien yang telah merasakan transformasi dalam manajemen kehadiran dengan sistem ini:</p>
        </div>

        <div class="row no-gutters clients-wrap clearfix wow fadeInUp">

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in">
              <img src="<?=base_url();?>/assets/img/clients/client-1.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in" data-aos-delay="100">
              <img src="<?=base_url();?>/assets/img/clients/client-2.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in" data-aos-delay="150">
              <img src="<?=base_url();?>/assets/img/clients/client-3.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in" data-aos-delay="200">
              <img src="<?=base_url();?>/assets/img/clients/client-4.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in" data-aos-delay="250">
              <img src="<?=base_url();?>/assets/img/clients/client-5.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in" data-aos-delay="300">
              <img src="<?=base_url();?>/assets/img/clients/client-6.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo" data-aos="zoom-in" data-aos-delay="350">
              <img src="<?=base_url();?>/assets/img/clients/client-7.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="client-logo">
              <img src="<?=base_url();?>/assets/img/clients/client-8.png" class="img-fluid" alt="">
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Paket Pilihan</h2>
          <p>Optimalkan efisiensi dan akurasi pengelolaan kehadiran dengan Paket Sistem kehadiran kami yang inovatif! Dengan fitur canggih dan user-friendly, untuk tetap memudahkan Anda dalam melacak dan mengelola kehadiran karyawan. Dapatkan kontrol penuh, laporan real-time, dan integrasi yang mulus dengan Paket Sistem kehadiran berikut:</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="box" data-aos="zoom-in">
              <h3>GRATIS</h3>
              <h4><sup>Rp.</sup>0<span> / bln</span></h4>
              <ul>
                <li>kehadiran Realtime</li>
                <li>Mode Checkpoint</li>
                <li>Quota 5 Karyawan</li>
                <li class="na">Customisasi Checkpoint</li>
                <li class="na">GPS Report</li>
              </ul>
              <div class="btn-wrap">
                <a href="<?=base_url();?>portal/register?type=gratis" class="btn-buy">Daftarkan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
            <div class="box featured" data-aos="zoom-in" data-aos-delay="100">
              <h3>Sederhana</h3>
              <h4><sup>Rp.</sup>50rb<span> / bulan</span></h4>
              <ul>
                <li>kehadiran Realtime</li>
                <li>Mode Checkpoint</li>
                <li>Quota 25 Karyawan</li>
                <li>Customisasi Checkpoint</li>
                <li>GPS Report</li>
                <li class="na">Notifikasi Whatsapp</li>
              </ul>
              <div class="btn-wrap">
                <a href="<?=base_url();?>portal/register?type=sederhana" class="btn-buy">Daftarkan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="200">
              <h3>Developer</h3>
              <h4><sup>Rp.</sup>150rb<span> / bulan</span></h4>
              <ul>
                <li>kehadiran Realtime</li>
                <li>Mode Checkpoint &amp; Global</li>
                <li>Quota 100 Karyawan</li>
                <li>Customisasi Checkpoint</li>
                <li>GPS Report</li>
                <li>Notifikasi Whatsapp</li>
                <li class="na">Integrasi Desktop</li>
                <li class="na">Integrasi Web</li>
                <li class="na">Integrasi Mobile</li>
              </ul>
              <div class="btn-wrap">
                <a href="<?=base_url();?>portal/register?type=developer" class="btn-buy">Daftarkan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="300">
              <span class="advanced">Advanced</span>
              <h3>Ultimate</h3>
              <h4><sup>Rp.</sup>450rb<span> / bulan</span></h4>
              <ul>
                <li>kehadiran Realtime</li>
                <li>Mode Checkpoint &amp; Global</li>
                <li>Quota &gt; 1000 Karyawan</li>
                <li>Customisasi Checkpoint</li>
                <li>GPS Report</li>
                <li>Notifikasi Whatsapp</li>
                <li>Integrasi Desktop</li>
                <li>Integrasi Web</li>
                <li>Integrasi Mobile</li>
              </ul>
              <div class="btn-wrap">
                <a href="<?=base_url();?>portal/register?type=ultimate" class="btn-buy">Daftarkan Sekarang</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Pertanyaan Umum</h2>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Apakah absen digital ini gratis? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Ya, tersedia akun gratis untuk perusahaan bisnis kamu dengan quota 5 data karyawan! Cobalah segera...!
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Apakah absen digital ini memerlukan instalasi aplikasi tambahan? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Tidak ada aplikasi tambahan lain yang diperlukan! Karena semua fitur sudah terangkum dalam portal sistem kehadiran secara terintegrasi menyeluruh.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Bagaimanakah keamanan data yang dimiliki tiap perusahaan terdaftar? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Setiap perusahaan bisnis kamu yang telah terdaftar dan menggunakan akun dalam sistem portal kehadiran ini akan memiliki keamanan data terbaik dan terjamin tanpa efek samping apapun!
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Apakah Saya perlu mengumpulkan data SIUP / NPWP dan legalitas lainnya? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Tidak perlu! Proses ini sangat mudah, dan tidak ribet! Anda cukupmengisi pendaftaran via form dan sudah bisa mendapatkan akses secara online tanpa menyertakan dokumentasi yang ribet, so simple kan?
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Apakah sistem kehadiran ini bisa digunakan oleh pengguna android atau iphone saja? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Kedua pengguna tersebut baik android maupun iphone dapat mengaksesnya dengan baik. Karena sistem portal kehadiran ini menggunakan platform web yang terkini!
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Saya minat menerapkan sistem kehadiran ini bagi seluruh karyawan, tetapi banyak pengguna karyawan yang tidak bisa berbahasa indonesia. Apakah tersedia UI sistem ini yang berbahasa inggris? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Tentu saja tersedia! Dwi bahasa yang disediakan ialah : Bahasa Indonesia &amp; Bahasa Inggris.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kontak Kami</h2>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-right">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Alamat:</h4>
                <p>Jl. Parahyangan Raya no.18, <br>Komp.Panghegar Permai I
Ujung Berung,<br>Bandung 40614, Jawa Barat.</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>training@fgroupindonesia.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Konsultasi Langsung:</h4>
                <p>+62857-9556-9337</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7216165034006!2d107.70070694882023!3d-6.92384366966582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68dd32c77938af%3A0x1b497b5d14a91121!2sFGroupIndonesia!5e0!3m2!1sid!2sid!4v1635273382116!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-left">
            <form id="pesan-wa-form" action="" method="post" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nama Lengkapmu</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Emailmu</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="name">Perihal</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group mt-3">
                <label for="name">Pesanmu</label>
                <textarea class="form-control" name="message" id="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading...</div>
                <div class="error-message"></div>
                <div class="sent-message">Pesanmu telah terkirim. Thanks!</div>
              </div>
              <div class="text-center"><button type="submit">Kirimkan Pesan Ini</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>FGroupIndonesia</h3>
              <p>
                Jl. Parahyangan Raya no.18, Komp.Panghegar Permai I <br>
                Ujung Berung, Bandung 40614, Jawa Barat.<br><br>
                <strong>Whatsapp:</strong> +62857-9556-9337<br>
                <strong>Email:</strong> training@fgroupindonesia.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="https://twitter.com/fgroupindonesia" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://www.facebook.com/fgroupindonesia/" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/fgroup.indonesia/?hl=en" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="https://www.youtube.com/c/FgroupIndonesia" class="google-plus"><i class="bx bxl-youtube"></i></a>
                <a href="https://wa.me/c/6285795569337" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Link Terkait</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/privacy-policy/">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Pelayanan Lainnya</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/pelayanan/kursus-personal/">Kursus Personal</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/pelayanan/sertifikat-komputer/">Sertifikat Komputer</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/pelayanan/training-instansi/">Training Instansi</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/pelayanan/solusi-digital/">Format Komputer</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/pelayanan/solusi-digital/">Pembuatan Software</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://fgroupindonesia.com/pelayanan/solusi-digital/">Konsultasi Pemrograman</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Daftarkan No.Whatsappmu</h4>
            <p>Untuk mendapatkan informasi promosi lain dimomen yang pas sesuai budgetmu!</p>
            <form action="" method="post" id="promosi-wa-form">
              <input type="text" id="daftarkan-wa" name="whatsapp"><input type="submit" value="Kirim">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <?= date('Y'); ?> <strong><span>FGroupIndonesia</span></strong>. All Rights Reserved
      </div>
      <div class="credits" style="display:none;">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/scaffold-bootstrap-metro-style-template/ -->
        Designed by <a href="https://fgroupindonesia.com/">FGroupIndonesia</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=base_url();?>/assets/vendor/aos/aos.js"></script>
  <script src="<?=base_url();?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url();?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=base_url();?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?=base_url();?>/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=base_url();?>/assets/js/main.js"></script>
  <script src="<?=base_url();?>/assets/js/jquery-3.7.1.min.js"></script>
  <script src="<?=base_url();?>/assets/js/landing-page.js"></script>

</body>

</html>