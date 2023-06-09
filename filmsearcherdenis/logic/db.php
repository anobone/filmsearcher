<?php
require 'connect_db.php';

// Поиск по заголовкам
function SearchInTitle($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT 
        p.*, u.username
        FROM $table1 AS p
        JOIN $table2 AS u
        ON p.id_user = u.id
        WHERE p.status=1
        AND p.title LIKE '%text%'";
    $query = $pdo->prepare($sql);
    $query -> execute();
    dbCheckError($query);
    return $query -> fetchAll();
}
function update($table, $id, $params){
    global $con;
    $i = 0;
    $str='';
    foreach($params as $key => $value){
        if($i === 0){
            $str=$str . $key . " = '" . $value . "'";
        }else {
            $str=$str . ", " . $key . "= '" . $value . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE id = $id;";
    exit();
    $query = $con ->prepare($sql);
    $query -> execute($params);
}