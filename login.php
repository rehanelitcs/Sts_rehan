<?php
require_once("database.php");
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['usernames'];
    if (cek_login($_POST['usernames'], $_POST['passwords'])) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        if ($_SESSION['role'] == "admin") {
            header("location:admin.php");
        } else {
            header("location:user.php");
        }
    } else {
        header("location:login.php?msg=gagal");
    }
}


// if(isset($_POST["submit"])){
//     $username = $_POST["usernames"];
//     $password = $_POST["passwords"];
//     $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
//     $result = mysqli_query($conn,$sql);
//     $rowcount = mysqli_num_rows($result);
//     if($rowcount == 1) {
//         header("location:home.php");
//     } else {
//         echo "gagal login";
//     }
// }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <div class="card mb-3 position-absolute top-50 start-50 translate-middle" style="max-width: 1000px;">
        <div class="row g-0">
            <div class="col-md-4 bg-secondary">
                <img src="" class="img-fluid rounded-start" alt="" width="600">
                <div class="description">
                    <h3></h3>
                </div>
            </div>
            <div class="col-md-8 bg-primary">
                <div class="card-body">
                    <div class="judul">
                        <h1>LOGIN</h1>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="usernames">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="passwords">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">oke</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark" type="submit" name="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    </body>

</html>