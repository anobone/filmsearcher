<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                 
<div class="carousel-inner">
    <div class="carousel-item active">
        <img src="картинки/our_choice.jpg" class="d-block w-100" alt="...">
    </div>
    <?
    $carousel_img = $con->query("SELECT * FROM media WHERE idmedia IN (1,3,4)");
    while($row = $carousel_img->fetch_assoc()) { ?>
        <div class="carousel-item"> 
        <?
            $show_img = base64_encode($row['image_cover']);
            $id = $row['idmedia'];
            $name = $row['title']; 
        ?>
        <a href="media.phtml?id=<?php echo $id;?>"><img src="data:image/jpeg;base64, <?=$show_img ?>" class="d-block w-100" alt="..."></a>
        </div>
        <?php
        }
        $con->close();
        ?>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>

