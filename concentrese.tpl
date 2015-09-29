<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="estilos.css">
	</head>
	<body>
		<form action="concentrese.php" method="post">
			<div>
				<table class='tablero'>

					<tr>
					<?php
					//print_r($_SESSION['tablero2']);
					for($i=0;$i<36;$i++){

					if($tablero2[$i]==1){
							echo "<td><input name='ficha[$i]' class='fichas' type='submit' value='{$tablero[$i]}'; ></td>";
							if(($i+1)%6==0){
								echo "</tr><tr>";
							}
						}else{

						echo "<td><input name='ficha[$i]' class='fichas' type='image' src='imagen2.png' ></td>";
							if(($i+1)%6==0){
								echo "</tr><tr>";
							}
						}
					}
					?>
					</tr>
				</table>
			</div>
		</form>
				<form action="Salir.php" method="post">
				<div><input class='submit' type='submit' value='Salir'></div>
				</form>
	</body>
</html>