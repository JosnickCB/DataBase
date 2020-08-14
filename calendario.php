<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <!-- Site Metas -->
    <title>Calendario</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">    
    <!-- Pickadate CSS -->
    <link rel="stylesheet" href="css/classic.css">    
    <link rel="stylesheet" href="css/classic.date.css">    
    <link rel="stylesheet" href="css/classic.time.css">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <link rel="stylesheet" href="css/style.css">
    <title>Reservaciones Semanales</title>
</head>
<body>
    <header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>-->
				<div class="collapse navbar-collapse" id="navbars-rs-food">
					<ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="home.html">Inicio</a></li>
						<li class="nav-item"><a class="nav-link" href="">Calendario</a></li>
						<li class="nav-item"><a class="nav-link" href="platillos.html">Galeria</a></li>
						<li class="nav-item"><a class="nav-link" href="chefs.html">Chefs</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
    <br>
    <br>
    <br>
    <br>
    <div class="cd-schedule cd-schedule--loading margin-top-lg margin-bottom-lg js-cd-schedule">
    <div class="cd-schedule__timeline">
      <ul>
        <li><span>08:00</span></li>
        <li><span>08:30</span></li>
        <li><span>09:00</span></li>
        <li><span>09:30</span></li>
        <li><span>10:00</span></li>
        <li><span>10:30</span></li>
        <li><span>11:00</span></li>
        <li><span>11:30</span></li>
        <li><span>12:00</span></li>
        <li><span>12:30</span></li>
        <li><span>13:00</span></li>
        <li><span>13:30</span></li>
        <li><span>14:00</span></li>
        <li><span>14:30</span></li>
        <li><span>15:00</span></li>
        <li><span>15:30</span></li>
        <li><span>16:00</span></li>
        <li><span>16:30</span></li>
        <li><span>17:00</span></li>
        <!--<li><span>17:30</span></li>
        <li><span>18:00</span></li>
        <li><span>18:30</span></li>
        <li><span>19:00</span></li>
        <li><span>19:30</span></li>
        <li><span>20:00</span></li-->
      </ul>
    </div> <!-- .cd-schedule__timeline -->
    <?php
        $serverName = "TOTOY";
        $connectionOptions = array( "Database"=>"restaurant", "UID"=>"usuario", "PWD"=>"rooting",/*"ReturnDateAsStrings"=>true*/);
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if( !$conn ){
            echo "Conexión no se pudo establecer.<br />";
            die( print_r( sqlsrv_errors(), true));
        }
        $query = "SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
                  BEGIN TRANSACTION;
                  SELECT * FROM reservacion;
                  COMMIT;";
        $stmt = sqlsrv_query($conn,$query);
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        echo ("<div class=\"cd-schedule__events\">
        <ul>");
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
            echo("<li class=\"cd-schedule__group\">
            <div class=\"cd-schedule__top-info\"><span>".$row['fechar']->format('d/m/Y')."</span></div>
            <ul>");
            //list($day,$month,$year,$hour,$min,$sec) = $row['horae'];
            /*echo("<li class=\"cd-schedule__event\">
            <a data-start=\"".$row['horae']->format('Y-m-d H:i:s')."\" data-end=\"".$row['horas']->format('Y-m-d H:i:s')."\" data-content=\"event-abs-circuit\" data-event=\"event-4\" href=\"#0\">
              <em class=\"cd-schedule__name\">Abs Circuit</em>
            </a>
          </li>");*/
            echo("</ul>
            </li>");
        }
        echo("</ul>
        </div>");
        sqlsrv_close($conn);
    ?>
    <div class="col-md-12">
    <div class="submit-button text-center">
        <!--button class="btn btn-common" id="submit" type="submit" >Lista</button>
        <div id="msgSubmit" class="h3 text-center hidden"></div>
        <div class="clearfix"></div-->
        <<p><a class="btn btn-lg btn-circle btn-outline-new-white" href="home.html">Inicio</a></p>>
    </div>
</div>
    <!--<script src="js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="js/main.js"></script>
</body>
</html>