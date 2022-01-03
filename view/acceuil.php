<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Le Quartier des plaisirs</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">
        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
        <link href="blog.css" rel="stylesheet">
    </head>
    <body>
    <center>
        <div class="listeRecettes">
            <?php


            $tabRecettesGauche = array();
            $tabRecettesMilieu = array();
            $tabRecettesDroite = array();

            $idGauche=0;
            $idMilieu=0;
            $idDroite=0;

            foreach($lesRecettes as $key=>$value){
                //echo "key : $key";
                $cle = $key + 1;
                if ($cle % 3 == 1){
                    $tabRecettesGauche[$idGauche] = $value;
                    $idGauche +=1;
                }
                else if ($cle % 3 == 2){
                    $tabRecettesMilieu[$idMilieu] = $value;
                    $idMilieu +=1;
                }
                else {
                    $tabRecettesDroite[$idDroite] = $value;
                    $idDroite +=1;
                }
            }


            // colonne de gauche
            echo "<main>
            <div class=\"contenuGauche\">";



            foreach($tabRecettesGauche as $key=>$value){
                $idR = $value->getIdR();
                $nomR = $value->getNomR();
                $img = $value->getImage();
                echo "<div class=\"cellule\">
                                        <a class=\"lienVersRecette\" href=\"index.php?action=detailR&idR=$idR\">
                                            <div class=\"image_cellule\">
                                                <img class=\"imageCellule\" src=\"./view/images/$img\" alt=\"image recette\"/>
                                            </div>
                                            <div class=\"TexteCellule\">
                                                <div class=\"TitreCellule\">
                                                    $nomR
                                                </div>
                                            </div>
                                        </a>
                                    </div>";
            }

            echo "</div>";

            // colonne du milieu
            echo "<div class=\"contenuMilieu\">";



            foreach($tabRecettesMilieu as $key=>$value){
                $idR = $value->getIdR();
                $nomR = $value->getNomR();
                $img = $value->getImage();
                echo "<div class=\"cellule\">
                                            <a class=\"lienVersRecette\" href=\"index.php?action=detailR&idR=$idR\">
                                                <div class=\"image_cellule\">
                                                    <img class=\"imageCellule\" src=\"./view/images/$img\" alt=\"image recette\"/>
                                                </div>
                                                <div class=\"TexteCellule\">
                                                    <div class=\"TitreCellule\">
                                                        $nomR
                                                    </div>
                                                </div>
                                            </a>
                                        </div>";
            }

            echo "</div>";

            // colonne de droite
            echo "<div class=\"contenuDroite\">";



            foreach($tabRecettesDroite as $key=>$value){
                $idR = $value->getIdR();
                $nomR = $value->getNomR();
                $img = $value->getImage();
                echo "<div class=\"cellule\">
                                            <a class=\"lienVersRecette\" href=\"index.php?action=detailR&idR=$idR\">
                                                <div class=\"image_cellule\">
                                                    <img class=\"imageCellule\" src=\"./view/images/$img\" alt=\"image recette\"/>
                                                </div>
                                                <div class=\"TexteCellule\">
                                                    <div class=\"TitreCellule\">
                                                        $nomR
                                                    </div>
                                                </div>
                                            </a>
                                        </div>";
            }

            echo "</div>
                            </main>";

            ?>
        </div>
    </center>

    </body>
</html>