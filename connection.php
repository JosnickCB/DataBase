<?php
	$serverName = "TOTOY\SQLEXPRESS";
	$connectionOptions = array( "Database"=>"restaurante4", "UID"=>"user", "PWD"=>"root");

    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn ) {
     echo "Conexión establecida.<br />";
	}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
	}
    $query = "";
    $res = sqlsrv_query($conn,$query);
    while($row=sqlsrv_fetch_array($res)){
    	echo $row[0],", ",$row[1],"<br/>";
    }
?>
