<div class="row"> <!-- Usata per nome articolo o titolo pagina -->
	<h2><b>NON PERDERTI LE OFFERTE!!</b></h2>
</div>
			
<div> <!-- articolo-->
	<?php				
		$query = "SELECT * FROM Prodotto WHERE id_p = 1";
		$result = $mysqli->query($query);
		
		while($row = $result->fetch_row())
			$pc = new Prodotto ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);

	?>
	<div class="photo-article"> 
		<img class="img-art" src="<?php echo "{$pc->getPhoto()}"; ?>
		" alt="foto">
	</div>
				
	<div class="description-article">
		<h2><?php echo "{$pc->getNome()} {$pc->getTipo()}"; ?></h2>
		<h3><?php echo "{$pc->getPrezzo()}"; ?> &#8364; </h3>
		
	</div>
</div>
			
<section class="text-art"> <!-- descrizione articolo -->
	<p><b>Perch&eacute; scegliere "A Fiori"?</b></p>
	<p>
	<-Provvederemo a farti avere i nostri prodotti perfetti, come appena colti!
	Ci teniamo che voi abbiate la merce migliore che possiate acquistare. Il cliente sa in che fase si trova ogni suo articolo, quando sar&agrave; 
	   recapitato e viene avvertito di ogni minima modifica che potrebbe avvenire all'ordine effettuato!<br>->

	   <-A Fiori sta dalla parte del cliente! Con oltre 300 articoli venduti ogni mese e un rating 99.5% nei maggiori siti di opinioni,
	   Fiori e Piante fa della qualit&agrave; il suo maggior vanto.->
	</p><br>
	
	<p><b>&Egrave; un sito sicuro?</b></p>
	<p>
	   Finora la percentuale di consegna degli articoli &egrave; stata pari al 100%! 
	</p><br>

	<p><b>In quanto tempo arrivano gli articoli a casa?</b></p>
	<p>
	   Grazie al servizio di consegna 'Djanni Express' al quale 'A Fiori' affida i suoi articoli dal 1999, il tuo ordine sar&agrave; recapitato
	   a casa entro due giorni lavorativi!
	</p>
</section>
<?php
$mysqli->close();
?>