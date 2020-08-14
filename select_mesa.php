<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SELECCIÓN</title>
</head>
<body>
	<H2 align="center">SELECCIONE LA MESA</H2>
	<?php
		$serverName = "TOTOY\SQLEXPRESS";
		$connectionOptions = array( "Database"=>"restaurante4", "UID"=>"user", "PWD"=>"root");
    	$conn = sqlsrv_connect($serverName, $connectionOptions);
    	sqlsrv_begin_transaction($conn);
		//$query = "SET TRANSACTION ISOLATION LEVEL READ COMMITED ; GO BEGIN TRANSACTION ; GO SELECT * FROM mesa";
		$query = "select * from mesa";
		$result = sqlsrv_query( $conn, $query);
		while($row = sqlsrv_fetch_array($result)){
			echo $row[0]."<br>";
		}
		echo "<br><br>"
		//2020-07-18T20:30:00
	?>
	<form action="select_mesa.php" method="get">
		<label>Número: <input type="text" name="idm"></label><br><br>
		<label>Hora de fin: <input type="text" name="ff"></label>
	</form>
	<?php
		function commit(){
			$serverName = "TOTOY\SQLEXPRESS";
			$connectionOptions = array( "Database"=>"restaurante4", "UID"=>"user", "PWD"=>"root");
    		$conn = sqlsrv_connect($serverName, $connectionOptions);	
    		sqlsrv_commit ($conn);
    		header("Location: main.php");
    		exit();
		}
		$numero = $_GET["idm"];
		$hora = $_GET["ff"];
		$serverName = "TOTOY\SQLEXPRESS";
		$connectionOptions = array( "Database"=>"restaurante4", "UID"=>"user", "PWD"=>"root");
    	$conn = sqlsrv_connect($serverName, $connectionOptions);
		$query = "UPDATE reservacion SET horas = '".$hora."' WHERE id = 0";
		sqlsrv_query( $conn, $query);
		echo "<input type=\"button\" onclick=\"location = 'main.php'\" value = 'Reservar'/> ";
	?>
</body>
</html>