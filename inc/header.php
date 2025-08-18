
  <header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="fs-5 fst-italic"><?php echo $rowSetting['name'] ?></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="?page=about">About</a></li>
          <li><a href="?page=resume">Resume</a></li>
          <li><a href="?page=blog">Blog</a></li>
          <li><a href="?page=portofolio">Portfolio</a></li>
          <li><a href="?page=contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="<?php echo $rowSetting['twitter'] ?>" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="<?php echo $rowSetting['fb'] ?>" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="<?php echo $rowSetting['ig'] ?>" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="<?php echo $rowSetting['linkedin'] ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </header>