<?php
    $nombre = $_GET['name'];
    $apellidop = $_GET['apellidop'];
    $apellidom = $_GET['apellidom'];
    $direccion = $_GET['direccion'];
    $dni = $_GET['dni'];
    $mes = $_GET['mes'];
    $horae = $_GET['horae'];
    $horas = $_GET['horas'];
    $serverName = "TOTOY";
	$connectionOptions = array( "Database"=>"restaurant", "UID"=>"usuario", "PWD"=>"rooting");
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( !$conn ){
        echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
    $query = "SELECT * FROM persona WHERE dni = ".$dni.";";
    $stmt = sqlsrv_query($conn,$query);
    if(!sqlsrv_num_rows($stmt)){ 
        $query = "INSERT INTO persona VALUES (".$dni.",'".$nombre."','".$apellidop."','".$apellidom."','".$direccion."');";
        $stmt = sqlsrv_query($conn,$query);
        if( !$stmt ){
            die( print_r(sqlsrv_errors(),true));
        }
        $query = "INSERT INTO cliente VALUES (".$dni.",'".$dni[0].$nombre[0].$apellidop[0].$apellidom[0]."');";
        $stmt = sqlsrv_query($conn,$query);
        if( !$stmt ){
            die( print_r(sqlsrv_errors(),true));
        }
    }
    $query = "SELECT COUNT(fechar) FROM reservacion where fechar = '".$mes."';";
    $stmti = sqlsrv_query($conn,$query);
    if( !$stmti ){
        die( print_r(sqlsrv_errors(),true));
    }
    $row = sqlsrv_fetch_array($stmti,SQLSRV_FETCH_NUMERIC);
    if(intval($row[0])<4){
        $query = "SELECT * FROM reservacion where horae = '".$horae."';";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmti = sqlsrv_query($conn,$query,$params,$options);
        if( $stmti === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
        $row_count = sqlsrv_num_rows( $stmti );
        
        if(sqlsrv_num_rows( $stmti ) == 0){
            $query = "SELECT COUNT(*) FROM reservacion";
            $stmti = sqlsrv_query($conn,$query);
            if( $stmti === false) {
                die( print_r( sqlsrv_errors(), true) );
            }
            $aux = sqlsrv_fetch_array($stmti,SQLSRV_FETCH_NUMERIC);
            $numid = $aux[0]+1;
            $query = "SELECT COUNT(*) FROM reservacion where fechar ='".$mes."' and horae = '".$horae."';";
            $stmti = sqlsrv_query($conn,$query);
            if( $stmti === false) {
                die( print_r( sqlsrv_errors(), true) );
            }
            $aux2 = sqlsrv_fetch_array($stmti,SQLSRV_FETCH_NUMERIC);
            $mesa = $aux2[0]+1;
            $code = $dni[0].strtoupper($nombre[0]).strtoupper($apellidop[0]).strtoupper($apellidom[0]);
            if ( sqlsrv_begin_transaction( $conn ) === false ) {
                die( print_r( sqlsrv_errors(), true ));
            }
            $query =    " SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;
                        BEGIN TRANSACTION;            
                        INSERT INTO reservacion VALUES (".$numid.",12,'".$code."','".$mes."','".$horae."','".$horas."',".$mesa.");COMMIT;";
            $res = sqlsrv_prepare($conn,$query);
            if( $res === false) {
                die( print_r( sqlsrv_errors(), true) );
            }
            if($res != false){
                //sleep(10);
                sqlsrv_prepare($conn,"COMMIT;");
                /*if( sqlsrv_commit($conn) === false) {
                    die( print_r( sqlsrv_errors(), true) );
                }*/
                echo "Completada tu reservación :)";
                //echo '<meta http-equiv="refresh" content="3;URL=\'home.html\'" />';
            }else{
                echo "Standby mode";
                //echo '<meta http-equiv="refresh" content="3;URL=\'home.html\'" />';
            }
        }else{
            echo "Hora no disponible";
            //echo '<meta http-equiv="refresh" content="3;URL=\'home.html\'" />';
        }
    }else{
        echo "No disponible el dia solicitado";
        //echo '<meta http-equiv="refresh" content="3;URL=\'home.html\'" />';
    }
    sqlsrv_close($conn);
?>