<?php
    $query = $con->query($search_media);
    $checking = $query->num_rows;
    echo "<h2><b>Фильмы</b></h2>";
    if ($checking == 0){
    echo"
      <div style='padding-left: 5%;'>
      <img src='картинки/not_found.png' style='width:40px;'>
      <label><h5>По запросу ничего не найдено</h5></label>
      </div>
      ";
    }
    else{
      while($row = $query->fetch_assoc()){
        $idmedia = $row['idmedia'];
        $show_img = base64_encode($row['image_cover']);
        $title = $row['title'];
        $rating = $row['rating'];
        $release = date("Y",strtotime($row['release']));
        $description = $row['description'];

        $item_genres = $con->query("SELECT * FROM films_genre WHERE media_idmedia='$idmedia'");
        $gcheck=$item_genres->num_rows;
        ?>
        <div class="one-item">
        <a href="media.phtml?idmedia=<?php echo $idmedia;?>" class="link">
        <table>
            <tr>
            <td>
                <img class="poster" src="data:image/jpeg;base64, <?=$show_img?>" alt="">
            </td>
            <td>
          <?
          echo"
          <p><b>$title /$release/</b></p>
          <p><b>Жанры: </b>";
          while($row = $item_genres->fetch_assoc()){
              $idgenre = $row['genres_idgenre'];
              $genre_tmp = $con->query("SELECT * FROM genres WHERE idgenre='$idgenre'");
              while($row = $genre_tmp->fetch_assoc()){
                  $genre = $row['name'];
                  if ($gcheck > 1) 
                  {
                      echo "$genre, ";
                      $gcheck--;
                  }
                  else echo "$genre";
              }
          }
          echo"</p>
          <p><b>Рейтинг: </b>$rating</p>
          <b>Описание:</b>
          <p style='overflow: auto; height: 80px; padding-right: 20px;'>$description</p>
          ";
          ?>
        </td>
            </tr>
        </table>
        </div></a>
      <?
      }
    }
?>