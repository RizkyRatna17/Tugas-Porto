<?php
$query = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC"); //DECS => itu untuk mengurutkan data dari yang terbaru
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>


<div class="pagetitle">
    <h1>Data Tentang Kami</h1>

</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-12"> <!-- ganti col-xl-12 jadi col-12 biar selalu full di semua ukuran -->

            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <h5 class="card-title">Data About</h5>
                        <div class="mb-3 text-end">
                            <a href="?page=tambah-about" class="btn btn-primary">Tambah</a>
                        </div>

                        <!-- Bungkus tabel dengan table-responsive -->
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Birthday</th>
                                        <th>Website</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Degree</th>
                                        <th>Address</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($rows as $key => $row): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><img width="100" src="uploads/<?= $row['image'] ?>" alt=""></td>
                                            <td><?= $row['title'] ?></td>
                                            <td><?= $row['content'] ?></td>
                                            <td><?= $row['birthday'] ?></td>
                                            <td><?= $row['website'] ?></td>
                                            <td><?= $row['phone'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['degree'] ?></td>
                                            <td><?= $row['address'] ?></td>
                                            <td class ="d-flex d-inline">
                                                <a href="?page=tambah-about&edit=<?= $row['id'] ?>" 
                                                   class="btn btn-sm btn-success me-2">Edit</a>
                                                <a href="?page=tambah-about&delete=<?= $row['id'] ?>" 
                                                   onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" 
                                                   class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
