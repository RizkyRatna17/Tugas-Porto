<?php
//query untuk edit 
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = mysqli_query($koneksi, "SELECT * FROM about WHERE id ='$id'");
    $rowEdit = mysqli_fetch_assoc($query);
    $title = "Edit Data Diri";
} else {
    $title = "Tambah Data Diri";
}
//query untuk menghapus user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryGambar = mysqli_query($koneksi, "SELECT id, image FROM about WHERE id='$id'");
    $rowGambar = mysqli_fetch_assoc($queryGambar);
    $image_name = $rowGambar['image'];
    unlink("uploads/" . $image_name);
    $delete = mysqli_query($koneksi, "DELETE FROM about WHERE id='$id'");
    if ($delete) {
        header("location:?page=about&tambah=berhasil");
    }
}

if (isset($_POST['simpan'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $birthday = $_POST['birthday'];
    $website = $_POST['website'];
    $phone = $_POST['phone'];
    $email= $_POST['email'];
    $degree = $_POST['degree'];
    $address = $_POST['address'];

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
    }

    //ini query update
    if ($id) {

        $update = mysqli_query($koneksi, "UPDATE about SET title='$title', content='$content', image='$image_name', birthday='$birthday', website='$website', phone='$phone', email='$email', degree='$degree', address='$address' WHERE id='$id'");
        if ($update) {
            header("location:?page=about&ubah=berhasil");
        }
    } else {

        $insert = mysqli_query($koneksi, "INSERT INTO about (title, content, image, birthday, website, phone, email, degree, address)
        VALUES('$title', '$content','$image_name','$birthday','$website','$phone','$email', '$degree', '$address')");
        if ($insert) {
            header("location:?page=about&tambah=berhasil");
        }
    }
}

?>


<div class="pagetitle">
    <h1><?php echo $title ?></h1>

</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title ?></h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="">Gambar</label>
                            <input type="file" name="image" required>
                            <small>)*Size 1920*1088</small>
                        </div>
                        <div class="mb-3">
                            <label for="">Judul</label>
                            <input type="text" class="form-control" name="title" 
                                required value="<?php echo ($id) ? $rowEdit['title'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Isi</label>
                            <textarea name="content" id="summernote"
                                class="form-control"><?php echo ($id) ? $rowEdit['content'] : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Birthday</label>
                            <input type="text" class="form-control" name="birthday" 
                                required value="<?php echo ($id) ? $rowEdit['birthday'] : '' ?>">
                        </div>
                       <div class="mb-3">
                            <label for="">Website</label>
                            <input type="text" class="form-control" name="website" 
                                required value="<?php echo ($id) ? $rowEdit['website'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone</label>
                            <input type="number" class="form-control" name="phone" 
                                required value="<?php echo ($id) ? $rowEdit['phone'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" 
                                required value="<?php echo ($id) ? $rowEdit['email'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Degree</label>
                            <input type="text" class="form-control" name="degree" 
                                required value="<?php echo ($id) ? $rowEdit['degree'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" 
                                required value="<?php echo ($id) ? $rowEdit['address'] : '' ?>">
                        </div>
                        
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                            <a href="?page=user" class="text-muted">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</section>