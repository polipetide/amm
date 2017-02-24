<?php

	if(isset($_POST['aggiorna'])){
		$tipo = $_POST['tipo'];
		$nome = $_POST['nome'];
		$famiglia = $_POST['famiglia'];
		$num = $_POST['num'];
		
		$query = "SELECT * FROM Prodotto WHERE NomeComune LIKE '$nome' AND Famiglia LIKE '$famiglia' AND Tipo LIKE '$tipo';";
		
		
		$result = $mysqli->query($query);
		
		if(!$result){
			echo "Errore nella query di selezione.<br><br>";
		}elseif($result->num_rows > 0){
				
			$query = "UPDATE Prodotto SET num=$num WHERE NomeComune LIKE '$nome' AND Famiglia LIKE '$famiglia' AND Tipo LIKE '$tipo';";	
			$result = $mysqli->query($query);
			
			if(!$result)
				echo "Errore nell'aggiornamento dell'articolo.<br>";
			else
				echo "Il {$tipo} {$nome} {$famiglia} &egrave; stato aggiornato.<br><br>";
		}
		else
			echo "Il {$tipo} {$nome} {$famiglia} non esiste nel database.<br><br>";

		
	}
else {
?>
<div class='div-admin'>
	<form class="reg-form" action="?page=editart" method='POST'>
		<fieldset class="register-group">
			<label>
                Tipo
                <select name="tipo" placeholder="Tipo">
                  <option value="Fiore">Fiore</option>
                  <option value="Pianta">Pianta</option>
                  <option value="Bouquet">Bouquet</option>
                  <option value="FioreFinto">Fiore Finto</option>
                </select>
            </label>
            <br>

			<label>
                Nome Comune
                <input type="text" name="nome" placeholder="Nome" maxlength='30' title="Inserisci il nome" required>
            </label>
			<br>
			
			<label>
                Famiglia
                <input type="text" name="famiglia" placeholder="Famiglia" maxlength='30' title="Inserisci la famiglia" required>
            </label>
            <br>
			
			<label>
				Numero
				<input type="number" name="num" placeholder="0" value='0' maxlength='4' title="Inserisci il numero" required>
			</label>
			<br>			
		</fieldset>
		<input class='reg-btn' type="submit" name="aggiorna" value="Aggiorna">
	</form>
</div>
<?php } ?>