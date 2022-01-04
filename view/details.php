	<?php 
		echo "<h3>détails sur la recette</h3>";
		$n = $recette->getnumRecette();
		$lienU = " | <a href='routeur.php?action=update&numRecette=".$n."'> modifier la recette</a>";
		$lienD = " | <a href='routeur.php?action=delete&numRecette=".$n."'> supprimer la recette</a>";
		echo $recette->affichage();
		echo $lienRetour.$lienU.$lienD;
	?>
</body>
</html>