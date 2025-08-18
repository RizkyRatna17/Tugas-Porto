<?php
//jika data setting sudah ada maka update data tersebut
//selain itu kalo blm ada maka insert data

$querySetting = mysqli_query($koneksi, "SELECT * FROM settings LIMIT 1"); //LIMIT 1 adalah data yang dimaksudkan hanya 1
$row = mysqli_fetch_assoc($querySetting);

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $fb = $_POST['fb'];
    $ig = $_POST['ig'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];

    //jika gambar terupload
    if (!empty($_FILES['logo']['name'])) {
        $logo = $_FILES['logo']['name'];
        $path = "uploads/";
        if (!is_dir($path))
            mkdir($path); //mkdir itu untuk memebuat folder jika belum ada //is_dir itu untuk mengecek apakah folder sudah ada atau belum

        $logo_name = time() . "-" . basename($logo);
        $target_files = $path . $logo_name;
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_files)) {
            //jika gambarnya ada maka gambar sebelumnya akan di ganti oleh gambar baru
            if (!empty($row['logo'])) {
                unlink($path . $row['logo']); //unlink untuk menghapus file

            }

        }
    }


    if ($row) {
        //update 

        $id_setting = $row['id'];
        $update = mysqli_query($koneksi, "UPDATE settings SET name='$name',ig='$ig', fb='$fb', twitter= '$twitter',linkedin='$linkedin'");
        if ($update) {
            header("location:?page=setting&ubah=berhasil");
        }
    } else {
        //insert
        $insert = mysqli_query($koneksi, "INSERT INTO settings (name, ig, fb, twitter,linkedin) VALUES ('$name', '$ig', '$fb', '$twitter','$linkedin')");
        if ($insert) {
            header("location:?page=setting&tambah=berhasil");
        }

    }
}


?>


<div class="pagetitle">
    <h1>Setting</h1>

</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Setting</h5>
                    <!-- Format ENCTYPE wajib digunakan kalau di form ada input file (<input type="file">). -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Name</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="" class="form-control"
                                    value="<?php echo isset($row['name']) ? $row['name'] : '' ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Facebook</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="fb" id="" class="form-control"
                                    value="<?php echo isset($row['fb']) ? $row['fb'] : '' ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Twitter</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="twitter" id="" class="form-control"
                                    value="<?php echo isset($row['twitter']) ? $row['twitter'] : '' ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Instagram</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="ig" id="" class="form-control"
                                    value="<?php echo isset($row['ig']) ? $row['ig'] : '' ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">LinkedIn</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="linkedin" id="" class="form-control"
                                    value="<?php echo isset($row['linkedin']) ? $row['linkedin'] : '' ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>

        </div>


    </div>

</section>