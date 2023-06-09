<?php
include "connect_db.php";

$search_item = $_GET['search'];

$sort = $_GET['sort'];
$show = $_GET['show'];

if (!empty($search_item))
{
    if (empty($sort) && empty($show))
    {
        $search_media = $con->query("SELECT * FROM media WHERE title LIKE '%$search_item%' ORDER BY rating DESC");
        $search_folder = $con->query("SELECT * FROM folders WHERE folder_name LIKE '%$search_item%' AND privacy = 0");
    }
    else
    {
        if (empty($_GET['sort'])) $sorting = "rating DESC";
        switch ($sort){
            case("rating"):
                $sorting = "rating DESC";
                break;
            case("date"):
                $sorting = "YEAR('release') DESC";
                break;
            case("alphabet"):
                $sorting = "title ASC";
                break;
        }
        switch ($show){
            case("collection"):
            case("all"):
            {
                $search_folder = $con->query("SELECT * FROM folders WHERE folder_name LIKE '%$search_item%' AND privacy = 0");
                //$search_media = $con->query("SELECT * FROM media WHERE title LIKE '%$search_item%' ORDER BY $sorting DESC");
                break;
            }
            case("film"):
                $showing = "AND category_idcategory = 1";
                break;
            case("series"):
                $showing = "AND category_idcategory = 2";
                break;
            case("anime"):
                $showing = "AND category_idcategory = 3";
                break;
        }
        //$show_me = "SELECT * FROM media WHERE title LIKE '%$search_item%' $showing ORDER BY $sorting";
        //echo "$show_me";
        //echo "SELECT * FROM media WHERE title LIKE '%$search_item%' $showing ORDER BY $sorting DESC";

        if ($show!="collection") $search_media = $con->query("SELECT * FROM media WHERE title LIKE '%$search_item%' $showing ORDER BY $sorting");
    }
}
?>