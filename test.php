<?php
    $nombre = $_GET['name'];
    $apellidop = $_GET['apellidop'];
    $apellidom = $_GET['apellidom'];
    $direccion = $_GET['direccion'];
    $dni = $_GET['dni'];
    $mes = $_GET['mes'];
    $hora = $_GET['hora'];
    $serverName = "TOTOY";
	$connectionOptions = array( "Database"=>"restaurant", "UID"=>"usuario", "PWD"=>"rooting");
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( !$conn ){
        echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
	}
	/*$query = "SELECT COUNT(*) FROM reservacion;";
	$stmti = sqlsrv_query($conn,$query);
	$aux = sqlsrv_fetch_array($stmti,SQLSRV_FETCH_NUMERIC);
	$numid = $aux[0]+1;
	$query = "SELECT COUNT(*) FROM reservacion where fechar ='".$mes."' and horae = '".$hora."';";
	$stmti = sqlsrv_query($conn,$query);
	if( $stmti === false ) {
		die( print_r( sqlsrv_errors(), true));
   	}
	$aux2 = sqlsrv_fetch_array($stmti,SQLSRV_FETCH_NUMERIC);
	$mesa = $aux2[0]+1;
	$code = $dni[0].strtoupper($nombre[0]).strtoupper($apellidop[0]).strtoupper($apellidom[0]);
	echo $code.'<br>';
	echo $numid.'<br>';
	echo $mes.' '.$hora;
	$query =    " SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;
				BEGIN TRANSACTION;
				INSERT INTO reservacion VALUES (".$numid.",12,'".$mes."','".$hora.",null,".$mesa.");";
				INSERT INTO reservacion VALUES ();";
	$params 
	$res = sqlsrv_query($conn,$query,array("QueryTimeout" => '3'));
	if( $res === false ) {
		die( print_r( sqlsrv_errors(), true));
   	}else{
		sleep(10);
		sqlsrv_query($conn,"COMMIT;");
	}
	sqlsrv_close($conn);*/
	$code = $dni[0].strtoupper($nombre[0]).strtoupper($apellidop[0]).strtoupper($apellidom[0]);
	query = "SELECT COUNT(*) FROM reservacion;";
	$stmt = sqlsrv_query($conn,$query);
	$aux = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC);
	$numid = $aux[0]+1;
	$query = " SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;
	BEGIN TRANSACTION;
	INSERT INTO reservacion VALUES (?,?,?,?,?,?,?);";
	$params = array($numid,12,$code,$mes,$hora,null,3);
	$result = sqlsrv_query($conn, $query, $params, array("QueryTimeout" => 3));
	if( $result === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	sleep(10);
	sqlsrv_query($conn,"COMMIT;");
?>