<?php
include "connect_db.php";

$search_item = $_POST['submit'];
$sort = $_POST['sort'];

$show_film = $_POST['show_film'];
$show_series = $_POST['show_series'];
$show_anime = $_POST['show_anime'];
$show_folder = $_POST['show_folder'];

if (isset($search_item))
{
    if (!isset($show_film) && !isset($show_series) && !isset($show_anime))
    {
        if ($sort == "title"){
            $sorting = "title";
        }
        else if ($sort == "release"){
            $sorting = "release";
        }
        else{
            $sorting = "rating";
        }
        if (isset($show_film)) {
            $cat = 1;
        }
        if (isset($show_series)) {
            $cat = 2;
        }
        if (isset($show_anime)) {
            $cat = 3;
        }
        $search_media = "SELECT * FROM media WHERE title LIKE '%'$search_item'%' AND category_idcategory='$cat' SORT BY '$sorting'";
        if (isset($show_folder)) {
            $search_folder = "SELECT * FROM folders WHERE folder_name LIKE '%'$search_item'%'";
        }
        //header("Location:../search.phtml");
    }
    else
    {
        echo "В прошлом выборе отметьте один или несколько пунктов";
    }
}
else
{
    echo "Пожалуйста, введите поисковый запрос";
}

$con->close();
?>