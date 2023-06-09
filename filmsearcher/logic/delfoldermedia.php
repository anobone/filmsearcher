<?php
require_once 'connect_db.php';

if (isset($_POST['idmedia'])){
    $del_med = $_POST['idmedia'];
    $idcollection = $_POST['idcollection'];
    //echo "удалить из в = $idcollection, удалить что = $del_med";
    $fol_media = $con->prepare("DELETE FROM folders_has_media WHERE media_idmedia='$del_med' AND folders_idfolders='$idcollection'");
    $fol_media->execute();

    header("Location:../collection.phtml?idcollection=$idcollection");
}

?>