<?php
require_once 'connect_db.php';

$isUser = $_SESSION['id'];
$show = $con->query("SELECT * FROM folders");

    $idadd = 1;
    $count = $show->num_rows;
    while ($row = $show->fetch_assoc()){
        $idelement = $row['idfolders'];
        if (($idelement != 1) && ($idadd == 1)){
            //echo "первого элемента просто не существует, вставляем новый туда <br>";
            break;
        }
        else if (($idelement != $idadd)){
            //echo "элемента $idadd просто не существует, вставляем новый сюда <br>";
            break;
        }
        //echo "'$idelement' <br>";
        $idadd++;
    }

$folder_name = $_POST['folder_name'];
if (isset($_POST['privacy'])) 
    $privacy = 1;  
else
    $privacy = 0;
    
if ($folder_name != null){
    $add = $con->prepare("INSERT INTO folders (idfolders, folder_name, privacy, description, user_iduser) VALUES ($idadd, ?, ?, NULL, $isUser)");
    $add->bind_param("ss", $folder_name, $privacy);
    $add->execute();
    header("Location:../account.phtml");
}
else{
    echo "введите название добавляемой папки";
}

?>