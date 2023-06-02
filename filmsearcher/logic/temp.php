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

$carousel_img = $con->query("SELECT * FROM media WHERE idmedia IN (1,3,4)");

while($row = $carousel_img->fetch_assoc()) {
    $show_img = base64_encode($row['image_cover']);
    $id = $row['idmedia'];
    $name = $row['title']; ?>
    <a href="media.phtml?id=<?php echo $id;?>"><img src="data:image/jpeg;base64, <?=$show_img ?>" alt=""
        style="width: 440px;"></a>
    <?php
}

$con->close();
?>