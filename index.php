<?php
session_start(); // TAMBAHAN: Mulai session
// Sertakan file koneksi database di bagian paling atas
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Biodiversity Tourism Center Fundraising</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="assets/img/logo btcf.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo-btcf.svg" alt="" class="sitelogo">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#products">Products</a></li>
          <li><a href="#scope">Our Scope</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#activity">Activity</a></li>
          <li><a href="#contact">Contact</a></li>
          
          <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
             <li><a href="admin.php" style="color: #ffc107;">Admin Panel</a></li>
          <?php endif; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <?php if(isset($_SESSION['role'])): ?>
          <a class="cta-btn" href="logout.php">Logout</a>
      <?php else: ?>
          <a class="cta-btn" href="login.php">Login</a>
      <?php endif; ?>

    </div>
  </header>

  <main class="main">

    <section id="hero" class="hero section dark-background">

      <img src="assets/img/sawit.jpg" alt="" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100" class="text-center">True Legacy is Not Built from What We Extract, But from What We Protect</h2>
        <p data-aos="fade-up" data-aos-delay="200" class="text-center">We transform biodiversity conservation into lasting impact through responsible tourism, research, and community empowerment</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="#products" class="btn-get-started">View Products</a>
          <a href="https://youtu.be/gRwqy9HKrOE?si=WBUK557eGdpuaGe7" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div>
      </div>

    </section><section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3>About BTCF</h3>
            <p><strong>Biodiversity Tourism Center and Fundraising (BTCF)</strong> advances conservation through responsible tourism by protecting biodiversity, empowering communities, and turning high conservation value areas into sustainable destinations. At BTCF, we connect conservation, communities, and responsible tourism to safeguard biodiversity for future generations. Join us in creating measurable impact through research, education, and community-driven conservation</p>
            
            <h4 class="mt-4"><strong>Vision</strong></h4>
            <p>To become a leading institution within Universitas Asa Indonesia, internationally recognized for advocating the utilization of High Conservation Value (HCV) areas in oil palm plantations through the development of responsible biodiversity tourism, supporting conservation, community well-being, and long-term sustainability. </p>
            
            <h4 class="mt-4"><strong>Our Mission</strong></h4>
            <ul>
              <li><i class="bi bi-check-circle-fill"></i> <span>To build strategic collaborations between ASAINDO, the oil palm industry, and key stakeholders to advance sustainable biodiversity tourism.</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>To develop national and international advocacy and partnerships for the responsible utilization of High Conservation Value (HCV) areas.</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>To mobilize sustainable external funding for applied research, institutional development, and community empowerment.</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>To strengthen ASAINDO's reputation and visibility at the national and international levels.</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>To develop adaptive, globally competitive human resources to support biodiversity tourism for the conservation of biodiversity and the well-being of communities.</span></li>
            </ul>
          </div>
          
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <img src="assets/img/logo-btcf.svg" class="img-fluid rounded-4" alt="" style="height: 650px; object-fit: cover;">
          </div>
        </div>

      </div>

    </section><section id="products" class="products section">

      <div class="container section-title" data-aos="fade-up">
        <h2>PRODUCTS</h2>
        <p>See Our Products<br></p>
      </div><div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <?php
          // Mengambil data dari database
          $sql = "SELECT * FROM products ORDER BY created_at DESC";
          $result = $conn->query($sql);
          $count = 0;

          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $count++;
                $hiddenClass = ($count > 3) ? 'more-products' : '';
                $styleAttr = ($count > 3) ? 'style="display:none;"' : '';
                
                $delay = 100 + ($count * 100); 
                if ($delay > 600) $delay = 200; 
          ?>

          <div class="col-xl-4 col-md-6 <?= $hiddenClass ?>" <?= $styleAttr ?> data-aos="zoom-in" data-aos-delay="<?= $delay ?>">
            <div class="products-item">
              <div class="img">
                <img src="assets/img/<?= htmlspecialchars($row['prod_img']) ?>" class="img-fluid" alt="<?= htmlspecialchars($row['prod_name']) ?>" style="width:100%; height:250px; object-fit:cover;">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-box-seam"></i> 
                </div>
                <a href="#">
                  <h3><?= htmlspecialchars($row['prod_name']) ?></h3>
                </a>
                <p><?= htmlspecialchars($row['prod_desc']) ?></p>

                <div class="mt-3">
                    <?php if(!empty($row['prod_link'])): ?>
                        <a href="<?= htmlspecialchars($row['prod_link']) ?>" target="_blank" class="btn btn-primary btn-sm w-100 rounded-pill">
                            Daftar Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-sm w-100 rounded-pill" disabled>Info Belum Tersedia</button>
                    <?php endif; ?>
                </div>
                </div>
            </div>
          </div><?php 
            } 
          } else {
              echo '<div class="col-12 text-center"><p>Belum ada produk yang diupload.</p></div>';
          }
          ?>

        </div>

        <div class="text-center mt-4" data-aos="fade-up">
          <button id="products-toggle" class="btn btn-success" data-expanded="false">See more</button>
        </div>

      </div>

    </section>
    
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="assets/img/logo-btcf.svg" class="img-fluid" alt="">
          </div><div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="assets/img/logo-btcf.svg" class="img-fluid" alt="">
          </div><div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="assets/img/logo-btcf.svg" class="img-fluid" alt="">
          </div><div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="assets/img/logo-btcf.svg" class="img-fluid" alt="">
          </div><div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="assets/img/logo-btcf.svg" class="img-fluid" alt="">
          </div><div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="assets/img/logo-btcf.svg" class="img-fluid" alt="">
          </div></div>

      </div>

    </section><section id="scope" class="scope section">

      <div class="container">

        <h2 class="scope-title" data-aos="fade-up" data-aos-delay="50">Our Scope</h2>

        <ul class="nav nav-tabs d-flex flex-nowrap" data-aos="fade-up" data-aos-delay="100">
          <li class="nav-item flex-fill">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#scope-tab-1">
              <i class="bi bi-binoculars"></i>
              <h4 class="d-none d-lg-block">Capacity Building and Human Resource Development</h4>
            </a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#scope-tab-2">
              <i class="bi bi-box-seam"></i>
              <h4 class="d-none d-lg-block">Community-Based Biodiversity Tourism Development</h4>
            </a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#scope-tab-3">
              <i class="bi bi-brightness-high"></i>
              <h4 class="d-none d-lg-block">Research and Knowledge Developmenta</h4>
            </a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#scope-tab-4">
              <i class="bi bi-command"></i>
              <h4 class="d-none d-lg-block">Dissemination, Communication, and Outreach</h4>
            </a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#scope-tab-5">
              <i class="bi bi-gear"></i>
              <h4 class="d-none d-lg-block">Advocacy and Policy Engagement</h4>
            </a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#scope-tab-6">
              <i class="bi bi-graph-up"></i>
              <h4 class="d-none d-lg-block">Industry and Multi-Stakeholder Partnerships</h4>
            </a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#scope-tab-7">
              <i class="bi bi-puzzle"></i>
              <h4 class="d-none d-lg-block">Fundraising and Resource Mobilization</h4>
            </a>
          </li>
        </ul><div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="scope-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Capacity Building and Human Resource Development</h3>
                <p>
                  Designing and delivering training, certification, and competency development programs in biodiversity tourism for professionals, students, local communities, and industry practitioners.
                </p>
                <p>
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-1.jpg" alt="" class="img-fluid">
              </div>
            </div>  
          </div>

          <div class="tab-pane fade" id="scope-tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Community-Based Biodiversity Tourism Development</h3>
                <p>
                  Facilitating community empowerment initiatives, including tourism product development, guiding, homestays, interpretation, and local entrepreneurship linked to biodiversity conservation
                </p>
                <p class="fst-italic">
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-2.jpeg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="scope-tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Research and Knowledge Development</h3>
                <p>
                  Conducting applied research, assessments, and policy-oriented studies on biodiversity tourism, 
                  particularly in High Conservation Value (HCV) areas of oil palm plantations.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-3.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="scope-tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Dissemination, Communication, and Outreach</h3>
                <p>
                  Promoting public awareness through publications, digital platforms, media engagement, and knowledge 
                  dissemination to enhance visibility and impact at national and international levels.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-4.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="scope-tab-5">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Advocacy and Policy Engagement</h3>
                <p>
                  Supporting advocacy initiatives and contributing evidence-based 
                  recommendations at local, national, and international levels to promote sustainable and responsible utilization of HCV areas.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-5.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="scope-tab-6">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Industry and Multi-Stakeholder Partnerships</h3>
                <p>
                  Building strategic collaborations with the oil palm industry, 
                  government institutions, NGOs, donors, and international organizations to implement biodiversity tourism initiatives
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-6.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="scope-tab-7">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Fundraising and Resource Mobilization</h3>
                <p>
                  Mobilizing and managing sustainable funding to support conservation programs, applied research, 
                  community development, and institutional strengthening of ASAINDO.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/scope/scope-7.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><section id="researches" class="researches section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Researches</h2>
        <p>CHECK OUR RESEARCHES</p>
      </div><div class="container">

        <div class="row gy-4">

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="researches d-flex position-relative h-100">
              <i class="bi bi-briefcase icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Lorem Ipsum</a></h4>
                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
              </div>
            </div>
          </div><div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="researches d-flex position-relative h-100">
              <i class="bi bi-card-checklist icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Dolor Sitema</a></h4>
                <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
              </div>
            </div>
          </div><div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="researches d-flex position-relative h-100">
              <i class="bi bi-bar-chart icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Sed ut perspiciatis</a></h4>
                <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
              </div>
            </div>
          </div><div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="researches d-flex position-relative h-100">
              <i class="bi bi-binoculars icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Magni Dolores</a></h4>
                <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
              </div>
            </div>
          </div><div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="researches d-flex position-relative h-100">
              <i class="bi bi-brightness-high icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Nemo Enim</a></h4>
                <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
              </div>
            </div>
          </div><div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="researches d-flex position-relative h-100">
              <i class="bi bi-calendar4-week icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Eiusmod Tempor</a></h4>
                <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
              </div>
            </div>
          </div></div>

      </div>

    
    <section id="activity" class="activity section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Activity</h2>
        <p>CHECK OUR ACTIVITY</p>
      </div><div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="activity-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Training and Workshops</li>
            <li data-filter=".filter-product">Conference and Seminars</li>
            <li data-filter=".filter-branding">Comunity Empowerement</li>
            <li data-filter=".filter-books">Research Collaborations</li>
          </ul><div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 activity-item isotope-item filter-app">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="App 1" data-gallery="activity-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-product">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Product 1" data-gallery="activity-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-branding">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Branding 1" data-gallery="activity-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-books">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Branding 1" data-gallery="activity-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-app">
              <div class="activity -content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="App 2" data-gallery="activity-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-product">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Product 2" data-gallery="activity-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-branding">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Branding 2" data-gallery="activity-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-books">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Branding 2" data-gallery="activity-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activityq-item isotope-item filter-app">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="App 3" data-gallery="activity-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-product">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Product 3" data-gallery="activity-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-branding">
              <div class="activity-content h-100">
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Branding 2" data-gallery="activity-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 activity-item isotope-item filter-books">
              <div class="activity-content h-100"> x 
                <img src="" class="img-fluid" alt="">
                <div class="activity-info">
                  <a href="" title="Branding 3" data-gallery="activity-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="activity-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div></div></div>

      </div>

