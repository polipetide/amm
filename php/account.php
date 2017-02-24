<script src="assets/script/account.js"></script>
<?php

	$username = $_SESSION['username'];
	$query = "SELECT admin FROM utente WHERE username LIKE '$username'";
	$result = $mysqli->query($query);
	$admin = $result->fetch_assoc();
	
	if($admin['admin'])	{ 
		$_SESSION['admin'] = $username;
	?>
		<div class='titolo'>
			<h2><b>Bentornato admin!</b></h2>
			<p>Pannello di amministrazione</p>
		</div>
		<div class='list-account'>		
			
		<h3>Inserisci Articolo</h3>
			<div>
				<?php include('php/admin/insertpd.php'); ?>
			</div>
		<h3>Inserisci foto</h3>
			<div>
				<?php include('php/admin/insertphoto.php'); ?>
			</div>
		<h3>Elimina articolo</h3>	
			<div>
				<?php include ('php/admin/deleteart.php'); ?>
			</div>			
		<h3>Aggiorna quantit&agrave; articolo</h3>	
			<div>
				<?php include ('php/admin/editart.php'); ?>
			</div>
		<h3>Nuovo utente</h3>    
			<div>
				<?php include ('php/admin/newaccount.php'); ?>
			</div>			
		<h3>Modifica utente </h3>	
			<div>
				<?php include ('php/admin/editaccount.php'); ?>
			</div>	
		<h3>Elimina utente	</h3>
			<div>
				<?php include ('php/admin/deleteaccount.php'); ?>
			</div>
			
</div>					
	<?php
	}
	
	else{
		$_SESSION['admin'] = "NULL";
	?>	
		<div class='titolo'>
			<h2><b>Bentornato <?php echo "{$username}";?></b></h2>
			<p>Pannello di amministrazione</p>
		</div>
		<div class='list-account'>
			<h3>Modifica utente </h3>	
				<div>
					<?php include ('php/admin/editaccount.php'); ?>
				</div>

			<h3>Elimina account </h3>	
				<div>
					<?php include ('php/admin/deleteaccount.php'); ?>
				</div>
		</div>
	<?php
	}
	$mysqli->close();
?>