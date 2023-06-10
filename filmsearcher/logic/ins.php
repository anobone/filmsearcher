<?php
require_once 'connect_db.php';

$title  = trim($_POST['title']);
$description = trim($_POST['description']);
$kate = $_POST['kate'];
$genre = $_POST['genre'];
$date = $_POST['date'];
$trailer = trim($_POST['trailer']);
$rate=$_POST['rate'];

$show = $con->query("SELECT * FROM media");
$idadd = 1;
$count = $show->num_rows;
while ($row = $show->fetch_assoc()){
    $idelement = $row['idmedia'];
    if (($idelement != 1) && ($idadd == 1)){
        break;
    }
    else if (($idelement != $idadd)){
        break;
    }
    $idadd++;
}

$show2 = $con->query("SELECT * FROM images");
$idaddimg = 1;
$count = $show2->num_rows;
while ($row = $show2->fetch_assoc()){
    $idelement = $row['idimage'];
    if (($idelement != 1) && ($idaddimg == 1)){
        break;
    }
    else if (($idelement != $idaddimg)){
        break;
    }
    $idaddimg++;
}

if(isset($_POST['insert'])) {

        if(!empty($_FILES['img_upload']['tmp_name'])) $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));

        $add = $con->prepare("INSERT INTO `media` (`idmedia`, `title`,`image_cover`, `release`, `rating`, `description`, `trailer`, `category_idcategory`) VALUES ( '$idadd', '$title','$img' , '$date', '$rate', '$description', '$trailer', '$kate')");
        $add->execute();

        if(!empty($_FILES['imges_upload']['tmp_name'])){
            $imges = addslashes(file_get_contents($_FILES['imges_upload']['tmp_name']));
            mysqli_query($con,"INSERT INTO `images`(`idimage`, `path`, `media_idmedia`) VALUES ('$idaddimg','$imges','$idadd')");
        }

        foreach($genre as $i){
            $genre = $i;
            mysqli_query($con,"INSERT INTO `films_genre` (`media_idmedia`, `genres_idgenre`) VALUES ('$idadd', '$genre')");
        }

    header("Location:../account.phtml");
}

$con->close();
?>