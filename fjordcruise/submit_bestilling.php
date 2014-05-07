<!doctype html>
<html><!-- InstanceBegin template="/Templates/fjordcruise-maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="iso-8859-1">
<link rel="stylesheet" type="text/css" href="css/main.css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>FjordCruise</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.scalewindow.js"></script>
	<script src="js/jquery.fittext.js"></script>
	<script src="js/jquery.flowtype.js"></script>
	<script src="js/date-nb-NO.js"></script>
	<script src="js/cookies.js"></script>
	<script>
		$( document ).ready(
			function () {
				ResizeTitle();
				CenterNav();
				ScaleContent();
				/* Resizing is handled within these scripts, don't repeat them */
				$("#titlecenter").fitText(1, { minFontSize:'60px', maxFontSize:'80px' } )
				$("#content").flowtype( { fontRatio: 42, maxFont: 21 });

				/* Mark current page button as active */
				$("[href]").each(function() {
    					if (this.href == window.location.href) {
        					$(this).addClass("activepage");
        				}
    				});
			}
		);

		$( window ).resize(
			function () {
				ResizeTitle();
				CenterNav();
				ScaleContent();
			}
		);
	</script>

	<?php

	$serverhost="p:localhost";
	$serveruser="root";
	$serverpass="";
	$serverschema="maro0211";

	?>



	<nav>
		<!-- Titlebar -->
		<div id="titlewrap">
			<div id="titleleft">
				&nbsp;
			</div>
			<div id="titlecenter">
			      <span>	
					<a href="index.php">FjordCruise</a>
				</span>
			</div>
			<div id="titleright">
				&nbsp;
			</div>
		</div>

		<!-- Navigation -->
		<div id="navwrap">
			<ul>
				<li><a href="aakrafjorden.php">Åkrafjorden</a></li>
				<li><a href="cruise.php">Cruise</a></li>
				<li><a href="aktiviteter.php">Aktiviteter</a></li>
				<li><a href="omoss.php">Informasjon</a></li>
				<li id="paalogging"><a href="bruker.php">Bruker</a></li>
			</ul>
		</div>
	</nav>

	<div id="backgroundgradient"></div>

	<!-- InstanceBeginEditable name="EditRegion2" --><!-- InstanceEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<br><br>
			<!-- InstanceBeginEditable name="EditRegion3" -->
				<?php
					if (@!$con=mysqli_connect($serverhost, $serveruser, $serverpass, $serverschema)){
		            		echo "<h3>MySQL-serveren er ikke tilgjengelig nå. Last inn nettsiden på nytt, eller prøv igjen senere.</h3>";
		            		exit;
		      		}

	      			$insertinto = "INSERT INTO fjordcruise_bestillinger ( ";
	      			$values = "VALUES ( ";

	      			foreach( $_POST as $k => $v ) {
	      				${$k} = mysqli_real_escape_string( $con, $v );

	      				$insertinto = $insertinto . $k . ", ";
	      				$values = $values . "'" . ${$k} . "', ";
	      			}

	      			$insertinto = rtrim($insertinto, ", , ") . " ) ";
					$values = rtrim($values, ", , ") . " )";

					$sqlsentence = $insertinto . $values;

	      			if ( !mysqli_query($con, $sqlsentence) ) {
	      				echo "Noe har gått galt! Vennligst send oss en e-post om dette";
	      			}
	      			else {
	      				echo "Bestillingen din har blitt gjennomført. Du blir snart tatt med til brukersiden din, hvor du vil finne bekreftelse på dette. <a href='bruker.php'>Klikk her hvis det tar lenger enn noen sekunder.</a>
		      				<script>
		      					setTimeout( function() { window.location.replace( 'bruker.php' ) }, 5000 );
		      				</script>";
	      			}		      		
		      	?>			

			<!-- InstanceEndEditable -->
		</span>
	</div>

	<?php
		if (isset($con)) {
			mysqli_close($con);
		}
	?>
</body>
<!-- InstanceEnd --></html>
