<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="estilos.css">
	</head>
	<body>
		<form action="rompecabezas.php" method="post">
			<div>
				<table class='tablero'>

					<tr>
					<?php
					
					for($i=0;$i<16;$i++){
							
							echo "<td><input name='ficha[$i]' class='fichas' type='submit' value='{$tablero[$i]}'; ></td>";
							if(($i+1)%4==0){
								echo "</tr><tr>";
							}
						}
						
					?>
					</tr>
				</table>
			</div>
		</form>
				<form action="Salir2.php" method="post">
				<div><input class='submit' type='submit' value='Salir'></div>
				</form>
	</body>
</html>