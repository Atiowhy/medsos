<?php
// menampilkan data user berdasarkan id user

$id_user = $_SESSION['ID'];
$selectUser = mysqli_query($koneksi,  "SELECT * FROM user WHERE id = '$id_user'");
$resultUser = mysqli_fetch_assoc($selectUser);

// 
$queryTweet = mysqli_query($koneksi,  "SELECT * FROM tweets WHERE id = '$id_user'");
$resultTweet = mysqli_fetch_assoc($queryTweet);

// update User
if (isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    // jika gambar mau diubah
    if (!empty($_FILES['foto']['name'])) {
        $nameFile = $_FILES['foto']['name'];
        $image_size = $_FILES['foto']['size'];

        // extention file
        $ext = array('png', 'jpg', 'jpeg', 'jfif', 'WebP');
        $extImg = pathinfo($nameFile, PATHINFO_EXTENSION);

        // jika ext tidak ada yg terdaftar
        if (!in_array($extImg, $ext)) {
            echo 'ext tidak ditemukan';
            die;
        } else {
            $upload = "upload/";
            // pindahkan gambar dari tmp folder ke folder yg kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], $upload . $nameFile);
            // unlink() => fungsinya untuk mendelete file
            unlink($upload . $resultUser['foto']);

            $editUser = mysqli_query($koneksi, "UPDATE user SET fullname = '$fullname', username =  '$username', email = '$email', description = '$description', foto = '$nameFile' WHERE id = '$id_user'");
        }
    } else {
        $editUser = mysqli_query($koneksi, "UPDATE user SET fullname = '$fullname', username =  '$username', email = '$email', description = '$description' WHERE id = '$id_user'");
    }

    if ($editUser) {
        header('location: ?pg=profile&success-edit');
    } else {
        header('location: ?pg=profile&failed-edit');
    }
}
if (isset($_POST['edit_cover'])) {
    // jika gambar mau diubah
    if (!empty($_FILES['foto']['name'])) {
        $nameFile = $_FILES['foto']['name'];
        $image_size = $_FILES['foto']['size'];

        // extention file
        $ext = array('png', 'jpg', 'jpeg', 'jfif', 'WebP');
        $extImg = pathinfo($nameFile, PATHINFO_EXTENSION);

        // jika ext tidak ada yg terdaftar
        if (!in_array($extImg, $ext)) {
            echo 'ext tidak ditemukan';
            die;
        } else {
            $upload = "upload/";
            // pindahkan gambar dari tmp folder ke folder yg kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], $upload . $nameFile);
            // unlink() => fungsinya untuk mendelete file
            unlink($upload . $resultUser['cover']);

            $editUser = mysqli_query($koneksi, "UPDATE user SET cover = '$nameFile' WHERE id = '$id_user'");
        }
    }

    if ($editUser or $postTweet) {
        header('location: ?pg=profile&success');
    } else {
        header('location: ?pg=profile&failed');
    }
}


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="cover"">
                <img src=" <?php echo !empty($resultUser['cover']) ? 'upload/' . $resultUser['cover'] : '' ?>" height="400px" class="object-fit-cover" width="100%" style="background-size: cover; background-position: center;">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile-header mt-5 ms-2">
                <img src="<?php echo !empty($resultUser['foto']) ? 'upload/' . $resultUser['foto'] : '' ?>" width="40%" class="rounded-circle border border-2 border-dark" alt="">
                <div class="isi-profile mt-3">
                    <h2><?php echo $resultUser['fullname'] ?></h2>
                    <p>@<?php echo $resultUser['username'] ?></p>
                    <p><?php echo $resultUser['description'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="btn-cta position-relative h-100">
                <div class="btn-position position-absolute bottom-0 end-0">
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary ">Edit Profile</a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#editCover" class="btn btn-primary ">Edit Cover</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tweets</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tweets & Replies</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Likes</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><?php include 'tweet.php' ?></div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Fullname</label>
                        <input type="text" class="form-control" name="fullname" value="<?php echo $resultUser['fullname'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $resultUser['username'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $resultUser['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" class="form-control"><?php echo $resultUser['description'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit cover -->
<div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Cover</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit_cover">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>