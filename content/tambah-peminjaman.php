<?php
if (isset($_POST['simpan'])) {
    // jika param edit ada maka update, selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';

    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $id_level = $_POST['id_level'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, email, password, id_level) VALUES ('$nama_lengkap','$email', '$password', $id_level )");
        header("location:?pg=user&tambah=berhasil");
    } else {
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap = '$nama_lengkap', email = '$email', id_level = '$id_level', password = '$password' WHERE id = '$id'");
        header("location:?pg=user&ubah=berhasil");
    }

    // header("location:?pg=user&tambah=berhasil");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");
    header("location:?pg=user&hapus=berhasil");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

$queryKodeTrans = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$rowKodeTrans = mysqli_fetch_assoc($queryKodeTrans);
$no_urut = $rowKodeTrans['id_transaksi'];
$no_urut++;
$kode_transaksi = "PJ" . date("dmY") . sprintf("%03s", $no_urut);

$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");


?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">Data User</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Kode Transaksi</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="kode_transaksi" value="<?= ($kode_transaksi ?? '') ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Nama Anggota</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="nama_anggota" id="" class="form-control">
                                    <option value="">Pilih Anggota</option>
                                    <?php while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)) : ?>
                                        <option value="<?= $rowAnggota['nama_lengkap'] ?>"><?= $rowAnggota['nama_lengkap'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Tanggal Pinjam</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tgl_pinjam" value="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Tanggal Kembali</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tgl_kembali" value="">
                            </div>
                        </div>
                        <div class="mb-5 row">
                            <div class="col-sm-2">
                                <label for="">Nama Petugas</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="" value="<?= ($_SESSION['NAMA_LENGKAP']) ?? '' ?>" readonly>
                                <input type="hidden" class="form-control" name="id_user" value="<?= ($_SESSION['ID_USER']) ?? '' ?>" readonly>
                            </div>
                        </div>

                        <!-- GET  DATA Kategori Buku dan Buku -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Kategori Buku</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)) : ?>
                                        <option value="<?= $rowKategori['id'] ?>"><?= $rowKategori['nama_kategori'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Nama Buku</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_buku" id="id_buku" class="form-control">
                                    <option value="">Pilih Buku</option>
                                </select>
                            </div>
                        </div>



                        <div class="mb-3">
                            <input name="simpan" value="Simpan" type="submit" class="btn btn-primary mt-3">
                            <a href="?pg=peminjaman" class="btn btn-secondary mt-3 mx-1" id="back">Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>