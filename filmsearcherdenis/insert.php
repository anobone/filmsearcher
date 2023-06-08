<?php
require 'logic/connect_db.php';
 ?>
<!DOCTYPE html>
<html>
        <head>
            <? include 'header.php'; ?>
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        </head>
        <body>
        <div class="insert" style="margin-left: auto; margin-right: auto; width:400px; padding: 70px;">
            <form name="form-insert" enctype="multipart/form-data" action="logic/ins.php" method="POST">
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
                    <select name="genre[]" multiple class ="input-file" style="width 300px; height: 156px;"  >
                        <option value="1"> Фэнтези</option>
                        <option value="2"> Детектив</option>
                        <option value="3"> Приключения</option>
                        <option value="4"> Семейный</option>
                        <option value="5"> Биография</option>
                        <option value="6"> Музыка</option>
                        <option value="7"> Драма</option>
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
                    <label for="img_upload">Изображение</label>
                    <input type="file"  class="input-file" style="width 300px; height: 45px;" name="img_upload" required >
                </div>
                <input type="submit" value="Добавить" style="margin-top: 15px; width: 300px;" type="submit" class="btn btn-dark" name="insert"></input>
            </form>
        </div>
        </body>
</html>