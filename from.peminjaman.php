<?php
include_once("database.php");

// Query untuk mendapatkan daftar kode barang dari tabel Barang
$sql_barang = "SELECT kode_barang, nama_barang FROM barang";
$result_barang = mysqli_query($koneksi, $sql_barang);

// Query untuk mendapatkan daftar id user dari tabel User
$sql_user = "SELECT id, nama FROM user WHERE role = 'admin'";
$result_user = mysqli_query($koneksi, $sql_user);
?>
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .card {
            margin-left: 330px;
        }

        .sidebar {
            background-color: #f8f9fa;
            /* Bootstrap's default sidebar color */
            height: 100vh;
            /* Full height */
            position: fixed;
            /* Fixed Sidebar */
            top: 0;
            left: 0;
            padding-top: 4rem;
            /* Adjust the top padding to align with Bootstrap's navbar height */
        }

        .sidebar ul.nav {
            padding-left: 0;
            /* Remove default padding */
        }

        .sidebar .nav-link {
            padding: 0.5rem 1rem;
            /* Adjust the padding */
            color: #333;
            /* Text color */
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            /* Hover color */
        }

        /* Adjust main content to make space for the fixed sidebar */
        .col-md-9 {
            margin-left: 25%;
            /* Same width as the sidebar */
            padding-left: 15px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:login.php?msg=belumlogin");
    }
    ?>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <a role="button" class="btn btn-primary" href="logout.php">Logout</a>
        </div>
    </header>


    <div class="container">
        <div class="row">
            <div class="col-lg-2 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_barang.php">Data Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Peminjam.php">Peminjaman Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_user.php">Data user</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="card" style="width: 40rem;">
                    <div class="card-header">
                        <h3>
                            Tambah data peminjaman
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="proses_peminjaman.php" method="post">
                            <div class="form-group">
                                <label for="tanggalpinjam">Tanggal pinjam</label>
                                <input type="date" class="form-control" id="tanggalpinjam" name="tanggal_pinjam" value="<?= isset($id['tanggal_pinjam']) ? date('Y-m-d') : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="tanggalkembali">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="tanggalkembali" name="tanggal_kembali" value="<?= isset($id['tanggal_kembali']) ? date('Y-m-d') : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="noidentitas">No identitas :</label>
                                <input type="text" class="form-control" id="noidentitas" name="no_identitas">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kode barang</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="kode_barang">
                                    <option value="">--PILIH--</option>
                                    <?php
                                    if (mysqli_num_rows($result_barang) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_barang)) {
                                            echo "
                                                        <option value='" . $row['kode_barang'] . "'>" . $row['kode_barang'] . " - " . $row['nama_barang'] . "</option>
                                                    ";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah </label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="keperluan">Keperluan </label>
                                <input type="text" class="form-control" id="keperluan" name="keperluan">
                            </div>
                            <div class="form-group">
                                <label for="status">Status </label>
                                <input type="text" class="form-control" id="status" name="status">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">ID user</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="id_login">
                                    <option value="">--PILIH--</option>
                                    <?php
                                    if (mysqli_num_rows($result_user) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_user)) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['nama'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="button btn btn-primary" name="submit">
                            Kirim
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>