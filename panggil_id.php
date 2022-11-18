<?php
    include 'function.php';
 
    $id=$_POST['id'];
    $stats=$_POST['stats'];
    switch ($stats) {
        case 'Dilaporkan':
            # code...
            $statsId=1;
            break;
        
        case 'Diproses':
            # code...
            $statsId=2;
            break;
        
        case 'Selesai':
            # code...
            $statsId=3;
            break;
        
        default:
            # code...
            break;
    }

    $queryResult=$conn->query("UPDATE `status_aspirasi` SET `status`='$stats',`id_status`='$statsId' WHERE `id_laporan`='$id'");

    if($queryResult){
        echo json_encode("Data dengan index-$id berhasil diupdate");
    }
    else{
        echo json_encode("Gagal update");
    }
?>