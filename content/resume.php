<?php
// Ambil data join dari database (sesuaikan query)

$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories WHERE type='resumes' ORDER BY id DESC");
$rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

$queryResumes = mysqli_query($koneksi, "SELECT categories.name as category_name, resumes.* FROM resumes 
    LEFT JOIN categories ON categories.id = resumes.id_category WHERE is_active = 1 ORDER BY resumes.id DESC");
$rowResumes = mysqli_fetch_all($queryResumes, MYSQLI_ASSOC);

// Simpan ke array
// $rowResumes = [];
// while ($row = mysqli_fetch_all($queryResumes, MYSQLI_ASSOC)) {
//     $rowResumes[] = $row;
// }

// Pisahkan ke dalam 2 array
$categories = [
    'experience' => [],
    'education'  => [],
    'resume'     => []
];

foreach ($rowResumes as $row) {
    $category = $row['category_name'];
    if (isset($categories[$category])) {
        $categories[$category][] = $row;
    }
}

$experience = $categories['experience'];
$education  = $categories['education'];
$resume     = $categories['resume'];
?>




<main class="main">

    <!-- Resume Section -->
    <section id="resume" class="resume section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <?php foreach ($resume as $re): ?>
        <p><?php echo $re['description'] ?></p>
      </div><!-- End Section Title -->
      <?php endforeach ?>

      <div class="container">

        <div class="row">
          
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            
            <h3 class="resume-title">Education</h3>
            <?php foreach ($education as $edu): ?>
            <div class="resume-item">
              <h4><?php echo $edu['title'] ?></h4>
              <h5><?php echo $edu['start_year'] ?> - <?php echo $edu['end_year'] ?></h5>
              <p><em><?php echo $edu['institution'] ?></em></p>
              <p><?php echo $edu['description'] ?></p>
            </div><!-- Edn Resume Item -->
            <?php endforeach ?>

          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="resume-title">Professional Experience</h3>
            <?php foreach ($experience as $exp): ?>
            <div class="resume-item">
              <h4><?php echo $exp['title'] ?></h4>
              <h5><?php echo $exp['start_year'] ?> - <?php echo $exp['end_year'] ?></h5>
              <p><em><?php echo $exp['institution'] ?></em></p>
             <p><em><?php echo $exp['description'] ?></em></p>
            </div><!-- Edn Resume Item -->
            <?php endforeach; ?>

          </div>
        </div>

      </div>

    </section><!-- /Resume Section -->

  </main>