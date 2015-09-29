<?php
//iniciamos la sesión
session_start();
//verificamos si el usuario ya fue validado por el sistema
if(isset($_SESSION['valido'])){
	/* Obtenemos la ficha que se oprimió  ficha[$i] , observe que usamos notación de arreglo
	   al asignarle en el formulario (ver concentrese.tpl) un valor al atributo name del INPUT(tipo submit), entonces, como el 
	   índice del arreglo es el que tiene la posición necesitamos obtener dicho valor, por ejemplo para ficha[3] no me interesa el 
	   valor que contiene esa posición del arreglo sino que quiero el índice, en este caso, 3.  Para obtener el índice usamos
	   la función each(elemento de arreglo) la cual devuelve la clave (índice) y el valor (ver http://php.net/manual/en/function.each.php).
	*/
	$dato=each($_POST['ficha']);
echo $dato['key'];

	if($dato['key']==0){
		if($_SESSION['tablero'][(1+$dato['key'])]==""){
			$_SESSION['tablero'][1+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(4+$dato['key'])]==""){
			$_SESSION['tablero'][4+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else mostrarJuego($_SESSION['tablero']);

	}else if($dato['key']==15){
		if($_SESSION['tablero'][(1-$dato['key'])]==""){
			$_SESSION['tablero'][1-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(4-$dato['key'])]==""){
			$_SESSION['tablero'][4-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else mostrarJuego($_SESSION['tablero']);
	}else if($dato['key']<=3){
		if($_SESSION['tablero'][(1-$dato['key'])]==""){
			$_SESSION['tablero'][1-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(4+$dato['key'])]==""){
			$_SESSION['tablero'][4+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(1+$dato['key'])]==""){
			$_SESSION['tablero'][1+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else mostrarJuego($_SESSION['tablero']);
	}else if($dato['key']>=12){
		if($_SESSION['tablero'][(1+$dato['key'])]==""){
			$_SESSION['tablero'][1+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(1-$dato['key'])]==""){
			$_SESSION['tablero'][1-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(4-$dato['key'])]==""){
			$_SESSION['tablero'][4-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}else mostrarJuego($_SESSION['tablero']);
	}else{
		if($_SESSION['tablero'][(1-$dato['key'])]==""){
			$_SESSION['tablero'][1-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);		
		}else if($_SESSION['tablero'][(1+$dato['key'])]=="" && $dato['key']!=15){
			$_SESSION['tablero'][1+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
			mostrarJuego($_SESSION['tablero']);	
		}elseif($_SESSION['tablero'][(4-$dato['key'])]=="" && $dato['key']>=3){
			$_SESSION['tablero'][4-$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
		mostrarJuego($_SESSION['tablero']);	
		}else if($_SESSION['tablero'][(4+$dato['key'])]=="" && $dato['key']<=12){
			$_SESSION['tablero'][4+$dato['key']]=$_SESSION['tablero'][$dato['key']];
			$_SESSION['tablero'][$dato['key']]="";
		mostrarJuego($_SESSION['tablero']);	
		}else mostrarJuego($_SESSION['tablero']);
		
	}
	


}else{
	/* Proceso de validación
	¿la solicitud viene desde un formulario?
	SI-> realizamos la validación
	NO-> reenviamos la solicitud a la página de logueo (login.html)
	*/
	$login=false;
	if(isset($_POST['usuario'])){
		//verificamos las credenciales de acceso
		if(usuarioValido($_POST['usuario'],$_POST['clave'])){
			$tablero=iniciarJuego();
			mostrarJuego($tablero);
		}
		else{
			$login='true';
		}
	}
	else{
		$login='true';
	}
	if($login){
		//redirección http
		header('location:login2.html');
	}
}


//////////////////////////////////////////////////////////////////
function usuarioValido($user,$password)
{	
	if($user=='pruebas' and $password=='1234'){
		$_SESSION['valido']=true;
		return true;
	}
	else{
		return false;
	}
}

function iniciarJuego()
{

	$tablero=array_merge(range(1,15));
	shuffle($tablero);
	$tablero[15]='';
	$_SESSION['tablero']=$tablero;
	$tablero2=array_fill(0,15,0);
	$_SESSION['tablero2']=$tablero2;
	$_SESSION['valor1']=0;
	$_SESSION['valor2']=0;
	$_SESSION['dato1']=0;
	$_SESSION['dato2']=0;
	$_SESSION['dato3']=14;
	$_SESSION['dato4']=11;
	return $tablero;

}

function mostrarJuego($tablero)
{
	//con include se adiciona el contenido de un archivo, es como si "pegara" el contenido
	//del archivo a partir de la linea donde aparece el "include".
	//print_r($tablero);exit;
	include "rompecabezas.tpl";
}