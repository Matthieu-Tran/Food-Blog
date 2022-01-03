	<?php 
		$f = ($fait == 0 ? "pas fait" : "fait");
		echo "<h3>Liste des tâches de la base de données de libellé $libelle et d'état $f</h3>";
		echo "<ul>";
		if ($lesTaches) {
			foreach ($lesTaches as $tache) {
				$n = $tache->getNumTache();
				$lienU = " | <a href='routeur.php?action=update&numTache=".$n."'> modifier la tâche</a>";
				$lienD = " | <a href='routeur.php?action=delete&numTache=".$n."'> supprimer la tâche</a>";
				$lienR = " | <a href='routeur.php?action=read&numTache=".$n."'> afficher la tâche</a>";
				echo "<li> tâche $n".$lienU.$lienD.$lienR."</li>";
			}
		}
		echo "</ul>";
	?>
</body>
</html>



