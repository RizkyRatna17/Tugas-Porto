<!-- Hero Section -->
<section id="hero" class="hero section">
  <?php foreach ($rowHome as $key => $row): ?>
    <!-- Background image -->
    <img width="100%" src="admin/uploads/<?php echo $row['image'] ?>" alt="" data-aos="fade-in">

    <div class="container text-center" data-aos="zoom-out" data-aos-delay="100">
      <!-- Foto Profil -->
      <img src="admin/uploads/<?php echo $row['image'] ?>" 
           class="rounded-circle mx-auto d-block mb-3 shadow"
           alt="Foto Profile" 
           style="width:150px; height:150px; object-fit:cover; border: 4px solid #fff;">

      <div class="row justify-content-center mt-3">
        <div class="col-lg-8">
          <h2><?php echo $row['title'] ?></h2>
          <p><?php echo $row['description'] ?></p>
          <a href="?page=about" class="btn-get-started">About Me</a>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</section><!-- /Hero Section -->
