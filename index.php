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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?pg=anggota">Anggota</a></li>
                                <li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="?pg=buku">Buku</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="?pg=kategori">Kategori</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li><a class="dropdown-item" href="?pg=user">User</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="?pg=level">Level</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=peminjaman">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=pengembalian">Pengembalian</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <a href="login.php" class="btn btn-primary">Login</a>
                        <a href="logout.php" class="btn btn-outline-danger mx-3">Logout</a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <script>
        $('#id_kategori').change(function() {
            let id = $(this).val(),
                option = "";
            $.ajax({
                url: `ajax/get-buku.php?id_kategori=${id}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    option += "<option>Pilih Buku</option>"
                    $.each(data, function(key, value) {

                        // option += "<option value=" + value.id + ">" + value.judul + "</option>"
                        option += `<option value=${value.id}> ${value.judul}</option>`
                        // console.log("Valuenya : ", value.judul);
                    });
                    $('#id_buku').html(option);

                }
            })
        });
    </script>
</body>

</html>