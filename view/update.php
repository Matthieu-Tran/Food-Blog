	<form action="routeur.php" method="get">
		<input type='hidden' name='action' value='updated'>
		<input type='hidden' name='numTache' value="<?php echo $numTache; ?>">
		<p>
			<label>libellé :</label>
			<input type="text" name="libelle" value="<?php echo $libelle; ?>">
		</p>
		<p>
			<label>fait ? :</label>
			<input type="text" name="fait" value="<?php echo $fait; ?>">
		</p>
		<p>
			<label>date butoir :</label>
			<input type="date" name="dateButoir" value="<?php echo $dateButoir; ?>">
		</p>
		<p>
			<input type="submit" name="envoyer" value="modifier la tâche">
		</p>
	</form>
</body>
</html>





