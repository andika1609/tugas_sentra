<?php
include 'function.php';

if (isset($_POST['btn'])) {
    $nik = (isset($_POST['nik'])) ? $_POST['nik'] : "";
    $nama = (isset($_POST['nama'])) ? $_POST['nama'] : "";
    $divisi = (isset($_POST['divisi'])) ? $_POST['divisi'] : "";
    $keluhan = (isset($_POST['keluhan'])) ? $_POST['keluhan'] : "";



    $imgname = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    if ($imgname) {
        if ($error === 0) {
            $imgex = pathinfo($imgname, PATHINFO_EXTENSION);

            $img_ex_lc = strtolower($imgex);

            $allowed_exs = array('png', 'jpeg', 'jpg');

            if (in_array($img_ex_lc, $allowed_exs)) {
                $newimgname = uniqid("image-" . "_", true) . "." . $img_ex_lc;
                echo $newimgname . '<br>';

                $image_upload_path = 'uploads/' . $newimgname;
                $move = move_uploaded_file($tmp_name, $image_upload_path);

                if ($move) {
                    $sql = "INSERT INTO `input_aspirasi`(`id_pelapor`, `jenis_aspirasi`, `laporan`, `waktu_laporan`, `gambar`) VALUES ('$nik','$divisi','$keluhan',CURRENT_TIMESTAMP,'$image_upload_path')";
                    $run = $conn->query($sql);
                    if ($run) {
                        $conn->query("SET @a =(SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_NAME= 'input_aspirasi' AND table_schema = 'pengaduan') -1;");

                        $conn->query("INSERT INTO `status_aspirasi`(
                            `id_laporan`,
                            `id_status`,
                            `status`,
                            `nilai`,
                            `ulasan`
                        )
                        VALUES(@a, DEFAULT, DEFAULT, NULL, NULL)");
                        header('location:main.php');
                    }
                }
            }
        }
    } else {
        $sql = "INSERT INTO `input_aspirasi`(`id_pelapor`, `jenis_aspirasi`, `laporan`, `waktu_laporan`) VALUES ('$nik','$divisi','$keluhan',CURRENT_TIMESTAMP)";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            $conn->query("SET @a =(SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_NAME= 'input_aspirasi' AND table_schema = 'pengaduan') -1;");

            $conn->query("INSERT INTO `status_aspirasi`(
                `id_laporan`,
                `id_status`,
                `status`,
                `nilai`,
                `ulasan`
            )
            VALUES(@a, DEFAULT, DEFAULT, NULL, NULL)");
            header('location:main.php');
        }
    }
}
seeErrror();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman utama</title>
    <link rel="shortcut icon" href="asset/logo-telkom-schools.png" type="image/*">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #80ED99;
        }

        #header {
            background-color: #22577A;
            width: 100%;
            height: fit-content;
            position: absolute;
            top: 0;
            color: #ffff;
        }

        .body {
            width: 30%;
            height: fit-content;
            margin: 4rem auto 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
            background-color: #38A3A5;
            border-radius: 5%;
        }

        .body .form {
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .inp {
            width: 100%;
        }

        #output {
            width: 120px;
            margin: 10px 0px;
        }

        @media only screen and (max-width: 600px) {
            .body {
                width: 87%;
                padding-left: 5%;
                padding-right: 5%;
                margin: 2rem auto 0 auto;

            }

            #output {
                width: 10rem;
                margin: 1rem 0px;
            }
        }

        /* @media only screen and (max-width: 872px) {
            .body {
                width: 60%;
            }
        } */
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="view.php">Keluhan masyarakat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="view.php">Home</a>
                    </li>
                </ul>

            </div>
            <div class="ms-3 text-end"><button class="btn btn-outline-danger" type="submit">Logout</button></div>
        </div>
    </nav>

    <div class="body py-3">
        <div class="form mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="">NIK</label>
                <div class="mt-2"></div>

                <input required type="text" class="inp" name="nik" id="" value="<?= $_SESSION['nik'] ?>">
                <div class="mt-2"></div>

                <label for="">Nama Lengkap</label>
                <div class="mt-2"></div>

                <input type="text" name="nama" class="inp" id="" value="<?= $_SESSION['username'] ?>">
                <div class="mt-2"></div>

                <label for="">Divisi</label>
                <div class="mt-2"></div>

                <div class="mt-2"></div>
                <select name="divisi" id="" class="inp">
                    <option value="" hidden selected>Pilih departemen</option>
                    <option value="1">Keamanan</option>
                    <option value="2">Kebersihan</option>
                </select>

                <div class="mt-2"></div>
                <label for="">Keluhan</label>

                <div class="mt-2"></div>
                <textarea name="keluhan" id="" class="inp" rows="2"></textarea>

                <div class="mt-2"></div>
                <input accept="image/*" name="gambar" type='file' onchange="loadFile(event)" class="inp" />
                <img id="output" />

                <div class="mt-3"></div>
                <button type="submit" name="btn" class="inp btn btn-success">Submit</button>
            </form>
        </div>

    </div>
</body>

</html>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>