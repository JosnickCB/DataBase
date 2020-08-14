<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inicialización</title>
</head>
<body>
	<H1 align="center">RESERVACIÓN</H1>
	<?php
		$nombre = $_GET["nombre"];
		$apellidop = $_GET["apellidop"];
		$apellidom = $_GET["apellidom"];
		$dni = $_GET["dni"];
		$direccion = $_GET["direccion"];
		$hora = $_GET["date"];
		$shora = preg_split('/[:,.]/',$hora);
		$serverName = "TOTOY\SQLEXPRESS";
		$connectionOptions = array( "Database"=>"restaurante4", "UID"=>"user", "PWD"=>"root");
    	$conn = sqlsrv_connect($serverName, $connectionOptions);
		$query = "INSERT INTO persona VALUES (".$dni.",'".$nombre."','".$apellidop."','".$apellidom."','".$direccion."')";
		sqlsrv_query( $conn, $query);
		/*$query = "INSERT INTO cliente VALUES (".$dni.",'".$nombre[0].$apellidop[0].$apellidom[0].$dni[0]"')";
		if( $stmt === false ) {
     		die( print_r( sqlsrv_errors(), true));
		}*/
		$code = $nombre[0].$apellidop[0].$apellidom[0].$dni[0];
		$query = "INSERT INTO cliente VALUES (".$dni.",'".$code."');";
		sqlsrv_query($conn, $query);
		$query = "SELECT COUNT(id) FROM reservacion";
		$aux=sqlsrv_fetch_array(sqlsrv_query($conn,$query));
		$nid = $aux[0];
		print_r($nid);
		$query = "INSERT INTO reservacion VALUES(".$nid.",4,'".$code."','".$hora."','".$hora."',null);";
		$s = sqlsrv_query($conn,$query);
		if( $s === false ) {
		    die( print_r( sqlsrv_errors(), true));
		}

	?>

	<meta http-equiv="Refresh" content="0,http://localhost/conex_sql/select_mesa.php">
</body>
</html>