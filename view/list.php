	<?php 
		echo "<h3>Liste des recettes de la base de données</h3>";
		echo "<ul>";
		foreach ($lesRecettes as $recette) {
			$n = $recette->getnumRecette();
			$lienU = " | <a href='routeur.php?action=update&numRecette=".$n."'> modifier la recette</a>";
			$lienD = " | <a href='routeur.php?action=delete&numRecette=".$n."'> supprimer la recette</a>";
			$lienR = " | <a href='routeur.php?action=read&numRecette=".$n."'> afficher la recette</a>";
			echo "<li> Recette $n".$lienU.$lienD.$lienR."</li>";
		}
		echo "</ul>";
	?>
</body>
</html>



