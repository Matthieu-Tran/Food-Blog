	<?php 
		echo "<h3>Liste des tâches de la base de données</h3>";
		echo "<ul>";
		foreach ($lesTaches as $tache) {
			$n = $tache->getNumTache();
			$lienU = " | <a href='routeur.php?action=update&numTache=".$n."'> modifier la tâche</a>";
			$lienD = " | <a href='routeur.php?action=delete&numTache=".$n."'> supprimer la tâche</a>";
			$lienR = " | <a href='routeur.php?action=read&numTache=".$n."'> afficher la tâche</a>";
			echo "<li> tâche $n".$lienU.$lienD.$lienR."</li>";
		}
		echo "</ul>";
	?>
</body>
</html>



