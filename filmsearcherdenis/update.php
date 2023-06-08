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

}
?>
<!DOCTYPE html>
<html>
<head>
    <? include 'header.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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

        <div>
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
                    <td><select style="width: 300px;"name="genreFROM">
                            <option disabled>Выберите жанр, который хотите заменить</option>
                            <option value="1">Фэнтези</option>
                            <option value="2">Детектив</option>
                            <option value="3">Приключения</option>
                            <option value="4">Семейный</option>
                            <option value="5">Биография</option>
                            <option value="6">Музыка</option>
                            <option value="7">Драма</option>
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
                    <td><select style="width: 300px;" name="genreUP" >
                            <option disabled>Выберите жанр,НА который хотите заменить</option>
                            <option value="1">Фэнтези</option>
                            <option value="2">Детектив</option>
                            <option value="3">Приключения</option>
                            <option value="4">Семейный</option>
                            <option value="5">Биография</option>
                            <option value="6">Музыка</option>
                            <option value="7">Драма</option>
                        </select></td>
                </tr>

                <tr><td><input style="width:300px;" type="submit" name="update-genre" value="Изменить"></td></tr>
            </table>
        </div>
    </form>
    <?php $id = $_GET['idmedia']; ?>
     <a href="media.phtml?idmedia=<? echo $id; ?>"><button style="border-radius:5px;background:rgba(248,90,90,0.39);color: white;border:3px solid rgba(128,128,128,0.26);font-family:SansSerif;">Вернуться к странице</button></a>
</div>
</body>
</html>