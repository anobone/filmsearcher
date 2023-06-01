<?php
require_once 'connect_db.php';

$name  = $_POST['name'];
$email  = $_POST['email'];
$psswd = $_POST['psswd'];
$isAdmin = 0;

$result = $con->query("SELECT * FROM user WHERE email = '$email'");
$check=$result->num_rows;

$show = $con->query("SELECT * FROM user");
$lastid = $show->num_rows;

if($email!="" and $psswd!="" and $name!="")
{
    if ($check == 0)
    {
        $add = $con->prepare("INSERT INTO user (iduser, nickname, email, password, isAdmin) VALUES ($lastid + 1, '$name', '$email', '$psswd', $isAdmin)");
        $add->execute();
        $_SESSION['auth'] = true;
        header("Location:../index.phtml");
    }
    else
    {
        $_SESSION['auth'] = false;
        echo "Такой пользователь уже есть";
    }
}

$con->close();
?>