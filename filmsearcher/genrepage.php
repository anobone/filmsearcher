<?php
include "logic/connect_db.php"
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once 'header.php'; ?>
</head>
<main style="background-color: #4d66aba1;">
    <div class="background">
        <?php
        $idgenre = $_GET['idgenre'];
        $query = $con->query("SELECT * FROM genres WHERE idgenre='$idgenre'");
        ?>
        <div style="padding-left: 20px; margin-bottom: 10px;">
            <?
            while($row = $query->fetch_assoc()){
                $idname= $row['name'];}
            echo "<h1 style='font-family: SansSerif; border-bottom: 3px solid #00000073; color:#00000094;'><b>$idname</b></h1>";
            ?>
        </div>
        <?
        $query2 = $con->query("SELECT * FROM films_genre WHERE genres_idgenre='$idgenre'");
        $check = $query2->num_rows;
        if (!$check)
            echo "<div style='margin: 20%;'>
                    <img src='картинки/not_found.png'>
                    <h3><b>По запросу ничего не найдено</b></h3>
                    </div>";
        while($row = $query2->fetch_assoc()){
            $idm= $row['media_idmedia'];
            $query3 = $con->query("SELECT * FROM media WHERE idmedia='$idm'");
            $check = $query3->num_rows;
            while($row = $query3->fetch_assoc()){

            $idmedia = $row['idmedia'];
            $show_img = base64_encode($row['image_cover']);
            $kate= $row['category_idcategory'];
            $title = $row['title'];
            $rating = $row['rating'];
            $release = date("Y",strtotime($row['release']));
            $description = $row['description'];

            $item_genres = $con->query("SELECT * FROM films_genre WHERE media_idmedia='$idmedia'");
            $gcheck=$item_genres->num_rows;
            ?>
            <a href="media.phtml?idmedia=<?php echo $idmedia;?>" class="link">
                <div class="one-item">
                    <table>
                        <tr>
                            <td>
                                <img class="poster" src="data:image/jpeg;base64, <?=$show_img?>" alt="">
                            </td>
                            <td>
                                <?
                                echo"
                              <p><b>$title /$release/</b></p>
                              <p><b>Жанры: </b>";
                                while($row = $item_genres->fetch_assoc()){
                                    $idgenre = $row['genres_idgenre'];
                                    $genre_tmp = $con->query("SELECT * FROM genres WHERE idgenre='$idgenre'");
                                    while($row = $genre_tmp->fetch_assoc()){
                                        $genre = $row['name'];
                                        if ($gcheck > 1) 
                                        {
                                            echo "<a href='genrepage.php?idgenre=$idgenre' class='blue-link'>$genre</a>, ";
                                            $gcheck--;
                                        }
                                        else echo "<a href='genrepage.php?idgenre=$idgenre' class='blue-link'>$genre</a>";
                                    }
                                }
                                echo"</p>
                              <p><b>Рейтинг: </b>$rating    </p>
                              
                              <b>Описание:</b>
                              <p>$description</p>
                              ";
                                ?>
                            </td>
                        </tr>
                    </table>
                </div></a>
            <?
        }
        }
        ?>
    </div>
</main>
</html>