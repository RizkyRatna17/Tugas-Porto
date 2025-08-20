<?php
// Query Resume
$queryResumes = mysqli_query($koneksi, "SELECT * FROM resumes ORDER BY start_year DESC")
    or die("Query error: " . mysqli_error($koneksi));
$resumes = mysqli_fetch_all($queryResumes, MYSQLI_ASSOC);

// Kelompokkan data sesuai type
$groups = [
    'nonformal' => [],
    'education' => [],
    'experience' => [],
    'certification' => [],
];

foreach ($resumes as $r) {
    $type = strtolower($r['type']);
    if (isset($groups[$type])) {
        $groups[$type][] = $r;
    }
}

// Fungsi helper untuk render item dalam tabel
function renderResumeTable($items, $title)
{
    ?>
    <h3 class="resume-title"><?= htmlspecialchars($title) ?></h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Start - End</th>
                    <th>Institution</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="4" class="text-center"><em>Belum ada data.</em></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td>
                                <?= htmlspecialchars($item['start_year']) ?>
                                <?= $item['end_year'] ? ' - ' . htmlspecialchars($item['end_year']) : '' ?>
                            </td>
                            <td><?= htmlspecialchars($item['institution']) ?></td>
                            <td><?= nl2br(htmlspecialchars($item['description'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>

<section id="resume" class="resume section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p>Perjalanan pendidikan dan pengalaman profesional saya.</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row">

            <!-- Kolom Kiri -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <?php
                renderResumeTable($groups['nonformal'], "Non Formal");
                renderResumeTable($groups['education'], "Education");
                ?>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <?php
                renderResumeTable($groups['experience'], "Professional Experience");
                renderResumeTable($groups['certification'], "Sertifikasi");
                ?>
            </div>

        </div>
    </div>
</section>