<?php
require_once 'connect_db.php';

if (isset($_POST['to_folder'])){
    $idfolder = $_POST['to_folder'];
    $idmedia = $_POST['idmedia'];
    $iduser = $_SESSION['id'];
    //echo "вставить в = $idfolder, вставить что = $idmedia <br>";
    if ($idfolder!= "new")
        $fol_media = $con->query("INSERT INTO folders_has_media (folders_idfolders, media_idmedia) VALUES ('$idfolder', '$idmedia')");
    else{
        $folder_count = 1;
        $count_folders = $con->query("SELECT * FROM folders");
        $idadd = 1;
        $count = $count_folders->num_rows;
        while ($row = $count_folders->fetch_assoc()){
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
        $newfolders = $con->query("SELECT * FROM folders WHERE folder_name LIKE '%новая подборка%' AND user_iduser='$iduser'");
        $folder_count += $newfolders->num_rows;
        $folder_name = "Новая подборка";
        //echo "мы вставляем '$folder_name $folder_count', потому что у нас уже есть $folder_count подборок";
        $fol_user = $con->query("INSERT INTO folders (idfolders, folder_name, privacy, description, user_iduser) VALUES ($idadd, '$folder_name $folder_count', '0', NULL, '$iduser')");
        $fol_media = $con->query("INSERT INTO folders_has_media (folders_idfolders, media_idmedia) VALUES ($idadd, '$idmedia')");
    }

    header("Location:../media.phtml?idmedia=$idmedia");
}
?>