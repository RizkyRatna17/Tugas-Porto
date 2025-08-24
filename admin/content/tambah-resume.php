<?php
// Ambil ID jika ada (edit / delete)
$id        = $_GET['edit'] ?? '';
$judulPage = $id ? "Edit Resume" : "Tambah Resume";

// Jika edit → ambil data lama
$rowEdit = [];
if ($id) {
    $query   = mysqli_query($koneksi, "SELECT * FROM resumes WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($query);
}

// Jika delete → hapus data
if (isset($_GET['delete'])) {
<<<<<<< HEAD
    $id = $_GET['delete'];
    echo "ID yang akan dihapus: $id <br>"; // debug

    $delete = mysqli_query($koneksi, "DELETE FROM resumes WHERE id='$id'");

    if (!$delete) {
        die("Query Error: " . mysqli_error($koneksi));
    } else {
        echo "Berhasil dihapus!";
        header("location:?page=resume&tambah=berhasil");
=======
    $idDelete = $_GET['delete'];
    $delete   = mysqli_query($koneksi, "DELETE FROM resumes WHERE id='$idDelete'");
    if ($delete) {
        header("location:?page=resume&hapus=berhasil");
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
        exit;
    }
}

<<<<<<< HEAD

if (isset($_POST['simpan'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_year = $_POST['start_year'];
    $end_year = $_POST['end_year'];
    $institution = $_POST['institution'];
    $is_active = $_POST['is_active'];
    $id_category = $_POST['id_category'];


    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $type = mime_content_type($tmp_name);
        $path = "uploads/";


        $ext_allowed = ["image/png", "image/jpg", "image/jpeg"];
        if (in_array($type, $ext_allowed)) {
            $path = "uploads/";
            if (!is_dir($path))
                mkdir($path); //mkdir itu untuk memebuat folder jika belum ada //is_dir itu untuk mengecek apakah folder sudah ada atau belum
            $image_name = time() . "-" . basename($image);
            $target_files = $path . $image_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_files)) {
                //jika gambarnya ada maka gambar sebelumnya akan di ganti oleh gambar baru
                if (!empty($row['image'])) {
                    unlink($path . $row['image']); //unlink untuk menghapus file

                }
            }
        } else {
            echo "ekstitensi tidak ditemukan";
            die();
        }
        $update = "UPDATE resumes SET title='$title', description='$description',is_active='$is_active',institution='$institution', id_category='$id_category', start_year='$start_year', end_year='$end_year'  WHERE id='$id'";
    } else {
        $update = "UPDATE resumes SET title='$title', description='$description',is_active='$is_active', institution='$institution', id_category='$id_category', start_year='$start_year', end_year='$end_year' WHERE id='$id'";
    }

    //ini query update
    if ($id) {

        $update = mysqli_query($koneksi, $update);
=======
// Jika simpan (insert / update)
if (isset($_POST['simpan'])) {
    $id_user       = $_SESSION['ID_USER'];
    $type          = $_POST['type'];
    $title         = $_POST['title'];
    $subtitle      = $_POST['subtitle'];
    $institution   = $_POST['institution'];
    $start_year    = $_POST['start_year'];
    $end_year      = $_POST['end_year'] ?: NULL;
    $description   = $_POST['description'];
    $credential    = $_POST['link'];

    if ($id) {
        // Update data
        $update = mysqli_query($koneksi, "
            UPDATE resumes SET 
                type='$type',
                title='$title',
                subtitle='$subtitle',
                institution='$institution',
                start_year='$start_year',
                end_year=" . ($end_year ? "'$end_year'" : "NULL") . ",
                description='$description',
                link='$credential'
            WHERE id='$id'
        ");
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
        if ($update) {
            header("location:?page=resume&ubah=berhasil");
            exit;
        }
    } else {
<<<<<<< HEAD

        $insert = mysqli_query($koneksi, "INSERT INTO resumes (id_category, title, description, is_active, institution, start_year, end_year)
        VALUES('$id_category', '$title', '$description','$is_active', '$institution', '$start_year', '$end_year')");
=======
        // Insert data baru
        $insert = mysqli_query($koneksi, "
            INSERT INTO resumes (type, title, subtitle, institution, start_year, end_year, description, link) 
            VALUES ('$type', '$title', '$subtitle', '$institution', '$start_year', " . ($end_year ? "'$end_year'" : "NULL") . ", '$description', '$link')
        ");
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
        if ($insert) {
            header("location:?page=resume&tambah=berhasil");
            exit;
        }
    }
}
<<<<<<< HEAD
$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories WHERE type='resumes' ORDER BY id DESC");
$rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

=======
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
?>

<div class="pagetitle">
    <h1><?= $judulPage ?></h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $judulPage ?></h5>

                    <form action="" method="post">

                        <div class="mb-3">
<<<<<<< HEAD
                          <label for="">Title</label>  
                          <input type="text" class="form-control" name="title" placeholder="Masukkan Judul" required>
                        </div>
                         <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select name="id_category" id="" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($rowCategories as $rowCategory): ?>
                                    <option value="<?php echo $rowCategory['id'] ?>"><?php echo $rowCategory['name'] ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                         <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" id="summernote"
                                class="form-control"><?php echo ($id) ? $rowEdit['description'] : '' ?></textarea>
=======
                            <label>Type</label>
                            <select name="type" class="form-control" required>
                                <option value="">-- Pilih Type --</option>
                                <option value="experience" <?= ($rowEdit['type'] ?? '') == 'experience' ? 'selected' : '' ?>>Experience</option>
                                <option value="education" <?= ($rowEdit['type'] ?? '') == 'education' ? 'selected' : '' ?>>Education</option>
                                <option value="nonformal" <?= ($rowEdit['type'] ?? '') == 'nonformal' ? 'selected' : '' ?>>Non Formal</option>
                                <option value="certification" <?= ($rowEdit['type'] ?? '') == 'certification' ? 'selected' : '' ?>>Certification</option>
                            </select>
>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
                        </div>

                        <div class="mb-3">
<<<<<<< HEAD
                          <label for="">Start Year</label>  
                          <input type="number" class="form-control" name="start_year" placeholder="Masukkan Tahun" required>
                        </div>
                         <div class="mb-3">
                          <label for="">End Year</label>  
                          <input type="number" class="form-control" name="end_year" placeholder="Masukkan Tahun" required>
                        </div>
                          <div class="mb-3">
                          <label for="">Institusi</label>  
                          <input type="text" class="form-control" name="institution" placeholder="Masukkan Nama Institusi" required>
                        </div>
                          
=======
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" required
                                value="<?= $rowEdit['title'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label>Subtitle</label>
                            <input type="text" class="form-control" name="subtitle"
                                value="<?= $rowEdit['subtitle'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label>Institution</label>
                            <input type="text" class="form-control" name="institution"
                                value="<?= $rowEdit['institution'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label>Start Year</label>
                            <input type="number" class="form-control" name="start_year" min="1900" max="<?= date('Y') ?>"
                                value="<?= $rowEdit['start_year'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label>End Year</label>
                            <input type="number" class="form-control" name="end_year" min="1900" max="<?= date('Y') ?>"
                                value="<?= $rowEdit['end_year'] ?? '' ?>">
                            <small class="text-muted">Kosongkan jika masih berlangsung</small>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"><?= $rowEdit['description'] ?? '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Credential URL</label>
                            <input type="url" class="form-control" name="link"
                                value="<?= $rowEdit['link'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                            <a href="?page=resume" class="text-muted">Kembali</a>
                        </div>
                    </form>

>>>>>>> c2da3f12e1d6c40d4187b5b66c8ccbc97be06842
                </div>
            </div>
        </div>
    </div>
</section> 