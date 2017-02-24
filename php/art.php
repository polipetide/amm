<?php
    /*
        trovare la funzione giusta per prelevare un record
        impostare la visualizzazione del dato
        creare tabella con caratteristiche
    */
     
 
        $query = "SELECT * FROM prodotto WHERE id_p='$art'";
        $result = $mysqli->query($query);        
        $row = $result->fetch_row();
        $var = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
         
        $aux = 'mon';
           
?>
    <div class="row"> <!-- Usata per nome articolo o titolo pagina -->
        <h1><?php echo "{$var->getNome()} {$var->getFamiglia()}"; ?></h1>
    </div>
                 
    <div> <!-- foto e info principali -->
        <div class="photo-article"> <!-- foto dell'articolo -->
            <img class="img-art" src="<?php echo"{$var->getPhoto()}" ?>" alt="<?php echo "{$var->getNome()} {$var->getFamiglia()}"; ?>">
        </div><!--
                     
        --><div class="description-article"> <!-- Prezzo, cod articolo, marca, disponibilità -->
            <h2> <?php echo "{$var->getPrezzo()}"; ?> &#8364; </h2>
            <p><?php echo"Cod. articolo {$var->getId()}" ?></p>
            <?php    
                if ($var->getNum() > 0)
                    echo "<p><font color='#99f614'><nobr>DISPONIBILE</nobr></font></p>";
                else
                    echo "<p><font color='#ff3636'><nobr>NON DISPONIBILE</nobr></font></p>"; 
            ?>   
        </div><!--
         
        --><div class="cart-article"><!-- contenitore immagine carrello -->
        <?php
            if($var->getNum() > 0){
                if(isset($_SESSION['username'])) {
                    ?> <a href='?page=opcart&type=<?php echo "$aux"; ?>&sc=add&code=<?php echo "{$var->getId()}"; ?>'> <?php
                }
                else{ 
                    ?><a href='?page=err&code=1'><?php
                }
                ?> <img class='cart-art-image' src='assets/images/cart.jpg' alt='Aggiungi al carrello'></a> <?php
            } else {
                ?><img class='cart-art-image' src='assets/images/cart.jpg' alt='Aggiungi al carrello'><?php
            } ?>
        </div>
    </div><!--
     
    --><div class='row bott'>
        <?php echo "{$var->getDescrizione()}" ?>
    </div><!--
    --><div class='table-caratt'>
        <div> 
         
                    <table class="art-tab">
                        <tbody>
                            <tr>
                                <td><b>Nome</b></td>
                                <td class='lf'><?php echo "{$var->getNome()}" ?></td>
                            </tr>
                            <tr>
                                <td><b>Famiglia</b></td>
                                <td class='lf'><?php echo "{$var->getFamiglia()}" ?></td>
                            </tr>
                            <tr>
                                <td><b>Colore</b></td>
                                <td class='lf'><?php echo "{$var->getColore()}" ?></td>
                            </tr>                         
                            <tr>
                                <td><b>Tipo</b></td>
                                <td class='lf'><?php echo "{$var->getTipo()}" ?></td>
                            </tr>
                        </tbody>
                    </table>
                     
    <?php    
        $mysqli->close();
    ?>
    </div>
</div>