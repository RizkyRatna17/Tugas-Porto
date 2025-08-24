<?php 
$queryAbout = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
$rowAbout = mysqli_fetch_assoc($queryAbout);

?>




    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            <img src="admin/uploads/<?php echo $rowAbout['image'] ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 content">
            <h2><?php echo $rowAbout['title'] ?></h2>
            <p class="fst-italic">
              <?php echo $rowAbout['content'] ?>
            </p>
            <div class="row py-3" >
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span><?php echo $rowAbout['birthday'] ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span><?php echo $rowAbout['website'] ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span><?php echo $rowAbout['phone'] ?></span></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul>
                    
                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span><?php echo $rowAbout['address'] ?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span><?php echo $rowAbout['degree'] ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><?php echo $rowAbout['email'] ?></span></li>
                </ul>
              </div>
            </div>
           
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Skills Section -->
    <section id="skills" class="skills section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Skills</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row skills-content skills-animation">

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill"><span>HTML</span> <i class="val">85%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->

            <div class="progress">
              <span class="skill"><span>CSS</span> <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->

            <div class="progress">
              <span class="skill"><span>JavaScript</span> <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->

          </div>

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill"><span>PHP</span> <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->

            <div class="progress">
              <span class="skill"><span>Figma</span> <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->

            <div class="progress">
              <span class="skill"><span>Canva</span> <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->

          </div>

        </div>

      </div>

    </section><!-- /Skills Section -->

   
  
