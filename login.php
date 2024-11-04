<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // login by email
    $loginUser = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");

    // cek database
    if (mysqli_num_rows($loginUser) > 0) {
        $dataUser = mysqli_fetch_assoc($loginUser);
        if ($dataUser['password'] == $password) {
            $_SESSION['NAME'] = $dataUser['username'];
            $_SESSION['ID'] = $dataUser['id'];
            // print_r($_SESSION['ID']);
            // die;
            header('location: index.php?login-success');
        } else {
            header('location: index.php?failed-login');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="container mt-4">
            <div class="row">
                <div class="col-sm-6 d-flex justify-content-end">
                    <img src="assets/img/hp.png" alt="" class="mt-3">
                </div>
                <div class="col-sm-6">
                    <div class="card mt-5 col-sm-8 p-4">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h5>Medsos X Atio</h5>
                                <p>Silahkan masuk dengan akun anda</p>
                            </div>
                            <form action="" method="post">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Email
                                    </label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Masukkan email anda">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Password
                                    </label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                </div>
                                <div class="form-group">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="login">Masuk</button>
                                    </div>
                                    <div class="text-atau d-flex justify-content-center mt-3">
                                        <p class="text-muted">ATAU</p>
                                    </div>
                                    <div class="fb text-center">
                                        <p class="text-primary">Masuk dengan Facebook</p>
                                    </div>
                                    <div class="forgot-pass text-center">
                                        <a href="" class="text-decoration-none">Lupa Sandi?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="account d-flex justify-content-center">
                                <a href="register.php" class="text-decoration-none text-dark">Don't have an account?
                                    Register
                                    Here</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="card col-sm-8 mt-2 px-4 py-3">
                        <div class="buat-akun d-flex justify-content-center gap-1">
                            <p>Tidak Punya Akun?</p>
                            <a href="register.php" class="text-decoration-none">Buat Akun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>