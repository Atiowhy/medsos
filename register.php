<?php
include 'koneksi.php';

if(isset($_POST['regis'])){
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = sha1($_POST['password']);

$regisUser = mysqli_query($koneksi, "INSERT INTO user (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$password')");

if(!$regisUser){
    header('location: register.php?failed-regis');
} else {
    header('location: login.php?register-success');
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
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h5>Medsos X Atio</h5>
                                <p>Silahkan daftarkan akun anda</p>
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
                                        Fullname
                                    </label>
                                    <input type="text" class="form-control" name="fullname"
                                        placeholder="Masukkan nama lengkap anda">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Username
                                    </label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Masukkan nama pengguna anda">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Password
                                    </label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="regis">Register</button>
                                    </div>
                                </div>
                            </form>
                            <div class="account d-flex justify-content-center">
                                <a href="login.php" class="text-decoration-none text-dark">Already have an account?
                                    Login
                                    Here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>