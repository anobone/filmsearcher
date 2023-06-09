<?php
require_once 'connect_db.php';

$idcollection = $_POST['idcollection'];
$new_name = $_POST['new_name'];
$new_description = $_POST['new_description'];
$iduser = $_SESSION['id'];

if (isset($_POST['new_privacy'])) 
    $new_privacy = 1;  
else
    $new_privacy = 0;

if (mb_strlen($new_name, "UTF-8") > 40) 
    echo "<h2>Введите более короткое Название</h2>";
if (mb_strlen($new_description, "UTF-8") > 400) 
    echo "<h2>Введите более короткое Описание</h2>";
if ((mb_strlen($new_name, "UTF-8") <= 40) && (mb_strlen($new_description, "UTF-8") <= 400)){
    $edit = $con->query("UPDATE folders SET folder_name='$new_name', privacy='$new_privacy', description='$new_description' WHERE idfolders=$idcollection AND user_iduser=$iduser");
    header("Location:../collection.phtml?idcollection=$idcollection");
}
    
?>