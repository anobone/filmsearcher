<?php
require_once 'connect_db.php';

    $idadd = 1;
    $folders = $con->query("SELECT * FROM folders");
    $count = $folders->num_rows;
    while ($row = $folders->fetch_assoc()){
        $idelement = $row['idfolders'];
        if (($idelement != 1) && ($idadd == 1)){
            echo "первого элемента просто не существует, вставляем новый туда <br>";
            break;
        }
        else if (($idelement != $idadd)){
            echo "элемента $idadd просто не существует, вставляем новый сюда <br>";
            break;
        }
        echo "'$idelement' <br>";
        $idadd++;
    }
?>