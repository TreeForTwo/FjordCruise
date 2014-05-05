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
	<script src="js/cookies.js"></script>
	<script>
		$( document ).ready(
			function () {
				ResizeTitle()
				CenterNav()
				ScaleContent()
				/* Resizing is handled within these scripts, don't repeat them */
				$("#titlecenter").fitText(1, { minFontSize:'60px', maxFontSize:'80px' } )
				$("#content").flowtype( { fontRatio: 42, maxFont: 21 });
			}
		);

		$( window ).resize(
			function () {
				ResizeTitle()
				CenterNav()
				ScaleContent()
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

		      		if ( isset( $_POST['endretur'] ) ) {
		      			$previousvalues = mysqli_query($con, "SELECT * FROM fjordcruise_turer WHERE fjordcruise_turer.turid = '" . $_POST['turid'] . "'");
		      			$row = mysqli_fetch_array($previousvalues);

		      			// Manually comparing these is simpler than doing a foreach loop		      			

		      			if ( isset( $_POST['turnavn'] ) && ( $row['turnavn'] != $_POST['turnavn'] ) ) {
		      				$newarray['turnavn'] = mysqli_real_escape_string( $con, $_POST['turnavn'] );
		      			}

		      			if ( isset( $_POST['turbeskrivelse'] ) && ( $row['turbeskrivelse'] != $_POST['turbeskrivelse'] ) ) {
		      				$newarray['turbeskrivelse'] = mysqli_real_escape_string( $con, $_POST['turbeskrivelse'] );
		      			}

		      			foreach($newarray as $k => $v) {
		      				if ( !mysqli_query($con, "UPDATE fjordcruise_turer
		      					              SET $k = '" . $v . "'
		      					              WHERE fjordcruise_turer.turid = " . $_POST['turid']) ) {
		      					echo "Det har skjedd en feil! <a href='#' onclick='history.go(-1);'>Prøv igjen?</a>";
		      				}
		      			}

		      			echo "Turen har nå blitt oppdatert! Du vil bli tatt tilbake til tursiden snart. <a href='administrasjon.php?modus=turer'>Klikk her hvis det tar lenger enn noen sekunder.</a>
		      				<script>
		      					setTimeout( function() { window.location.replace( 'administrasjon.php?modus=turer' ) }, 5000 );
		      				</script>";

		      		}
		      		else {
		      			$turnavn = mysqli_real_escape_string( $con, $_POST['turnavn'] );
		      			$turbeskrivelse = mysqli_real_escape_string( $con, $_POST['turbeskrivelse'] );

		      			$sqlsentence = "INSERT INTO fjordcruise_turer ( turnavn, turbeskrivelse )
		      					    VALUES ( '" . $turnavn . "', '" . $turbeskrivelse . "' )";



		      			if ( !mysqli_query($con, $sqlsentence) ) {
		      				echo "something just happened";
		      			}
		      			else {
		      				echo "Turen har nå blitt lagt til. Du blir snart tatt tilbake til tursiden. <a href='paalogging.php'>Klikk her hvis det tar lenger enn noen sekunder.</a>
			      				<script>
			      					setTimeout( function() { window.location.replace( 'administrasjon.php?modus=turer' ) }, 5000 );
			      				</script>";
		      			}
		      		}
				?>
			<!-- InstanceEndEditable -->
		</span>
	</div>
</body>
<!-- InstanceEnd --></html>
