<!-- Hero Section -->
    <section id="hero" class="hero section">
      
      <?php foreach ($rowHome as $key => $row): ?>
        <img width="100" src="admin/uploads/<?php echo $row['image'] ?>" alt="" data-aos="fade-in">


      <div class="container text-center" data-aos="zoom-out" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h2><?php echo $row['title'] ?></h2>
            <p><?php echo $row['description'] ?></p>
            <a href="?page=about" class="btn-get-started">About Me</a>
          </div>
        </div>
      </div>
  <?php endforeach ?>
    </section><!-- /Hero Section --> 