                    <?php
                    require 'connect_db.php';

                    $idmedia=$_GET['idmedia'];
                        if(isset($_POST['yes-delete'])){
                            $delff = $con->prepare("DELETE FROM `films_genre`  WHERE `media_idmedia` = '$idmedia'");
                            $delff->execute();
                            $delfhm = $con->prepare("DELETE FROM `folders_has_media`  WHERE `media_idmedia` = '$idmedia'");
                            $delfhm->execute();
                            $delmedia = $con->prepare("DELETE FROM `media`  WHERE `idmedia` = '$idmedia'");
                            $delmedia->execute();
                            header("Location:../media.phtml?idmedia='$idmedia");
                        }else if(isset($_POST['no-delete'])){
                            header("Location:../media.phtml?idmedia='$idmedia");
                        }



                    ?>