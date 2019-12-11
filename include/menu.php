	<ul class="menu">		
		<a href="clock.php?page=homepage" class="modLink"><li class="primo">Hompage</li></a>
		<a href="clock.php?page=viewRepairs" class="modLink"><li>Riparazioni</a>
			<ul class="sub-menu">
				<a href="clock.php?page=viewRepairs" class="modLink"><li>Lista</li></a>
				<a href="clock.php?page=newRepair" class="modLink"><li>Nuova</li></a>
				<a href="clock.php?page=updateRepair" class="modLink"><li class="ultimo-sub">Modifica</li></a>
			</ul>
		</li>
		<a href="clock.php?page=viewCustomers" class="modLink"><li>Clienti</a>
			<ul class="sub-menu">
				<a href="clock.php?page=viewCustomers" class="modLink"><li>Lista</li></a>
				<a href="clock.php?page=newCustomer" class="modLink"><li>Nuovo</li></a>
				<a href="clock.php?page=updateCustomer" class="modLink"><li class="ultimo-sub">Modifica</li></a>
			</ul>
		</li>
		<a href="clock.php?page=viewOrders" class="modLink"><li>Ordini</a>
			<ul class="sub-menu">
				<a href="clock.php?page=viewOrders" class="modLink"><li>Lista</li></a>
				<a href="clock.php?page=newOrder" class="modLink"><li>Nuovo</li></a>
				<a href="clock.php?page=updateOrder" class="modLink"><li class="ultimo-sub">Modifica</li></a>
			</ul>
		</li>
		<a href="clock.php?page=viewFornit" class="modLink"><li>Fornitori</a>
			<ul class="sub-menu">
				<a href="clock.php?page=viewFornit" class="modLink"><li>Lista</li></a>
				<a href="clock.php?page=newFornit" class="modLink"><li>Nuovo</li></a>
				<a href="clock.php?page=updateFornit" class="modLink"><li class="ultimo-sub">Modifica</li></a>
			</ul>
		</li>
		<a href="clock.php?page=viewStock" class="modLink"><li>Magazzino</a>
			<ul class="sub-menu">
				<a href="clock.php?page=viewStock" class="modLink"><li>Lista merce</li></a>
				<a href="clock.php?page=newStock" class="modLink"><li>Nuovo</li></a>
				<a href="clock.php?page=updateStock" class="modLink"><li class="ultimo-sub">Modifica</li></a>
			</ul>
		</li>
		<a href="clock.php?page=prospMensile" class="modLink"><li <?php if($iduser!=1){?> class="ultimo" <?php } ?> >Prospetto</li></a>
		<?php	if($iduser==1){	//admin	?>
			<a href="clock.php?page=viewWorkers" class="modLink"><li>Lavoratore</a>
				<ul class="sub-menu">
					<a href="clock.php?page=viewWorkers" class="modLink"><li>Lista</li></a>
					<a href="clock.php?page=newWorker" class="modLink"><li>Nuovo</li></a>
					<a href="clock.php?page=updateWorker" class="modLink"><li class="ultimo-sub">Modifica</li></a>
				</ul>
			</li>
			<a href="clock.php?page=querySQL" class="modLink"><li class="ultimo">Query SQL</li></a>
		<?php }	?>
	</ul>
	
