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
    $delete = mysqli_query($koneksi, "DELETE FROM resumes WHERE id='$id'");
    if ($delete) {
        header("location:?page=resume&tambah=berhasil");
    }
}

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $summary = $_POST['summary'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
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

        $update = mysqli_query($koneksi, "UPDATE resumes SET name='$name', summary='$summary', phone='$phone', email='$email', address='$address' WHERE id='$id'");
        if ($update) {
            header("location:?page=resume&ubah=berhasil");
        }
    } else {

        $insert = mysqli_query($koneksi, "INSERT INTO resumes (name, summary, phone, email, address)
        VALUES('$name', '$summary','$phone','$email', '$address')");
        if ($insert) {
            header("location:?page=resume&tambah=berhasil");
        }
    }
}

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
                          
                          <label for="">Nama</label>  
                          <input type="text" class="form-control" name="name" placeholder="Masukkan Nama" required>
                        </div>
                         <div class="mb-3">
                            <label for="">Summary</label>
                            <textarea name="summary" id="summernote"
                                class="form-control"><?php echo ($id) ? $rowEdit['summary'] : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="">Telephone</label>  
                          <input type="number" class="form-control" name="phone" placeholder="Masukkan No Telp" required>
                        </div>
                          <div class="mb-3">
                          <label for="">Email</label>  
                          <input type="text" class="form-control" name="email" placeholder="Masukkan Email" required>
                        </div>
                          <div class="mb-3">
                          <label for="">Address</label>  
                          <input type="text" class="form-control" name="address" placeholder="Masukkan Alamat" required>
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