<?php
const ingredientMax = 10;
const ustensileMax = 10;
?>

<div class="container-lg mt-4 pb-5" style="padding-top: 130px">
    <div class="mx-auto mb-4">
        <?php
        if (isset($_GET['ajout_err'])) {
            $err = htmlspecialchars($_GET['ajout_err']);
            switch ($err) {
                case 'oubliUstensileIngredient':
        ?>
                    <div class="alert alert-primary" role="alert">
                        Aucuns ingredient et ustensile ajoutés: Veuillez recommencez !
                    </div>
                <?php
                    break;

                case 'oubliUstensile':
                ?>
                    <div class="alert alert-primary" role="alert">
                        Vous n'avez pas ajouté d'ustensiles: Veuillez recommencer !
                    </div>
                <?php
                    break;

                case 'oubliIngredient':
                ?>
                    <div class="alert alert-primary" role="alert">
                        Vous n'avez pas ajouté d'ingredients: Veuillez recommencer !
                    </div>
                <?php
                    break;

                case 'oubliQuantite':
                ?>
                    <div class="alert alert-primary" role="alert">
                        Aucunes quantitées ajoutées: Veuillez recommencez !
                    </div>
        <?php
            }
        }
        ?>
        <h3 class="text-center"> Partagez nous vos petits plaisirs </h3>
    </div>
    <div class="card border-0 shadow rounded-3 w-75 my-5 mx-auto">
        <div class="card-body p-4">
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="created">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="nomRecette">Nom de la recette</label>
                        <input type="text" class="form-control" name="nomRecette" placeholder="Pâtes carbonara" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="numCategorie">Catégories</label>
                        <select name="numCategorie" class="selectpicker form-control" required>
                            <option name="numCategorie" value="1"><?php echo $lesCategories[0]['1']; ?></option>
                            <?php foreach ($lesCategories as $key => $value) { ?>
                                <option name="numCategorie" value="<?php echo $lesCategories[$key]['numCategorie']; ?>">
                                    <?php echo $lesCategories[$key]['nomCategorie'] . " " .  $lesCategories[$key]['typeCategorie'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="difficulteRecette">Difficulté</label>
                        <select name="difficulteRecette" class="selectpicker form-control" required>
                            <option name="difficulteRecette" value="Facile">Facile</option>
                            <option name="difficulteRecette" value="Moyen">Moyen</option>
                            <option name="difficulteRecette" value="Difficile">Difficile</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="photo">Image</label>
                    <input type="file" class="form-control-file" name="photo" accept="image/png, image/jpeg, image/jpg" required>
                </div>
                <hr>
                <div class="form-group">
                    <label for="instructions">Instructions</label>
                    <textarea rows="3" class="form-control" placeholder="Instructions" name="descriptionRecette" required></textarea>
                </div>
                <hr>

                <div class="field_wrapper_ingredient">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Ingrédients</label>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Quantités</label>
                        </div>
                    </div>
                    <div class="form-row ingredient0">
                        <div class="form-group col-md-5">
                            <select id="selectIngredient0" name="numIngredient[]" class="selectpicker form-control" required>
                                <option name="numIngredient" value="0"> Aucun Ingredient </option>
                                <?php foreach ($lesIngredients as $key => $value) { ?>
                                    <option name="numIngredient" value="<?php echo $lesIngredients[$key]['numIngredient']; ?>">
                                        <?php echo $lesIngredients[$key]['nomIngredient'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <input type="number" class="form-control" name="quantite[]" min="0" max="10000" placeholder="... en g">
                        </div>
                    </div>
                    <?php for ($cpt = 1; $cpt < 10; $cpt++) { ?>
                        <div class="form-row d-none ingredient<?php echo $cpt ?>">
                            <div class="form-group col-md-5">
                                <select id="selectIngredient<?php echo $cpt ?>" name="numIngredient[]" class="selectpicker form-control" required>
                                    <option name="numIngredient" value="0"> Aucun Ingredient </option>
                                    <?php foreach ($lesIngredients as $key => $value) { ?>
                                        <option name="numIngredient" value="<?php echo $lesIngredients[$key]['numIngredient']; ?>">
                                            <?php echo $lesIngredients[$key]['nomIngredient'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <input type="number" class="form-control" name="quantite[]" min="0" max="10000" placeholder="... en g">
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-danger font-weight-bold mx-auto remove_ingredient">Supprimer</button>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary font-weight-bold add_ingredient">Ajouter un ingrédient</button>
                    </div>
                </div>
                <hr>
                <div class="field_wrapper_ustensile">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Ustensiles</label>
                        </div>
                    </div>
                    <div class="form-row ustensile0">
                        <div class="form-group col-md-5">
                            <select id="selectUstensile0" name="numUstensile[]" class="selectpicker form-control">
                                <option name="numUstensile" value="0"> Aucun Ustensiles </option>
                                <?php foreach ($lesUstensiles as $key => $value) { ?>
                                    <option name="numUstensiles" value="<?php echo $lesUstensiles[$key]['numUstensile']; ?>">
                                        <?php echo $lesUstensiles[$key]['nomUstensile'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php for ($cpt = 1; $cpt < 10; $cpt++) { ?>
                        <div class="form-row d-none ustensile<?php echo $cpt ?>">
                            <div class="form-group col-md-5">
                                <select id="selectUstensile<?php echo $cpt ?>" name="numUstensile[]" class="selectpicker form-control">
                                    <option name="numUstensile" value="0"> Aucun Ustensiles </option>
                                    <?php foreach ($lesUstensiles as $key => $value) { ?>
                                        <option name="numUstensiles" value="<?php echo $lesUstensiles[$key]['numUstensile']; ?>">
                                            <?php echo $lesUstensiles[$key]['nomUstensile'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-danger font-weight-bold mx-auto remove_ustensile">Supprimer</button>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary font-weight-bold add_ustensile">Ajouter un ustensile</button>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-end">
                    <button type="submit" name="envoyer" value="creation de la recette" class="btn btn-warning font-weight-bold">Ajouter la recette</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Fonctions pour les ingrédients
        var max_fields_ingredients = 10;
        var add_ingredient = $(".add_ingredient");
        var remove_ingredient = $(".remove_ingredient");
        var x = 0;

        $(add_ingredient).click(function(e) {
            e.preventDefault();
            if (x < max_fields_ingredients) {
                x++;
                $('.ingredient' + x).removeClass('d-none');
            } else {
                alert('Vous ne pouvez pas ajouter plus d\'ingredients !');
            }
        });

        $(remove_ingredient).click(function(e) {
            e.preventDefault();
            if (x > 0) {
                if (x == 10)
                    x--;
                $('.ingredient' + x).addClass('d-none');
                var id = document.getElementById("selectIngredient" + x).selectedIndex;
                id = "0";
                x--;
            }
        });

        // Fonctions pour les ustensiles
        var max_fields_ustensiles = 10;
        var add_ustensile = $(".add_ustensile");
        var remove_ustensile = $(".remove_ustensile");
        var y = 0;

        $(add_ustensile).click(function(e) {
            e.preventDefault();
            if (y < max_fields_ustensiles) {
                y++;
                $('.ustensile' + y).removeClass('d-none');
            } else {
                alert('Vous ne pouvez pas ajouter plus d\'ustensiles !');
            }
        });

        $(remove_ustensile).click(function(e) {
            e.preventDefault();
            if (y > 0) {
                if (y == 10)
                    y--;
                $('.ustensile' + y).addClass('d-none');
                var id = document.getElementById("selectUstensile" + x).selectedIndex;
                id = "0";
                y--;
            }
        });
    });
</script>

</html>