<?php
require 'logic/connect_db.php';
?>
<?php
$idmedia = $_GET['idmedia'];
$id=$_GET['idmedia'];
$query = $con->query("SELECT * FROM media WHERE idmedia = '$idmedia'");
$check = $query->num_rows;

while ($row = $query->fetch_assoc()) {

    $idmedia = $row['idmedia'];
    $show_img = base64_encode($row['image_cover']);
    $title = $row['title'];
    $rating = $row['rating'];
    $trailer = $row['trailer'];
    $release = date("Y", strtotime($row['release']));
    $description = $row['description'];
    $kate = $row['category_idcategory'];

    $item_genres = $con->query("SELECT * FROM films_genre WHERE media_idmedia='$idmedia'");
    $gcheck = $item_genres->num_rows;
    $gnr = $con->query("SELECT * FROM genres");
}
?>
<!DOCTYPE html>
<html>
<head>
    <? include 'header.php'; ?>
    <style>
        table {
            width: 100%;
            margin-bottom: 20px;
            border: 16px solid #ededee;
            border-collapse: separate;
            table-layout: auto;
            background: #ededee;
            text-align: left;
            font-family: sans-serif;
            border-radius: 25px;
        }
        th {
            font-weight: bold;
            padding: 5px;
            background: #ededee;
            border: 1px solid #ededee;
            text-align: center;
            font-size: 18px;
        }
        td {
            border: 5px solid #ededee;
            padding: 10px;
            background: rgba(215, 211, 211, 0.42);
            border-radius: 10px;

        }
        .poster-cell {
            width: 315px;
            height: 390px;
        }
        .poster {
            width:250px;
            margin-left: 30px;
        }


    </style>
