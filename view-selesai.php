<?php
include 'function.php';
cek_login();
$sql = "SELECT `input_aspirasi`.`id_pelaporan`,`penduduk`.`nama_penduduk`, `input_aspirasi`.`jenis_aspirasi`, `input_aspirasi`.`laporan`,`input_aspirasi`.`waktu_laporan`,`status_aspirasi`.`status`,`input_aspirasi`.`gambar`, `input_aspirasi`.`id_pelapor`, `status_aspirasi`.`nilai` FROM `input_aspirasi`,`penduduk`,`status_aspirasi` WHERE `input_aspirasi`.`id_pelapor`=`penduduk`.`id_penduduk` AND `input_aspirasi`.`id_pelaporan`=`status_aspirasi`.`id_laporan` AND `status_aspirasi`.`id_status`=3;";
$run = mysqli_query($conn, $sql);

if (isset($_POST['logout'])) {
    logout();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Selesai</title>
    <link rel="shortcut icon" href="asset/logo-telkom-schools.png" type="image/*">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/view.css">
    <link rel="shortcut icon" href="asset/logo-telkom-schools.png" type="image/*">

</head>

<body>
    <div class="board sidenav" id="board1">
        <div class="page">
            <img src="asset/user.png" id="user">
        </div>
        <div class="coat">
            <p class="subid">NIK: <?= $_SESSION['nik'] ?></p>
            <p class="subid">Nama: <?= ucwords(strtolower($_SESSION['username'])) ?></p>
        </div>
    </div>

    <div class="board" id="board2">
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <span class="navbar-brand">View</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="mb-2 mb-lg-0 d-lg-none d-flex">
                        NIK: <?= $_SESSION['nik'] ?>
                    </div>
                    <div class="mb-2 mb-lg-0 d-lg-none d-flex">
                        Nama: <?= ucwords(strtolower($_SESSION['username'])) ?>
                    </div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="view.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="view-selesai.php">Selesai</a>
                        </li>
                    </ul>
                    <!-- <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                    <div class="mb-3 mb-lg-0">
                        <a href="form.php">
                            <button id="inputAddres" class="btn btn-outline-primary me-3">Input</button>
                        </a>
                    </div>
                    <div class="mb-2 mb-lg-0 ">
                        <form action="" method="post">
                            <button class="btn btn-outline-danger" type="submit" name="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <?php
        while ($row = mysqli_fetch_assoc($run)) {
            $id = $row['id_pelaporan'];
            echo "<style>";
            include 'asset/css/view.css';
            echo "</style>";
            if ($row['id_pelapor'] == $_SESSION['nik']) {
        ?>
                <div class="mt-3"></div>

                <div class="container main py-2">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td class="px-1">:</td>
                            <td>

                                <?= ucwords(strtolower($row['nama_penduduk']))  ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis laporan</td>
                            <td class="px-1">:</td>
                            <td>
                                <?php if ($row['jenis_aspirasi']==1){ ?>
                                    Keamanan

                                <?php }else if ($row['jenis_aspirasi']==2){ ?>
                                    Kebersihan

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Laporan</td>
                            <td class="px-1">:</td>
                            <td>
                                <?= $row['laporan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td class="px-1">:</td>
                            <td>
                                <span id="sts_<?= $id ?>"><?= $row['status']; ?></span>
                            </td>
                        </tr>
                        <?php if ($row['nilai'] === null) { ?>
                            <tr id="review_<?= $id ?>">
                                <td colspan="3" class="mt-1">
                                    <form action="insert-ulasan.php" method="post">
                                        <textarea class="ps-1" cols="30" name="ulasan" id="" placeholder="Masukan ulasan"></textarea>
                                        <br>
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <input type="radio" name="nilai" id="" value="1" class="radio">Bagus

                                        <input type="radio" name="nilai" id="" value="0" class="radio">Tidak Bagus
                                        <br>
                                        <button name="button" type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>
                                </td>
                            </tr>
                        <?php }else{}?>
                    </table>
                </div>

                <script>
                    var sts_<?= $id ?> = document.getElementById('sts_<?= $id ?>');
                    if (sts_<?= $id ?>.textContent == "Selesai") {
                        document.getElementById('review_<?= $id ?>').style.removeProperty("display");
                    } else {
                        document.getElementById('review_<?= $id ?>').style.display = "none";
                    }
                </script>
        <?php }
        } ?>
        <div class="mb-5"></div>
    </div>
    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>