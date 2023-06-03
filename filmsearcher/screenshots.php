<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                 
<div class="carousel-inner">

    <?
    $carousel_img = $con->query("SELECT * FROM images WHERE media_idmedia=".$_GET['idmedia']."");
    $check = 1;
    while($row = $carousel_img->fetch_assoc()) { 
        echo "$check";
        if ($check==1) {
            echo "<div class='carousel-item active'>";
            $check--;
        }
        else echo "<div class='carousel-item'>";
            $show_img = base64_encode($row['path']);
        ?>
        <img src="data:image/jpeg;base64, <?=$show_img ?>" class="d-block w-100" alt="<?=$title ?>">
        </div>
        <?php
    }
    ?>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>