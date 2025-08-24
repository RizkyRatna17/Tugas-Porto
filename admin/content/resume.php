<?php
<<<<<<< HEAD
//JOIN untuk menggabungkan tabel
$query = mysqli_query($koneksi, "SELECT categories.name, resumes. * FROM resumes JOIN categories ON categories.id = resumes.id_category ORDER BY resumes.id DESC"); //DECS => itu untuk mengurutkan data dari yang terbaru

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
function changeIsActive($isActive)
{
    switch ($isActive) {
        case '1':
            $title = "<span class='badge bg-primary'>Publish</span>";
            break;
        default:
            $title = "<span class='badge bg-warning'>Draft</span>";
            break;
    }
    return $title;
}

?>
=======
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
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842

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

<<<<<<< HEAD
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Resume</h5>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-resume" class="btn btn-primary">Tambah</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Title</th>
                                <th>Isi</th>
                                <th>Tahun Masuk</th>
                                <th>Tahun Keluar</th>
                                <th>Institusi</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($rows as $key => $row): ?>
                                <tr>
                                    <td><?php echo $key += 1 ?></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td><?php echo $row['start_year'] ?></td>
                                    <td><?php echo $row['end_year'] ?></td>
                                    <td><?php echo $row['institution'] ?></td>
                                    <td><?php echo changeIsActive($row['is_active']) ?></td>
                                    <td class ="d-flex d-inline" >
                                        <a href="?page=tambah-resume&edit=<?php echo $row['id'] ?>"
                                            class="btn btn-sm btn-success me-2">Edit</a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                            href="?page=tambah-resume&delete=<?php echo $row['id'] ?>"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>


                    </table>
                </div>
=======
            <!-- Kolom Kanan -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <?php
                renderResumeTable($groups['experience'], "Professional Experience");
                renderResumeTable($groups['certification'], "Sertifikasi");
                ?>
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
            </div>

        </div>
    </div>
</section>