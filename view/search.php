	<form action="routeur.php" method="get">
		<input type='hidden' name='action' value='found'>
		<p>
			<label for="libelle">libellé : </label>
			<?php echo $selectLibelles; ?>
		</p>
		<p>
			<label for="fait">état : </label>
			fait <input type="radio" name="fait" value="1" checked>
			pas fait <input type="radio" name="fait" value="0">
		</p>
		
		<p>
			<input type="submit" name="envoyer" value="chercher">
		</p>
	</form>
</body>
</html>





