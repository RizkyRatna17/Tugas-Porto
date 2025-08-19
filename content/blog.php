<?php
$queryBlogs = mysqli_query($koneksi, "SELECT * FROM blogs ORDER BY id DESC");
$rowBlogs = mysqli_fetch_all($queryBlogs, MYSQLI_ASSOC);
?>


<main class="main">

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Blog</h2>
        <p>Dibalik Sebuah Kata Tersimpan Berjuta Arti, Lalu Bagaimana Kamu Mengartikan Kata "Cinta" </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

        <?php foreach ($rowBlogs as $rowBlog): ?>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <div class="post-img position-relative overflow-hidden">
                <img class="card-img-top" style="height:200px; object-fit:cover;" src="admin/uploads/<?php echo $rowBlog['image'] ?>" class="img-fluid" alt="">
                            
             </div>
              <a href="#" class="stretched-link">
                <h3><?php echo $rowBlog['title'] ?></h3>
              </a>
              <p><?php echo $rowBlog['description'] ?></p>
              <br><br>
               <a href="?page=blog-detail&id=<?php echo $rowBlog['id'] ?>"
               class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

         
         <?php endforeach; ?>
        </div>

      </div>

    </section><!-- /Services Section -->

  </main>