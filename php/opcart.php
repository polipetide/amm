<?php
    /* sc dice se aggiungere (add) o eliminare (del) l'articolo
       il code identifica il codice dell'articolo da aggiungere/eliminare
       se l'articolo è già presente nel carrello, aggiungiamo 1 in quantità se scegliamo add, togliamo 1 in quantità se scegliamo del
       usare ajax per finestra eliminare articoli
    */
     
    $type = $_GET['type'];          // fiori, piante, buquet, fiori finti
    $sc = $_GET['sc'];              // add or del
    $code = $_GET['code'];          // codice articolo
    $userid = $_SESSION['userid'];  // user id
     
 
    if($sc == 'add'){
        // Non bisogna far mettere nel carrello più articoli di quelli realmente disponibili
        // $num contiene quanti articoli ci sono ora nel carrello
        $querina = "SELECT num FROM carrello WHERE utente = $userid AND prodotto = $code";
        $result = $mysqli->query($querina);
        $row = $result->fetch_row();
        $num = $row[0];
         
        // $tot contiene quanti articoli sono disponibili in magazzino
        $querina = "SELECT num FROM prodotto WHERE id_p = $code";
        $result = $mysqli->query($querina);
        $row = $result->fetch_row();
        $tot = $row[0];
         
        if($num >= 1){
            $num++;
            if($tot >= $num){
                $query = "UPDATE carrello SET num = $num WHERE utente = $userid AND prodotto = $code";
                if(!($mysqli->query($query)))
                    echo "Errore nell'inserimento dell'articolo nel carrello (update).<br><br>";
                else{
                    //visualizzo gli articoli inseriti
                    header("refresh:0;url='?page=cart'" );
                }                   
            }   
        } else{
            $query = "INSERT INTO carrello(prodotto, utente, num) VALUES ($code, $userid, 1)";
            if(!($mysqli->query($query)))
                echo "Errore nell'inserimento dell'articolo nel carrello (add).<br><br>";
            else{
                //visualizzo gli articoli inseriti
                header("refresh:0;url='?page=cart'" );
            }           
        }
    }else{ //del 
        $query = "SELECT num FROM carrello WHERE utente = $userid AND prodotto = $code";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        $num = $row[0];         
         
        if($num > 1){
            $num--;
            $query = "UPDATE carrello SET num = $num WHERE utente = $userid AND prodotto = $code";
            if(!($mysqli->query($query)))
                echo "Errore nell'inserimento dell'articolo nel carrello (update).<br><br>";
            else
                //visualizzo gli articoli inseriti
                header("refresh:0;url='?page=cart'" );  
        }else{
            $query = "DELETE FROM carrello WHERE prodotto = $code AND utente = $userid";
            if(!($mysqli->query($query)))
                echo "Errore nell'eliminazione dell'articolo dal carrello.<br><br>";
            else
                header("refresh:0;url='?page=cart'" );
        }
    }   
     
    $mysqli->close();
?>