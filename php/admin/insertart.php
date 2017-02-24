<?php 

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$colore = $_POST['colore'];
		$famiglia = $_POST['famiglia'];
		$tipo = $_POST['tipo'];
		$prezzo = $_POST['prezzo'];
		$num = $_POST['num'];
		$foto = "assets/images/" . $_POST['foto'];
			
		//verificare se esiste la foto e l'articolo	
		
		$query = "SELECT * FROM prodotto WHERE foto = '$foto'";
		$result = $mysqli->query($query);
		
		$query = "SELECT * FROM prodotto WHERE tipo LIKE '$tipo'";
		
		$result2 = $mysqli->query($query);
		
		if($result->num_rows > 0){ //la foto è stata già usata per un altro articolo
			echo "La foto seguente &egrave; stata gi&agrave usata per un altro articolo! <br>";
		}elseif($result2->num_rows > 0){
			echo "Articolo gi&agrave; presente nel database!<br>";
		}elseif(!file_exists($photo)){
			echo "Il file selezionato come foto non esiste nel database.<br>";
		}else{
			$query = "INSERT INTO prodotto(id, nome, colore, famiglia, tipo, prezzo, num, foto, descrizione) VALUES ('$id', '$nome', '$colore', '$famiglia', '$tipo', '$prezzo', '$num', '$foto', '$descrizione');";
			$result = $mysqli->query($query);
			
			if(!$result)
				echo "Errore nella query!";
			else //se carica fa vedere il form da compilare
				echo "<br><br>Articolo caricato!<br><br>";
		}		
	
	}