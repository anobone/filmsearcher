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
$lastid = $show->num_rows;
$show2 = $con->query("SELECT * FROM images");
$lastidimg = $show2->num_rows;


if(isset($_POST['insert'])) {

        if(!empty($_FILES['img_upload']['tmp_name'])) $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
        if(!empty($_FILES['imges_upload']['tmp_name'])) $imges = addslashes(file_get_contents($_FILES['imges_upload']['tmp_name']));

        $add = $con->prepare("INSERT INTO `media` (`idmedia`, `title`,`image_cover`, `release`, `rating`, `description`, `trailer`, `category_idcategory`) VALUES ( '$lastid'+5, '$title','$img' , '$date', '$rate', '$description', '$trailer', '$kate')");
        $add->execute();

       // $addimg =$con->prepare("INSERT INTO `images`(`idimage`, `path`, `media_idmedia`) VALUES (,'$imges','$lastid'+5)");
        //$addimg->execute();
        mysqli_query($con,"INSERT INTO `images`(`idimage`, `path`, `media_idmedia`) VALUES ('$lastidimg'+5,'$imges','$lastid'+5)");

        foreach($genre as $i){
            $genre = $i;
            mysqli_query($con,"INSERT INTO `films_genre` (`media_idmedia`, `genres_idgenre`) VALUES ('$lastid'+5, '$genre')");
        }

    header("Location:../account.phtml");


}

$con->close();
?>