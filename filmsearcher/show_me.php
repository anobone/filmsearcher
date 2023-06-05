<?php
include "connect_db.php";

$search_item = $_POST['submit'];
$sort = $_POST['sort'];

$show_folder = $_POST['show_folder'];
$show_genre = $_POST['show_genre'];
$show_film = $_POST['show_film'];
$show_series = $_POST['show_series'];
$show_anime = $_POST['show_anime'];

if (isset($search_item) || (!isset($show_genre) && !isset($show_film) && !isset($show_series) && !isset($show_anime)))
{
    if ($sort == "title"){
        $sorting = "SORT BY title";
    }
    else if ($sort == "release"){
        $sorting = "SORT BY release";
    }
    else{
        $sorting = "SORT BY rating";
    }

    if (isset($show_genre)){
        $search_genre = "SELECT media_idmedia FROM films_genre WHERE genres_idgenre LIKE '%"$search_item"%'";
        $checkg = $search_genre->num_rows;
    }
    else {
        $search_media = "SELECT * FROM media WHERE title LIKE '%"$search_item"%'";
        $checkm = $search_media->num_rows;
    }
    if (isset($show_folder)) {
        $search_folder = "SELECT * FROM folders WHERE folder_name LIKE '%"$search_item"%'";
        $checkf = $search_media->num_rows;
    }
}
else
{
    echo "Удостоверьтесь в своем запросе, так мы не сможем ничего найти :("
}


$con->close();
?>