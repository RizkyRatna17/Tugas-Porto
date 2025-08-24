<?php
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

<div class="pagetitle">
    <h1>Data Resume</h1>

</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

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
            </div>

        </div>

    </div>

</section>