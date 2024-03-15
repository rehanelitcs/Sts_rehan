<?php
require_once('database.php');
$data = tampildata(
    "SELECT peminjaman.id, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.no_identitas, 
peminjaman.kode_barang, peminjaman.jumlah, peminjaman.keperluan, peminjaman.status,peminjaman.id_login
FROM peminjaman
INNER JOIN barang ON peminjaman.kode_barang = barang.kode_barang
INNER JOIN user ON peminjaman.id_login = user.id
"
);
$nomor = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<style>
    .table {
        margin-left: 120px;
        width: 1050px;
    }

    .tambah {
        margin-left: 20px;
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
                        <a class="nav-link" href="barang.php">Data Barang</a>
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
                <div class="table">
                    <a class="tambah btn btn-primary" href="form_peminjaman.php" role="button">Tambah data peminjaman</a>
                </div>
                <div class="container mt-4  ">
                    <div class="cobtainer">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal pinjam</th>
                                    <th scope="col">Tanggal kembali</th>
                                    <th scope="col">No identitas</th>
                                    <th scope="col">kode Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Keperluan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Id login</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $note) : ?>
                                    <?php $nomor++; ?>
                                    <tr>
                                        <th scope="row"><?= $nomor; ?></th>
                                        <td><?= $note["tgl_pinjam"]; ?></td>
                                        <td><?= $note["tgl_kembali"]; ?></td>
                                        <td><?= $note["no_identitas"]; ?></td>
                                        <td><?= $note["kode_barang"]; ?></td>
                                        <td><?= $note["jumlah"]; ?></td>
                                        <td><?= $note["keperluan"]; ?></td>
                                        <td><?= $note["status"]; ?></td>
                                        <td><?= $note["id_login"]; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <a role="button" class="btn btn-primary" href="edit_peminjam.php?id=<?= $note['id']; ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="javascript:hapusData(<?php echo $note['id']; ?>)" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script language="JavaScript" type="text/javascript">
            function hapusData(id) {
                if (confirm("Apakah anda yakin akan menghapus data ini?")) {
                    window.location.href = 'delete_peminjam.php?id=' + id;
                }
            }
        </script>
</body>

</html>