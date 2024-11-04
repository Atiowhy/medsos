<?php

// get Tweet
$id = $_SESSION['ID'];
$getTweet = mysqli_query($koneksi, "SELECT * FROM tweets WHERE id_user = '$id'");


if (isset($_POST['tweet'])) {
    $content = $_POST['content'];

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
            unlink($upload . $resultTweet['foto']);

            $postTweet = mysqli_query($koneksi, "INSERT INTO tweets (content, id_user, foto) VALUES ('$content', '$id', '$nameFile')");
        }
    } else {
        $postTweet = mysqli_query($koneksi, "INSERT INTO tweets (content, id_user) VALUES ('$content', '$id')");
        header('location: ?pg=profile&tweet=berhasil');
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="btn-cta d-flex justify-content-end mt-3">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tweets">Tweets</button>
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <?php
        while ($dataTweet = mysqli_fetch_assoc($getTweet)) :
        ?>
            <div class="d-flex mb-5">
                <div class="flex-shrink-0">
                    <img src="upload/<?php echo !empty($resultUser['foto']) ? $resultUser['foto'] : 'https://placehold.co/400' ?>" alt="..." class="border border-2 rounded-circle" width="150">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p><?php echo $dataTweet['content'] ?></p>
                    <?php
                    if (isset($dataTweet['foto'])): ?>
                        <img src="upload/<?php echo $dataTweet['foto'] ?>" alt="">
                    <?php endif ?>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>


<!-- modal -->
<div class="modal fade" id="tweets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tweets Somethings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Tweets</label>
                        <textarea name="content" id="summernote"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tweet">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>