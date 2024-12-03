<table border=1px>
	<?php
	while($user = $reponse->fetch()) {
	?>				
	<tr>
		<td>
			<?php echo $user["nom"] ?>
		</td>
		<td>
			<?php echo $user["prenom"] ?>
		</td>
		<td>
			<?php echo '<a href="index.php?action=modifier&id='.$user["id"].'">modifier</a>' ?>
		</td>
	</tr>
	<?php } ?>	
	
</table>
<a href="index.php?action=ajouter">ajouter</a>