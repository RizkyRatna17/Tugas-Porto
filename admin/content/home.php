<?php
$query = mysqli_query($koneksi, "SELECT * FROM homes ORDER BY id DESC"); //DECS => itu untuk mengurutkan data dari yang terbaru
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>


<div class="pagetitle">
    <h1>Data Home</h1>

</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Home</h5>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-home" class="btn btn-primary">Tambah</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul </th>
                                <th>Isi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($rows as $key => $row): ?>
                                <tr>
                                    <td><?php echo $key += 1 ?></td>
                                    <td><img width="100" src="uploads/<?php echo $row['image'] ?>" alt=""></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td>
                                        <a href="?page=tambah-home&edit=<?php echo $row['id'] ?>"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                            href="?page=tambah-home&delete=<?php echo $row['id'] ?>"
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