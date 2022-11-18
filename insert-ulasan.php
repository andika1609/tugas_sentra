<?php
    include 'function.php';

    if(isset($_POST['button'])){
        $id = (isset($_POST['id'])) ? $_POST['id'] :"";
        $nilai = (isset($_POST['nilai'])) ? $_POST['nilai'] :"";
        $ulasan = (isset($_POST['ulasan'])) ? $_POST['ulasan'] :"";
        $run=mysqli_query($conn,"UPDATE `status_aspirasi` SET `nilai`=$nilai,`ulasan`='$ulasan' WHERE `id_laporan`=$id;");
        if($run){
            header('location:view-selesai.php');
        }
    }
?>