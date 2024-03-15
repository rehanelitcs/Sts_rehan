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
                    <a href="from.barang.php" type="button" class="tambah btn btn-primary">Tambah</a>
                </div>
                <div class="container mt-4  ">
                    <div class="cobtainer">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM barang";
                                $sql = mysqli_query($konek, $query);
                                $no = 1;
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $no ?>
                                        </th>
                                        <td>
                                            <?php echo $data['kode_barang']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['nama_barang']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['kategori']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['merk']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['jumlah']; ?>
                                        </td>
                                        <td> <a href="edit.php?id=<?php echo $data['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg></a>
                                            <a href="delete.php?id=<?php echo $data['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                        </td>


                                    </tr>
                                <?php
                                    $no++;
                                } ?>
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