</head>
<body style="background:rgba(136,136,213,0.57)">
    <?
    if ($_SESSION['isAdmin'] != 1) 
        echo"<h4 style='text-align: center; padding-top: 20px;'>Эта страница вам недоступна</h4>"; 
    else{
    ?>
    <div class="update" style=" width:200px; padding: 20px;">
        <form name="form-update"   enctype="multipart/form-data"  method="POST">
            <div>
                <table>
                    <tr>
                        <th style="border-top-left-radius: 20px;">Название</th>
                        <th>Обложка</th>
                        <th>Год</th>
                        <th>Описание</th>
                        <th>Трейлер</th>
                        <th>Категория</th>
                        <th>Рейтинг</th>
                    </tr>
                    <tr>
                        <td><?php echo "$title"; ?></td>
                        <td  class="poster-cell"><div><img class="poster" src="data:image/jpeg;base64, <?=$show_img?>" alt=""></div></td>
                        <td><?php echo "$release"; ?></td>
                        <td><?php echo "$description"; ?></td>
                        <td><?php echo "$trailer"; ?></td>
                        <td><?php  switch ($kate) {
                                case 1:
                                    echo "Фильмы";
                                    break;
                                case 2:
                                    echo "Сериалы";
                                    break;
                                case 3:
                                    echo "Аниме";
                                    break;
                            } ?></td>
                        <td><?php echo"$rating";?></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="update-title" value="Изменить"> </td>
                        <?php
                        $titleup = $_POST['title-for-up'];
                        if(isset($_POST['update-title'])) {
                            mysqli_query($con,"UPDATE media SET title = '$titleup' WHERE idmedia = $idmedia;");
                        }

                        ?>
                        <td><input type="submit"  name="update-img" value="Изменить"></td>
                        <?php
                        if(!empty($_FILES['img-for-up']['tmp_name'])) $img = addslashes(file_get_contents($_FILES['img-for-up']['tmp_name']));
                        if(isset($_POST['update-img'])) {
                            mysqli_query($con,"UPDATE `media` SET `image_cover` = '$img' WHERE `idmedia` = '$idmedia'");

                        }
                        ?>
                        <td><input type="submit" name="update-date" value="Изменить"></td>
                        <?php
                        $dateup = $_POST['date-for-up'];
                        if(isset($_POST['update-date'])) {
                        mysqli_query($con,"UPDATE `media` SET `release` = '$dateup' WHERE `idmedia` = '$idmedia'");
                        }
                        ?>
                        <td><input type="submit" name="update-description" value="Изменить"></td>
                        <?php
                        $desup = $_POST['description-for-up'];
                        if(isset($_POST['update-description'])) {
                            mysqli_query($con,"UPDATE `media` SET `description` = '$desup' WHERE `idmedia` = '$idmedia'");
                        }
                        ?>
                        <td><input type="submit" name="update-trailer" value="Изменить"></td>
                        <?php
                        $trai = $_POST['trailer-for-up'];
                        if(isset($_POST['update-trailer'])) {
                            mysqli_query($con,"UPDATE `media` SET `trailer` = '$trai' WHERE `idmedia` = '$idmedia'");
                        }
                        ?>
                        <td><input type="submit" name="update-kate" value="Изменить"></td>
                        <?php
                        $kateup = $_POST['kate-for-up'];
                        if(isset($_POST['update-kate'])) {
                            mysqli_query($con,"UPDATE `media` SET `category_idcategory` = '$kateup' WHERE `idmedia` = '$idmedia'");
                        }
                        ?>
                        <td><input type="submit" name="update-rate" value="Изменить"></td>
                        <?php
                        $rate = $_POST['rate-for-up'];
                        if(isset($_POST['update-rate'])) {
                            mysqli_query($con,"UPDATE `media` SET `rating` = '$rate' WHERE `idmedia` = '$idmedia'");
                        }
                        ?>
                    </tr>

                    <tr>
                        <td><input type="text" name="title-for-up"></td>

                        <td><input type="file" name="img-for-up"></td>
                        <td><input type="date" name="date-for-up"></td>
                        <td><textarea type="text" name="description-for-up"></textarea></td>
                        <td><input type="text" name="trailer-for-up"></td>
                        <td><select name="kate-for-up">
                                <option value="1">Фильмы</option>
                                <option value="2">Сериалы</option>
                                <option value="3">Аниме</option>
                            </select></td>
                        <td><input type="number" min="1" max="10" step="0.1" name="rate-for-up"></td>
                    </tr>

                </table>

            </div>

                <div style="width:400px;">
                    <table style="width:400px;">
                        <tr>
                            <th>Жанры</th>
                        </tr>

                        <tr>
                            <td>  <?
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
                                }?></td>
                        </tr>

                        <tr>
                            <td><select style="width: 400px;"name="genreFROM">
                                    <option disabled selected>Выберите жанр, который хотите заменить</option>
                                    <? 
                                    while($row = $gnr->fetch_assoc()){
                                        $gnr_name = $row['name'];
                                        $gnr_id = $row['idgenre'];
                                        echo "<option value='$gnr_id'>$gnr_name</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>

                        <?php
                        $genreFROM = $_POST['genreFROM'];
                        $genreUP = $_POST['genreUP'];
                        if(isset($_POST['update-genre'])) {
                            mysqli_query($con,"UPDATE `films_genre` SET `genres_idgenre`='$genreUP' WHERE `genres_idgenre` = '$genreFROM' AND `media_idmedia` = '$idmedia'");
                        }
                        ?>

                        <tr>
                            <td><select style="width: 400px;" name="genreUP" >
                                    <option disabled selected>Выберите жанр, НА который хотите заменить</option>
                                    <? 
                                    $gnr = $con->query("SELECT * FROM genres");
                                    while($row = $gnr->fetch_assoc()){
                                        $gnr_name = $row['name'];
                                        $gnr_id = $row['idgenre'];
                                        echo "<option value='$gnr_id'>$gnr_name</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>

                        <tr><td><input style="width:400px;border-radius:10px;border:2px solid rgba(150,148,148,0.27);font-family:SansSerif;" type="submit" name="update-genre" value="Изменить"></td></tr>
                    </table>

                    <table>
                        <tr>
                            <th>Добавление изображения в карусель</th>
                        </tr>

                        <tr>
                            <td><input style="" type="file" name="img-for-add"></td>
                        </tr>

                        <tr>
                            <td><input style="width:300px;border-radius:20px;border:2px solid rgba(150,148,148,0.27);padding:7px; margin-left:50px;margin-right:50px;background:#65eab4;font-family:SansSerif;font-size:18px;color:#7c7878;" type="submit" name="add-img" value="Добавить"></td>
                            <?
                            if(isset($_POST['add-img'])){
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
                                if(!empty($_FILES['img-for-add']['tmp_name'])) $imges = addslashes(file_get_contents($_FILES['img-for-add']['tmp_name']));
                                mysqli_query($con,"INSERT INTO `images`(`idimage`, `path`, `media_idmedia`) VALUES ('$idaddimg','$imges','$idmedia')");
                            }
                            ?>
                        </tr>
                    </table>
                </div>
            </form>
            <?php $id = $_GET['idmedia']; ?>
            <a href="media.phtml?idmedia=<? echo $id; ?>"><button style="border-radius:5px;background:rgba(248,90,90,0.39);color: white;border:3px solid rgba(128,128,128,0.26);font-family:SansSerif;">Вернуться к странице</button></a>
    </div>
    <? } ?>
</body>
</html>