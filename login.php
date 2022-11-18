<?php
include 'function.php';


if (isset($_POST['btn'])) {
    $usn = (isset($_POST['username'])) ? $_POST['username'] : "";
    $pk = (isset($_POST['passkey'])) ? $_POST['passkey'] : "";

    $sql = "SELECT * FROM `users` WHERE `username`='$usn' AND `passkey`='$pk'";
    $run = mysqli_query($conn, $sql);
    $get = $run->fetch_assoc();
    $num = mysqli_num_rows($run);

    $sql_2 = "SELECT * FROM `penduduk` WHERE `nama_penduduk` LIKE '$usn' AND `id_penduduk`='$pk'";
    $run_2 = mysqli_query($conn, $sql_2);
    $get_2 = $run_2->fetch_assoc();
    $num_2 = mysqli_num_rows($run_2);

    if ($num > 0) {
        if ($get['role'] == 0) {
            $_SESSION['username'] = $usn;
            $_SESSION['role'] = 0;
            header('location:view-admin.php');
        } else {
            $_SESSION['username'] = $usn;
            $_SESSION['role'] = 1;
            header('location:view.php');
        }
    } else if ($num_2 > 0) {
        $_SESSION['username'] = $get_2['nama_penduduk'];
        $_SESSION['nik'] = $get_2['id_penduduk'];
        $_SESSION['role'] = 1;
        header('location:view.php');
    } else {
        $_SESSION['flash_message'] = "Login tidak berhasil";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {
            background-color: #38A3A5;
        }
    </style>
</head>

<body>
    <div class="mx-auto mt-5" style="width: fit-content;">
        <div class="card p-3 pb-4" style="width: fit-content;">
            <div class="card-body">
                <h3 class="card-title text-center">Login</h3>
                <?php if (isset($_SESSION['flash_message'])) {
                    $message = $_SESSION['flash_message'];
                ?>
                    <div class="alert alert-danger text-center py-1" role="alert">
                        <?= $message ?>
                    </div>
                <?php unset($_SESSION['flash_message']);
                } ?>
                <form action="" method="post" >
                    <label for="usn">Nama Lengkap:</label>
                    <br>
                    <input type="text" name="username" id="usn" placeholder="Masukan username">
                    <div class="mt-2"></div>

                    <label for="pass">NIK</label><br>
                    <input type="text" name="passkey" id="pass" placeholder="Masukan Password">

                    <div class="mt-4"></div>
                    <div class="mx-auto mb-0" style="width:fit-content;">
                        <button name="btn" type="submit" class="btn btn-dark px-4">Submit</button>
                    </div>
                </form>
            </div>
            <!-- <hr>
            <div class="container">
                Belum punya akun? <a href="register.php" class="text-decoration-none">Register</a>
            </div> -->
        </div>
    </div>
</body>

</html>