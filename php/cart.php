<?php
 
if(isset($_POST['acquisto'])){
    $money = $_POST['money'];
    $user = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $totale = $_SESSION['totale'];
 
    $mysqli->autocommit(false);
     
    //Controllo se ci sono Prodotti
    $query = "SELECT Prodotto FROM carrello WHERE utente = '$userid'";
    $result = $mysqli->query($query);
 
    if($result->num_rows > 0){ //se ci sono li elimino dal DB 
        while($row = $result->fetch_row()){
            $listID[] = $row[0];
        }
     
        $i = 0;
         
        while($i < count($listID)){
            // $numDisp contiene quanti prodotti di codice $listID[$i] ci sono ancora disponibili
             
            $query = "SELECT num FROM prodotto WHERE id_p = $listID[$i]";
            $resNum = $mysqli->query($query);
            $aux = $resNum->fetch_row();
            $numDisp = $aux[0];
 
            // $numCart contiene quanti prodotti si vogliono acquistare (presenti nel carrello)
            $query = "SELECT num FROM carrello WHERE prodotto = $listID[$i] AND utente = '$userid'";
            $resNum = $mysqli->query($query);
            $aux = $resNum->fetch_row();
            $numCart = $aux[0];
         
            $query = "DELETE FROM carrello WHERE prodotto = $listID[$i] AND utente = $userid";
 
            if(!($mysqli->query($query))){
                echo "Errore nella query delete articolo";
            }
             
            $toDel = $numDisp - $numCart;
            $query = "UPDATE prodotto SET num = $toDel WHERE id_p = $listID[$i]";
             
            if(!($mysqli->query($query))){
                echo "Errore nella query elimina articolo<br>";
            }
             
            $i++;
        }
    }
         
    //controllo se i soldi inseriti non bastavano per acquistare, se no rollback
    if($money >= $totale){
        $mysqli->commit();
        ?>
        <script type="text/javascript">
            alert("Acquisto effettuato!");
        </script> 
        <?php
        //header("refresh:0;url='?page=home'" );
    }else{
        $mysqli->rollback();
        ?>
        <script type="text/javascript">
            alert("I soldi inseriti non bastavano a coprire l'acquisto! Inserisci una somma adeguata.");
        </script>
        <?php
        //header("refresh:0;url='?page=cart'" );                
    }
 
    // riabilito autocommit
    $mysqli->autocommit(true);           
 
} else {
 
?>
    <div class='titolo'><h2><b>Carrello</b></h2></div>
     
 
    <?php
        $totale = 0;
        $noArt = 0; 
        $list = array();
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
            $query = "SELECT * FROM prodotto INNER JOIN carrello WHERE carrello.utente = '$userid' AND carrello.prodotto = prodotto.id_p";
            $result = $mysqli->query($query);
                     
            if($result->num_rows > 0){ //se ci sono computer li visualizzo
                 
                while($row = $result->fetch_row())
                    $list[] = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
 
                $i = 0;
                ?> <div class='div-cart'> <?php
 
                while($i < count($list)){
                ?>
 
                    <div class='box-article cart-art-box'>
                        <div class='box-image-article'>
                            <img class='image-article' src='<?php echo "{$list[$i]->getPhoto()}"; ?>' alt='<?php echo "{$list[$i]->getNome()} {$list[$i]->getFamiglia()}";?>'>
                        </div><!--
                    --><div class='name-article'>
                            <h3><nobr><a class='art-link' href='index.php?page=list&sc=<?php echo"{$list[$i]->getType()}";?>&art=<?php echo"{$list[$i]->getId()}";?>' alt='<?php echo "{$list[$i]->getNome()} {$list[$i]->getFamiglia()}";?>'><?php echo "{$list[$i]->getNome()} {$list[$i]->getFamiglia()}";?></a></nobr></h3> <!-- nome e famiglia-->
                            <p><nobr> Cod. <?php echo "{$list[$i]->getId()}"; ?> - quantit&agrave: 
                            <?php    
                                $cc = $list[$i]->getId();
                                $querina = "SELECT num FROM carrello WHERE utente = $userid AND prodotto = $cc";
                                $result = $mysqli->query($querina);
                                $row = $result->fetch_row();
                                $num = $row[0];
                                echo "{$num}";
                            ?>                   
                        <!-- echo ""-->
                            </p> <!-- codice -->
                        </div><!--
                    --><div class='box-price-article'>
                        <!-- prezzo -->
                            <h4 class='price-article'><?php echo "{$list[$i]->getPrezzo()}"; $totale = $totale + ($list[$i]->getPrezzo() * $num);?>&#8364;</h4> <!-- prezzo -->
                            <?php
                                $aux = $list[$i]->getId();
                                $querina = "SELECT num FROM prodotto WHERE id_p = $aux";
                                $result = $mysqli->query($querina);
                                $row = $result->fetch_row();
                                $numDisp = $row[0];
                                if($numDisp > $num){
                                    ?>
                                    <a href='?page=opcart&type=pc&sc=add&code=<?php echo "{$list[$i]->getId()}"; ?>'><img class='img-dlt' src='assets/images/add.png' alt="Aumenta di un'unità la quantità"></a><?php
                                }else{ ?>
                                    <img class='img-dlt' src='assets/images/add.png' alt="Aumenta di un'unità la quantità">
                                <?php } ?>                                
                                <a href='?page=opcart&type=pc&sc=del&code=<?php echo "{$list[$i]->getId()}"; ?>'><img class='img-dlt' src='assets/images/ics.jpg' alt="Riduci di un'unità la quantità"></a>
                            </div>
                        </div>
                    <?php    $i++;                   
                } 
            } else {
                $noArt = 1;
            }
                     
            if($noArt)
                echo "Il carrello &egrave; vuoto.<br><br>";
            else { ?>
                <b><h4 class='price-total'><br>Totale: <?php echo "{$totale}"; ?>&#8364;</h4></b>
                </div>
 
                <form class='move-left' action='#' method='POST'>
                    <label class='money-input'>
                        Inserisci i tuoi soldi <input type='number' step='any' name='money' placeholder='<?php echo "{$totale}"; ?>' value='<?php echo "{$totale}"; ?>'>
                    </label>
                    <input id='bottone' class='reg-btn acq-btn' type="submit" name="acquisto" value="Procedi con l'acquisto">
                    <?php $_SESSION['totale'] = $totale; ?>
                </form>
<?php        }
 
    } else { echo "Per acquistare registrati prima su AFiori.it!"; }
 }
    $mysqli->close();
?>