<?php
include 'function.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 0) {
        header("location:view.php");
    } else {
    }
} else {
    header("location:login.php");
}

if (isset($_GET['kategori'])) {
    if ($_GET['kategori'] == 'keamanan') {
        $kategori = 1;
    } else if ($_GET['kategori'] == 'kebersihan') {
        $kategori = 2;
    }
    $sql = "SELECT `input_aspirasi`.`id_pelaporan`,`penduduk`.`nama_penduduk`, `input_aspirasi`.`jenis_aspirasi`, `input_aspirasi`.`laporan`,`input_aspirasi`.`waktu_laporan`,`status_aspirasi`.`status`,`input_aspirasi`.`gambar` FROM `input_aspirasi`,`penduduk`,`status_aspirasi` WHERE `input_aspirasi`.`id_pelapor`=`penduduk`.`id_penduduk` AND `input_aspirasi`.`id_pelaporan`=`status_aspirasi`.`id_laporan` AND `input_aspirasi`.`jenis_aspirasi`=$kategori;";
    $run = $conn->query($sql);
    // $ = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT `input_aspirasi`.`id_pelaporan`,`penduduk`.`nama_penduduk`, `input_aspirasi`.`jenis_aspirasi`, `input_aspirasi`.`laporan`,`input_aspirasi`.`waktu_laporan`,`status_aspirasi`.`status`,`input_aspirasi`.`gambar` FROM `input_aspirasi`,`penduduk`,`status_aspirasi` WHERE `input_aspirasi`.`id_pelapor`=`penduduk`.`id_penduduk` AND `input_aspirasi`.`id_pelaporan`=`status_aspirasi`.`id_laporan`;";
    $run = $conn->query($sql);
    // $ = mysqli_query($conn, $sql);
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View all</title>
    <link rel="shortcut icon" href="asset/logo-telkom-schools.png" type="image/*">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/view.css">
    <script src="js/jquery-3.6.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="board sidenav" id="board1">
        <div class="page">
            <img src="asset/user.png" id="user">
        </div>
        <div class="coat mt-3">
            <p class="subid text-center fs-4 fw-bolder">Admin</p>
        </div>
    </div>

    <div class="board" id="board2">
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="view-admin.php">View</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="view-admin.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="">Link</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?kategori=keamanan">Keamanan</a></li>
                                <li><a class="dropdown-item" href="?kategori=kebersihan">Kebersihan</a></li>
                            </ul>
                        </li>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?status=keamanan">Dilaporkan</a></li>
                                <li><a class="dropdown-item" href="?status=kebersihan">Diproses</a></li>
                                <li><a class="dropdown-item" href="?status=selesai">Selesai</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                    <!-- <button id="inputAddres" class="btn btn-warning" onclick="window.location.href='index_2.php'"><i class="fas fa-history"></i></button> -->
                    <form action="" method="post">
                        <button type="submit" id="inputAddres" name="logout" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <?php
        while ($row = $run->fetch_assoc()) {
            $id = $row['id_pelaporan'];
            echo "<style>";
            include 'asset/css/view.css';
            echo "</style>";

        ?>
            <div class="mt-3"></div>

            <div class="container main py-2">
                <table>
                    <tr>
                        <td>Id</td>
                        <td class="px-1">:</td>
                        <td><?= $id; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td class="px-1">:</td>
                        <td>
                            <?= $row['nama_penduduk'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis laporan</td>
                        <td class="px-1">:</td>
                        <td>
                            <?php if ($row['jenis_aspirasi'] == 1) {
                                echo "Keamanan";
                            } ?>
                            <?php if ($row['jenis_aspirasi'] == 2) {
                                echo "Kebersihan";
                            } ?>
                            <!-- <?= $row['jenis_aspirasi']; ?> -->
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
                            <select name="sts" id="sts_<?= $id ?>" onchange="gantiSts(<?= $id ?>)">
                                <option <?php if ($row['status'] == "Dilaporkan") {
                                            echo "selected";
                                        } ?> value="Dilaporkan">Dilaporkan</option>
                                <option <?php if ($row['status'] == "Diproses") {
                                            echo "selected";
                                        } ?> value="Diproses">Diproses</option>
                                <option <?php if ($row['status'] == "Selesai") {
                                            echo "selected";
                                        } ?> value="Selesai">Selesai</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu laporan</td>
                        <td class="px-1">:</td>
                        <td>
                            <?= $row['waktu_laporan']; ?>
                        </td>
                    </tr>
                    <?php if ($row['gambar'] != null) { ?>
                        <tr>
                            <td>Gambar</td>
                            <td class="px-1">:</td>
                            <td>
                                <img src="<?php $row['gambar'] ?>" class="rounded mx-auto d-block" style="height: 5rem; width:fit-content">

                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Upload Image
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload bukti</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Bukti pengerjaan laporan</label>
                                    <input accept="image/*" class="form-control" type="file" id="formFile" onchange="loadFile(event)">
                                    <!-- <input accept="image/*" name="gambar" type='file' onchange="loadFile(event)" class="inp" /> -->

                                    <img id="output" class="mt-3 mx-auto" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="mb-5"></div>
    </div>
    <script type="text/javascript">
        function gantiSts(idx) {
            let stats = "sts_" + idx;
            var sts = document.getElementById(stats).value;
            console.log(sts);
            var id = idx;
            $.ajax({
                type: "POST",
                data: {
                    "id": id,
                    stats: sts
                },
                url: "panggil_id.php",
                success: function(result) {
                    alert(result);
                }
            })
        }
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // free memory
                output.style.height = "120px";
                output.classList.add("border");
                output.classList.add("border-primary");
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>