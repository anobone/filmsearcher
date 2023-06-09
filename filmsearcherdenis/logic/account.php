<?php
require_once 'connect_db.php';

$nickname  = $_SESSION['nickname'];
$email  = $_SESSION['email'];
$psswd = $_SESSION['pass'];
$iduser = $_SESSION['id'];
$isAdmin = $_SESSION['isAdmin'];

$query = $con->query("SELECT * FROM folders WHERE user_iduser = '$iduser'");

?>