	<form action="routeur.php" method="get">
		<input type='hidden' name='action' value='created'>
		<p>
			<label>Nom de la recette</label>
			<input type="text" name="nomRecette">
		</p>
        <p>
            <label>Difficulté :</label>
            <input type="text" name="difficulteRecette">
        </p>
        <p>
            <label>Description :</label>
            <input type="text" name="descriptionRecette">
        </p>
        <p>
            <label>Numéro d'utilisateur :</label>
            <input type="text" name="numUtilisateur">
        </p>
        <p>
            <input type="submit" name="envoyer" value="créer la recette">
        </p>
	</form>
</body>
</html>