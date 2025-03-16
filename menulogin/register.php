<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- custom css -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .form-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        .form-container h4 {
            margin-bottom: 20px;
            color: #343a40;
            font-weight: 700;
        }
        .form-container .form-group label {
            color: #495057;
            font-weight: 500;
        }
        .form-container .form-footer p {
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 91, 187, 0.4);
        }
    </style>
</head>

<body>
    <?php
    require('koneksi.php');
    session_start();

    $error = '';
    $validate = '';
    if (isset($_SESSION['user'])) header('Location: index.php');

    if (isset($_POST['submit'])) {
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $name = stripslashes($_POST['name']);
        $name = mysqli_real_escape_string($con, $name);
        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $repass = stripslashes($_POST['repassword']);
        $repass = mysqli_real_escape_string($con, $repass);

        if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))) {
            if ($password == $repass) {
                if (cek_nama($name, $con) == 0) {
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (username, name, email, password) VALUES ('$username', '$name', '$email', '$pass')";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        $_SESSION['username'] = $username;
                        header('Location: index.php');
                    } else {
                        $error = 'Register User Gagal !!';
                    }
                } else {
                    $error = 'Username sudah terdaftar !!';
                }
            } else {
                $validate = 'Password tidak sama !!';
            }
        } else {
            $error = 'Data tidak boleh kosong !!';
        }
    }

    function cek_nama($username, $con) {
        $nama = mysqli_real_escape_string($con, $username);
        $query = "SELECT * FROM users WHERE username = '$nama'";
        if ($result = mysqli_query($con, $query)) return mysqli_num_rows($result);
    }
    ?>

    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-8 col-md-6 col-lg-4">
                <form class="form-container" action="register.php" method="POST">
                    <h4 class="text-center font-weight-bold">Daftar Akun Admin</h4>
                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Alamat Email</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Masukkan email" required>
                    </div>
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
                    <div class="form-group">
                        <label for="InputRePassword">Re-Password</label>
                        <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password" required>
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php } ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Daftar</button>
                    <div class="form-footer mt-2">
                        <p>Sudah punya account? <a href="login.php">Login Akun</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>

    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhir Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlUHjG6BUpIhZO0s7M0nLvW3GLwYtVJ14Q8e5XjV4o3VURjsh59dJ6z56k9" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgpsfzIWbxR1+cBtmq0hTZfFTfXt0KR5aPzAGF8UI7lr0LR8Jo4" crossorigin="anonymous"></script>
</body>
</html>
