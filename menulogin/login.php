<?php
// menyertakan file program koneksi.php pada register
require('koneksi.php');
// inisialisasi session
session_start();

$error = '';
$validate = '';

// mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['username'])) header('Location: index.php');

// mengecek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {

    // menghilangkan backshlases
    $username = stripslashes($_POST['username']);
    // cara sederhana mengamankan dari sql injection
    $username = mysqli_real_escape_string($con, $username);
    // menghilangkan backshlases
    $password = stripslashes($_POST['password']);
    // cara sederhana mengamankan dari sql injection
    $password = mysqli_real_escape_string($con, $password);

    // cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {

        // select data berdasarkan username dari database
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;

                header('Location: index.php');
            }
            // jika gagal maka akan menampilkan pesan error
        } else {
            $error = 'Input yang dimasukkan salah !!';
        }
    } else {
        $error = 'Data tidak boleh kosong !!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        body {
            background: #cccccc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.4);
            width: 100%;
        }
        .form-container h4 {
            margin-bottom: 36px;
            font-weight: bold;
            text-align: center;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-footer {
            margin-top: 20px;
            text-align: center;
        }
        .form-footer a {
            color: #007bff;
        }
        .form-footer a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <form class="form-container" action="login.php" method="POST">
                    <h4 class="text-center">Login Akun Admin</h4>
                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password" required>
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php } ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                    <a href="/gymmustika/index.html" class="btn btn-secondary btn-block">Beranda</a>
                    <div class="form-footer mt-2">
                        <p>Belum punya account? <a href="register.php">Register Akun</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
