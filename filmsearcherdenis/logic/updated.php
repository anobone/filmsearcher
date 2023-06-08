<?php
require_once 'connect_db.php';
require_once 'db.php';

$tit = $_POST['title-for-up'];
$result = $con->query("SELECT * FROM `media` WHERE `title` = '$tit'");
while ($row = $result->fetch_assoc()) {
   $id = $row['idmedia'];
}


header("Location:../media.phtml?idmedia=$id");
?>