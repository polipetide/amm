<?php 
if (isset($_POST['insertpd'])){
     
        $nome = $_POST['nome'];
        $colore = $_POST['colore'];
        $famiglia = $_POST['famiglia'];
        $tipo = $_POST['tipo'];
        $prezzo = $_POST['prezzo'];
        $num = $_POST['num'];
        $foto = "assets/images/" . $_POST['foto'];
        $descrizione = _POST['desc'];
             
        //verificare se esiste la foto e l'articolo 
         
        $query = "SELECT * FROM prodotto WHERE foto = '$photo'";
        $result = $mysqli->query($query);
         
        $query = "SELECT * FROM prodotto WHERE marca LIKE '$marca' AND modello LIKE '$modello'";
         
        $result2 = $mysqli->query($query);
         
        if($result->num_rows > 0){ //la foto è stata già usata per un altro articolo
            echo "La foto seguente &egrave; stata gi&agrave usata per un altro articolo! <br>";
        }elseif($result2->num_rows > 0){
            echo "Articolo gi&agrave; presente nel database!<br>";
        }elseif(!file_exists($photo)){
            echo "Il file selezionato come foto non esiste nel database.<br>";
        }else{
            $query = "INSERT INTO prodotto(nomecomune, colore, famiglia, tipo, prezzo, num, foto, descrizione) VALUES ('$nomecomune', '$colore', '$famiglia', '$tipo', '$prezzo', '$num', '$foto', '$descrizione');";
            $result = $mysqli->query($query);
             
            if(!$result)
                echo "Errore nella query!";
            else //se carica fa vedere il form da compilare
                echo "<br><br>Articolo caricato!<br><br>";
        }   
}else {
?> <div class='div-admin'>
    <form class="reg-form" action="?page=insert&type=pc" method='POST'>
        <fieldset class="register-group">
            <label>
                Nome Comune
                <input type="text" name="nome" placeholder="Nome" maxlength='30' title="Inserisci il nome" required>
            </label>
            <br>
             
            <label>
                Colore
                <input type="text" name="colore" placeholder="Colore" maxlength='30' title="Inserisci il colore" required>
            </label>
            <br>
         
            <label>
                Famiglia
                <input type="text" name="famiglia" placeholder="Famiglia" maxlength='30' title="Inserisci la famiglia" required>
            </label>
            <br>
         
            <label>
                Tipo
                <select name="tipo" placeholder="Tipo">
                  <option value="fio">Fiore</option>
                  <option value="pian">Pianta</option>
                  <option value="bouq">Bouquet</option>
                  <option value="fint">Fiore Finto</option>
                </select>
            </label>
            <br>
         
            <label>
                Prezzo
                <input type="text" name="price" placeholder="Prezzo" maxlength='8' title="Inserisci il prezzo" required>
            </label>
            <br>
         
            <label>
                Numero di articoli in magazzino
                <input type="text" name="num" placeholder="Numero" maxlength='5' title="Inserisci il numero di articoli in magazzino" required>
            </label>
            <br>
         
            <label>
                Foto
                <input type="text" name="photo" placeholder="nomefile.jpg" maxlength='30' title="Inserisci il nome della foto" required>
            </label>

            <label>
                Descrizione
                <textarea rows="4" cols="50"></textarea>
            </label>
            <br>
 
            </fieldset>
        <input class='reg-btn' type="submit" name="insertpd" value="Inserisci">
    </form>
 
    <?php } ?>
</div>