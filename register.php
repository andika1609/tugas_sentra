<?php
include 'function.php';


if (isset($_POST['btn'])) {
    $usn = (isset($_POST['username'])) ? $_POST['username'] : "";
    $pk = (isset($_POST['passkey'])) ? $_POST['passkey'] : "";

    $sql = "SELECT * FROM `admin` WHERE `username`='$usn' AND `passkey`='$pk'";
    $run = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($run);

    if ($num > 0) {
        header('location:admin_view.php');
    } else {
        $error = true;
    }
}else{
    $_SESSION['flash_message'] = "Login tidak berhasil";

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
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center py-1" role="alert">
                        Login failed
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <label for="">Username</label>
                    <br>
                    <input type="text" name="username" id="" placeholder="Masukan username">
                    <div class="mt-2"></div>

                    <label for="pass">Password</label><br>
                    <input type="password" name="passkey" id="passkey" placeholder="Masukan Password">
                    <div class="mt-2"></div>

                    <label for="pass">Password Confirmation</label><br>
                    <input type="password" name="passcon" id="passcon" placeholder="Masukan Password"><br>
                    <small class="text-danger fs-6" id="konfirm">Konfirmasi password salah</small>

                    <div class="mt-4"></div>
                    <div class="mx-auto mb-0" style="width:fit-content;">
                        <button name="btn" id="btn" type="submit" class=" btn btn-dark px-4">Register</button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="container">
                Sudah punya akun? <a href="login.php" class="text-decoration-none">Login</a>
            </div>
        </div>
    </div>

    <script>
        var conf = document.getElementById('konfirm');
        conf.style.display = "none";
        var passkey = document.getElementById('passkey');
        var passcon = document.getElementById('passcon');
        var btn = document.getElementById('btn');
        console.log(passkey);
        btn.disabled = true;
        passcon.addEventListener("keyup", function() {
            if (passkey.value != null && passcon.value != null) {
                if (passkey.value == passcon.value) {
                    btn.disabled = false;
                    conf.style.display = "none";
                } else {
                    conf.style.display = "block";
                    btn.disabled = true;
                }
            }
        });
        passkey.addEventListener("keyup", function() {
            if (passkey.value != null && passcon.value != null) {
                if (passkey.value == passcon.value) {
                    btn.disabled = false;
                } else {
                    btn.disabled = true;
                }
            }

        });
    </script>
</body>

</html>