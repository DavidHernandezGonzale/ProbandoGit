exion.phpPHP
<?php
	$mysqli=new mysqli("localhost","root","","ddl_base de datos"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	//$mysqli=new mysqli("localhost", "poderfin_admcrm", "#CRMMEX2020.!?", "poderfin_crm"); 
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>
