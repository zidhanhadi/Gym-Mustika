<?php
//inisialisasi session
session_start();
//mengecek username pada session
if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: /menulogin/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .nav-item {
        list-style: none;
        display: inline-block;
    }
    .nav-link {
        text-decoration: none;
        font-weight: bold;
        color: #fff;
    }
    .btn-logout {
        background-color: #ff3b3b;
        color: #ffffff;
        padding: 10px 15px;
        border: none;
        border-radius: 7px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
    }
    .btn-logout:hover {
        background-color: #f24141;
        box-shadow: 0 5px 9px rgba(0, 0, 0, 0.3);
    }
    .navbar-brand {
        font-weight: bold;
        text-shadow: 2px 1px 0 #000, 2px 2px 0 #aaa, 2px 2px 0 #aaa, 3px 3px 0 #aaa;
        font-size: 23px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        position: relative;
        display: inline-block;
        padding: 5px 10px;
        transition: transform 0.3s;
    }
    .navbar-brand:hover {
        transform: translateY(-3px);
    }
    .navbar-brand:hover::before {
        transform: translate(-10px, -10px);
    }
    .navbar {
        border-radius: 0px;
    }
    .jumbotron {
        border-radius: 15px;
        margin-top: 80px; /* Adjust margin-top to avoid content being hidden under the fixed navbar */
    }
    .container {
        border-radius: 15px;
    }
</style>
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark text-light fixed-top'>
    <div class="container">
        <a href="index.php" class="navbar-brand" data-text="DATA ADMINISTRASI GYM MUSTIKA FITNESS CENTRE">
            DATA ADMINISTRASI GYM MUSTIKA FITNESS CENTRE
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul>
            <li class="nav-item ml-4">
                <a href="logout.php" class="nav-link">
                    <button class="btn-logout"><b>LOGOUT AKUN</b></button>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron jumbotron-fluid bg-light" style="height:90vh">
    <div class="container">
        <iframe src="crudwebgym/index.php" width="100%" height="875" frameborder="0" style="border-radius: 15px;"></iframe>
    </div>
</div>
</body>
<!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlUHjG6BUpIhZO0s7M0nLvW3GLwYtVJ14Q8e5XjV4o3VURjsh59dJ6z56k9" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgpsfzIWbxR1+cBtmq0hTZfFTfXt0KR5aPzAGF8UI7lr0LR8Jo4" crossorigin="anonymous"></script>
</html>
