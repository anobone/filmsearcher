<?php
require 'logic/connect_db.php';
 ?>
<!DOCTYPE html>
<html>
    <head>
        <? include 'header.php'; ?>
    </head>
    <body>
        <div class="insert" style="margin-left: auto; margin-right: auto; width:400px; padding: 70px;">
            <form name="form-insert" enctype="multipart/form-data" action="logic/ins.php" method="POST">
                <? 
                if ($_SESSION['isAdmin'] != 1) 
                    echo"<h4 style='text-align: center;'>Эта страница вам недоступна</h4>"; 
                else{
                    ?>
                <h4>ДОБАВЛЕНИЕ ЭЛЕМЕНТА</h4>
                <div>
                    <label for="title">Название</label>
                    <input type="text" class="input-file" style="width 300px; height: 45px;" placeholder="Введите название" name="title" required>
                </div>
                <div>
                    <label for="description">Описание</label>
                    <textarea type="text" class="input-file" style="width 300px; height: 45px;" placeholder="Введите..." name="description" required></textarea>
                </div>

                <div>
                    <label for="kate">Выберите категорию</label>
                    <select name="kate"  class ="input-file" style="width 300px; height: 70px;"  required>
                        <option value="1"> Фильмы - 1</option>
                        <option value="2"> Сериалы - 2</option>
                        <option value="3"> Аниме - 3</option>
                    </select>
                </div>

                <div>
                    <label for="genre">Выберите жанры</label>
                    <select name="genre[]" multiple class ="input-file" style="width 300px; height: 156px;" required>
                        <? 
                            $gnr = $con->query("SELECT * FROM genres");
                            while($row = $gnr->fetch_assoc()){
                                $gnr_name = $row['name'];
                                $gnr_id = $row['idgenre'];
                                echo "<option value='$gnr_id'>$gnr_name</option>";
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="date">Датa</label>
                    <input type="date" class="input-file" style="width 300px; height: 45px;" name="date" required>
                </div>
                <div>
                    <label for="rate">Рейтинг</label>
                    <input type="number" min="1" max="10" step="0.1" class="input-file" style="width 300px; height: 45px;" placeholder="Введите рейтинг" name="rate" required>
                </div>
                <div>
                    <label for="trailer">Трейлер</label>
                    <input type="text" class="input-file" style="width 300px; height: 45px;" placeholder="Введите URL" name="trailer" required>
                </div>
                <div>
                    <label for="imges_upload">Изображение</label>
                    <input type="file"  class="input-file" style="width 300px; height: 45px;" name="imges_upload" >
                </div>
                <div>
                    <label for="img_upload">Обложка</label>
                    <input type="file"  class="input-file" style="width 300px; height: 45px;" name="img_upload" required >
                </div>
                <input type="submit" value="Добавить" style="margin-top: 15px; width: 300px;" type="submit" class="btn btn-dark" name="insert"></input>
            </form>
            <? } ?>
        </div>
    </body>
</html>