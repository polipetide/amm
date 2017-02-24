<?php
     
    include_once('Prodotto.php');
     
    $list = array();
 
    switch($sc){
        case 'fio': 
            //$query = "SELECT * FROM computer WHERE monitor=0 ORDER BY code ASC";
            $query = "SELECT * FROM prodotto WHERE Tipo LIKE 'Fiore'";
            $result = $mysqli->query($query);
            $type = 'Fiore';
            while($row = $result->fetch_row())
                $list[] = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
            break;
        case 'pian': 
            $query = "SELECT * FROM prodotto WHERE Tipo LIKE 'Pianta'";
            $result = $mysqli->query($query);                
            $type = 'Pianta';
            while($row = $result->fetch_row())
                $list[] = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);        
            break;
        case 'bouq': 
            $query = "SELECT * FROM prodotto WHERE Tipo LIKE 'Bouquet'";
            $result = $mysqli->query($query);        
            $type = 'Bouquet';
            while($row = $result->fetch_row())
                $list[] = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
        case 'fint': 
            $query = "SELECT * FROM prodotto WHERE Tipo LIKE 'FioreFinto'";
            $result = $mysqli->query($query);
            $type = 'FioreFinto';
            while($row = $result->fetch_row())
                $list[] = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);            
    }
        $i=0;
        while($i < count($list)){
                 
    ?>
                 
                    <div class='box-article box-art-w'>
                        <div class='box-image-article'>
                            <img class='image-article' src='<?php echo "{$list[$i]->getPhoto()}"; ?>' alt='<?php echo "{$list[$i]->getNome()} {$list[$i]->getFamiglia()}";?>'>
                        </div><!--
1                       --><div class='name-article'>
                            <h3><nobr><a class='art-link' href='index.php?page=list&sc=<?php echo"{$sc}";?>&art=<?php echo"{$list[$i]->getId()}";?>' alt='<?php echo "{$list[$i]->getNome()} {$list[$i]->getFamiglia()}";?>'><?php echo "{$list[$i]->getNome()} {$list[$i]->getFamiglia()}";?></a></nobr></h3> <!-- marca e modello-->
                            <p> Cod. <?php echo "{$list[$i]->getId()}"; ?>
                        <?php    if ($list[$i]->getNum() > 0)
                                    echo " - <font color='#99f614'><nobr>DISPONIBILE</nobr></font></p>";
                                else
                                    echo " - <font color='#ff3636'><nobr>NON DISPONIBILE</nobr></font></p>"; ?>
                <!-- echo "-->
                            </p> <!-- codice -->
                        </div><!--
                        --><div class='box-price-article'>
                            <!-- prezzo -->
                            <h4 class='price-article'><?php echo "{$list[$i]->getPrezzo()}";?>&#8364;</h4> <!-- prezzo -->
                            <!-- cart image -->
                            <?php
                                if($list[$i]->getNum() > 0){
                                    if(isset($_SESSION['username'])) {
                                        ?> <a href='?page=opcart&type=<?php echo"{$type}"; ?>&sc=add&code=<?php echo "{$list[$i]->getId()}"; ?>'> <?php
                                    }else{ ?>
                                        <a href='?page=err&code=1'> <?php
                                    }
                                }   
                                else
                                    ?><img class='cart-image' src='assets/images/cart.jpg' alt='Aggiungi al carrello'></a>
                        </div>
                    </div>
                <?php    $i++;                   
                } 
    $mysqli->close();
?>