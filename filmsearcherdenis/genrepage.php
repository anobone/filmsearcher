<?php
include "logic/connect_db.php"
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once 'header.php'; ?>
</head>
<main style="background-color: #99b1eabf;">
    <div class="background">
        <?php
        $idgenre = $_GET['idgenre'];
        $query = $con->query("SELECT * FROM genres WHERE idgenre='$idgenre'");
        ?>
        <div style="padding-left: 20px; margin-bottom: 10px;">
            <?
            switch ($idgenre) {
                case 1:
                    echo "<h1><b>Фэнтези</b></h1>";
                    break;
                case 2:
                    echo "<h1><b>Детектив</b></h1>";
                    break;
                case 3:
                    echo "<h1><b>Приключения</b></h1>";
                    break;
                case 4:
                    echo "<h1><b>Семейный</b></h1>";
                    break;
                case 5:
                    echo "<h1><b>Биография</b></h1>";
                    break;
                case 6:
                    echo "<h1><b>Музыка</b></h1>";
                    break;
                case 7:
                    echo "<h1><b>Драма</b></h1>";
                    break;
            }
            ?>
        </div>
        <?
        $query2 = $con->query("SELECT * FROM films_genre WHERE genres_idgenre='$idg'");
        $check = $query2->num_rows;
        if (!$check)
            echo "<div style='margin: 20%;'>
                    <img src='картинки/not_found.png'>
                    <h3><b>По запросу ничего не найдено</b></h3>
                    </div>";
        while($row = $query->fetch_assoc()){
            $idm= $row['media_idmedia'];}
        $query3 = $con->query("SELECT * FROM media WHERE idmedia='$idm'");
        $check = $query3->num_rows;
        while($row = $query3->fetch_assoc()){

            $idmedia = $row['idmedia'];
            $show_img = base64_encode($row['image_cover']);
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
                                            echo "$genre, ";
                                            $gcheck--;
                                        }
                                        else echo "$genre";
                                    }
                                }
                                echo"</p>
                              <p><b>Рейтинг: </b>$rating</p>
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
        ?>
    </div>
</main>
</html>