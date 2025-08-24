<?php
//query untuk edit 
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = mysqli_query($koneksi, "SELECT * FROM resumes WHERE id ='$id'");
    $rowEdit = mysqli_fetch_assoc($query);
    $titleBlog = "Edit Resume";
} else {
    $titleBlog = "Tambah Resume";
}
//query untuk menghapus user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo "ID yang akan dihapus: $id <br>"; // debug

    $delete = mysqli_query($koneksi, "DELETE FROM resumes WHERE id='$id'");

    if (!$delete) {
        die("Query Error: " . mysqli_error($koneksi));
    } else {
        echo "Berhasil dihapus!";
        header("location:?page=resume&tambah=berhasil");
        exit;
    }
}


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
        if ($update) {
            header("location:?page=resume&ubah=berhasil");
        }
    } else {

        $insert = mysqli_query($koneksi, "INSERT INTO resumes (id_category, title, description, is_active, institution, start_year, end_year)
        VALUES('$id_category', '$title', '$description','$is_active', '$institution', '$start_year', '$end_year')");
        if ($insert) {
            header("location:?page=resume&tambah=berhasil");
        }
    }
}
$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories WHERE type='resumes' ORDER BY id DESC");
$rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

?>



<div class="pagetitle">
    <h1><?php echo $titleBlog ?></h1>

</div><!-- End Page Title -->

<section class="section">
    <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $titleBlog ?></h5>
                        
                        <div class="mb-3">
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
                        </div>
                        <div class="mb-3">
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
                          
                </div>
            </div>
            
        </div>
        
<div class="col-lg-4">

 <div class="card">
     <div class="card-body">
         <h5 class="card-title"><?php echo $titleBlog ?></h5>

         <div class="mb-3">
             <label for="" class="form-label">Status</label>
             <select name="is_active" id="" class="form-control">
                 <option <?php echo ($id) ? $rowEdit['is_active'] == 1 ? 'selected' : '' : '' ?> value="1">
                     Publish</option>
                 <option <?php echo ($id) ? $rowEdit['is_active'] == 0 ? 'selected' : '' : '' ?> value="0">
                     Draft</option>
             </select>
         </div>

         <div class="mb-3">
             <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
             <a href="?page=user" class="text-muted">Kembali</a>
         </div>


     </div>
 </div>

</div>
    </div>

   
</form>

</section>