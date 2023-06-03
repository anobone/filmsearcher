<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="filmsearcher";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Не получилось подключить базу данных' . mysqli_connect_error());
?>