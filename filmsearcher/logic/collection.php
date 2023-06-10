<?php
require_once 'connect_db.php';

$idfolders = $_GET['idcollection'];
$isUser = $_SESSION['id'];

$folders_inf = $con->query("SELECT * FROM folders WHERE idfolders = '$idfolders'");
while($row = $folders_inf->fetch_assoc()){
    $folder_name = $row['folder_name'];
    $privacy = $row['privacy'];
    $description_f = $row['description'];
    $user_iduser  = $row['user_iduser'];
}

$folders_has_media = $con->query("SELECT media_idmedia FROM folders_has_media WHERE folders_idfolders='$idfolders'");

?>