<?php
require_once 'connect_db.php';

$email  = $_POST['email'];
$psswd = $_POST['psswd'];

if($email!="" and $psswd!="")
{
    $result=$con->query("SELECT * FROM user WHERE email='$email' AND password='$psswd'");

    $count=$result->num_rows;

    if($count==1)
    {
        foreach($result as $row) {
            $_SESSION['id'] = $row["iduser"];
            $_SESSION['isAdmin'] = $row["isAdmin"];
        }
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $psswd;
        $_SESSION['auth'] = true;
        header("Location:../index.phtml");
    }
    else {
        $_SESSION['auth'] = false;
        echo "Неверный логин или пароль";
    }
}
$con->close();
?>