<section id="team" class="team section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>CHECK OUR TEAM</p>
      </div>

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="pic">
                <img src="assets/img/team/team-1.png" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Dr. Lenny Yusrini, S.E., M.Si. </h4>
                <span>Director</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="pic">
                <img src="assets/img/team/team-2.png" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Nova Eviana, S.S., M.Pd.</h4>
                <span>Researcher</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="pic">
                <img src="assets/img/team/team-3.png" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Roby Darmadi, S.Kom., M.M.</h4>
                <span>Researcher</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <div class="pic">
                <img src="assets/img/team/team-4.png" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Revalino Tobing, S.E., M.Par.</h4>
                <span>Tour Guiding Specialist</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="member">
              <div class="pic">
                <img src="assets/img/team/team-5.png" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>M. Iqbal</h4>
                <span>IT Support</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
         
    </section>
    </section><section id="contact" class="contact section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Reach Us</p>
      </div><div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Jl. Raya Kalimalang No.2A, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13620</p>
                </div>
              </div><div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+62-812-9810-3200</p>
                </div>
              </div><div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>btcf@asaindo.ac.id</p>
                </div>
              </div></div>
          </div>

          <div class="col-lg-6">
            <div class="map-container" data-aos="fade-up" data-aos-delay="500" style="border-radius: 8px; overflow: hidden; box-shadow: 0px 0 25px rgba(0, 0, 0, 0.1); height: 400px;">
              <iframe src="https://maps.google.com/maps?width=600&height=400&hl=en&q=ASAINDO%20University%20Kampus%20B&t=&z=14&ie=UTF8&iwloc=B&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div></div>

      </div>

    </section></main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4 justify-content-center">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">BTCF</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jalan Raya Kalimalang No. 2A</p>
            <p>Jakarta Timur 13620</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62-812-9810-3200</span></p>
            <p><strong>Email:</strong> <span>btcf@asaindo.ac.id</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#products">Products</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#scope">Scope</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#team">Team</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Trainings and Workshops</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Conference and Seminars</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Community Empowerment</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Sustainable Biodiversity Tourism Planning</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Research Collaborations</a></li>
          </ul>
        </div>

        
      </div>
    </div>

    

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>