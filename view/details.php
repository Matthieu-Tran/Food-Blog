	<?php 
		echo "<h3>détails sur la tâche</h3>";
		$n = $tache->getNumTache();
		$lienU = " | <a href='routeur.php?action=update&numTache=".$n."'> modifier la tâche</a>";
		$lienD = " | <a href='routeur.php?action=delete&numTache=".$n."'> supprimer la tâche</a>";
		echo $tache->affichage();
		echo $lienRetour.$lienU.$lienD;
	?>
</body>
</html>