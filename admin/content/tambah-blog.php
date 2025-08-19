<?php
//query untuk edit 
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = mysqli_query($koneksi, "SELECT * FROM blogs WHERE id ='$id'");
    $rowEdit = mysqli_fetch_assoc($query);
    $title = "Edit Blog";
} else {
    $title = "Tambah Blog";
}
//query untuk menghapus user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryGambar = mysqli_query($koneksi, "SELECT id, image FROM blogs WHERE id='$id'");
    $rowGambar = mysqli_fetch_assoc($queryGambar);
    $image_name = $rowGambar['image'];
    unlink("uploads/" . $image_name);
    $delete = mysqli_query($koneksi, "DELETE FROM blogs WHERE id='$id'");
    if ($delete) {
        header("location:?page=blog&tambah=berhasil");
    }
}

if (isset($_POST['simpan'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_category = $_POST['id_category'];
    $is_active = $_POST['is_active']; // $_POST artinya diinput manual dari user lewat form

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
            die;
        }
         $update = "UPDATE blogs SET title='$title', description='$description',is_active='$is_active', image='$image_name' ,  id_category='$id_category' WHERE id='$id'";
    } else {
        $update = "UPDATE blogs SET title='$title', description='$description',is_active='$is_active',  id_category='$id_category' WHERE id='$id'";
    }


        
//  ini query update
    if ($id) {

        $update = mysqli_query($koneksi, $update);
        if ($update) {
            header("location:?page=blog&ubah=berhasil");
        }
    } else {

        $insert = mysqli_query($koneksi, "INSERT INTO blogs (id_category, title, description, is_active, image)
        VALUES('$id_category', '$title', '$description','$is_active', '$image_name')");
        if ($insert) {
            header("location:?page=blog&tambah=berhasil");
        }
    }
}

$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories WHERE type='blog' ORDER BY id DESC");
$rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

?>


<div class="pagetitle">
    <h1><?php echo $title ?></h1>

</div><!-- End Page Title -->

<section class="section">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $title ?></h5>
                        <div class="mb-3">
                            <label for="" class="form-label">Gambar</label>
                            <input type="file" name="image">
                            <small>)*Size 1920*1088</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" placeholder="Masukkan judul blog"
                                required value="<?php echo ($id) ? $rowEdit['title'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Isi</label>
                            <textarea name="description" id="summernote"
                                class="form-control"><?php echo ($id) ? $rowEdit['description'] : '' ?></textarea>
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

    </form>

</section>