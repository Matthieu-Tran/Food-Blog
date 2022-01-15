<div class="card">
    <div class="card-body" style="padding-top: 150px; padding-bottom: 500px;">
        <div class="card-header">
            <h3>Vos modérateurs</h3>
        </div>
        <table class="table table-borderless main ">
            <thead>
                <tr class="head">
                    <th scope="col">Numéro Utilisateur</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">est Modérateur</th>
                    <th scope="col">Ajouter/Supprimer Modérateur</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listeNumUtilisateur as $key => $value) {
                    //Si on tombe sur lui meme on skip
                    if ($_SESSION['numUtilisateur'] == $listeNumUtilisateur[$key]['numUtilisateur']) continue; ?>
                    <tr class="rounded bg-white" style="border: 10px solid #eee">
                        <td>
                            <?php echo $listeNumUtilisateur[$key]['numUtilisateur']; ?>
                        </td>
                        <td class="order-color"><?php echo $listeNumUtilisateur[$key]['nomUtilisateur']; ?></td>
                        <td><?php echo $listeNumUtilisateur[$key]['prenomUtilisateur']; ?></td>
                        <td class="d-flex align-items-center"><span class="ml-2"><?php echo $listeNumUtilisateur[$key]['pseudoUtilisateur']; ?></span> </td>
                        <?php if ($listeNumUtilisateur[$key]['estModerateur']) { ?>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                                </div>
                            </th>
                        <?php } else { ?>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
                                </div>
                            </th>
                        <?php } ?>
                        <td>
                            <button onclick="window.location.href='routeur.php?action=modifModo&numUtilisateur=<?php echo $listeNumUtilisateur[$key]['numUtilisateur'] ?>'" type="button" class="btn btn-sm btn-outline-primary ml-1 ">
                                Valider
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>