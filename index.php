<?php
session_start();
include 'config/koneksi.php';
$queryUser = mysqli_query($koneksi, "SELECT * FROM user");
$rowUser = mysqli_fetch_assoc($queryUser);
$queryLevel = mysqli_query($koneksi, "SELECT * FROM level");
$rowLevel = mysqli_fetch_assoc($queryLevel);
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$rowKategori = mysqli_fetch_assoc($queryKategori);
// echo "<h1>Selamat datang " . (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') . "</h1>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang, <?= $rowUser['nama_lengkap'] ?> </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        nav.menu {

            box-shadow: 0px 0px 3px black;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="menu navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Perpustakaan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="content/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=user">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=level">Level</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=kategori">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=buku">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=anggota">Anggota</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="search">
                        <a href="login.php" class="btn btn-primary">Login</a>
                    </form>
                </div>
            </div>
        </nav>

        <!-- content here -->
        <?php
        if (isset($_GET['pg'])) {
            if (file_exists('content/' . $_GET['pg'] . '.php')) {
                include 'content/' . $_GET['pg'] . '.php';
            } else {
                include 'content/home.php';
            }
        }

        ?>

        <!-- end content -->
    </div>
</body>

</html>