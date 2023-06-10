<?php
require_once 'connect_db.php';

if (isset($_POST['idcollection'])){
    $del_fol = $_POST['idcollection'];
    $fol_media = $con->prepare("DELETE FROM `folders_has_media` WHERE `folders_idfolders`='$del_fol'");
    $fol_media->execute();

    $fol = $con->prepare("DELETE FROM `folders` WHERE `idfolders`='$del_fol'");
    $fol->execute();

    header("Location:../account.phtml");
}
?>