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

	<div id="backgroundwrap"><div id="backgroundgradient">&nbsp;</div></div>

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

		      		if ( isset( $_POST['omregistrasjon'] ) ) {
		      			$previousvalues = mysqli_query($con, "SELECT * FROM fjordcruise_profil WHERE fjordcruise_profil.profilid = '" . $_POST['profilid'] . "'");
		      			$row = mysqli_fetch_array($previousvalues);

		      			if ( $row['passord'] != $_POST['gammeltpassord'] ) {
		      				echo "Passordet du oppga samsvarer ikke med ditt gamle passord. <a href='#' onclick='history.go(-2);'>Prøv igjen?</a>";
		      				exit;
		      			}

		      			// Manually comparing these is simpler than doing a foreach loop

		      			if ( isset( $_POST['passord1'], $_POST['passord2'] ) && $_POST['passord1'] != '' ) {
		      				if ( $_POST['passord1'] === $_POST['passord2'] ) {
		      					$newarray['passord'] = $_POST['passord1'];
		      				}
		      				else {
		      					echo "Du må oppgi samme passordet i begge rutene for sikkerhets skyld. <a href='#' onclick='history.go(-2);'>Prøv igjen?</a>";
		      					exit;
		      				}
		      			}
		      			elseif ( $_POST['passord1'] || $_POST['passord2'] ) {
		      				echo "Du må oppgi samme passordet i begge rutene for sikkerhets skyld. <a href='#' onclick='history.go(-2);'>Prøv igjen?</a>";
		      				exit;
		      			}		      			

		      			if ( isset( $_POST['epost'] ) && ( $row['epost'] != $_POST['epost'] ) ) {
		      				$newarray['epost'] = mysqli_real_escape_string( $con, $_POST['epost'] );
		      			}

		      			if ( isset( $_POST['fornavn'] ) && ( $row['fornavn'] != $_POST['fornavn'] ) ) {
		      				$newarray['fornavn'] = mysqli_real_escape_string( $con, $_POST['fornavn'] );
		      			}

		      			if ( isset( $_POST['etternavn'] ) && ( $row['etternavn'] != $_POST['etternavn'] ) ) {
		      				$newarray['etternavn'] = mysqli_real_escape_string( $con, $_POST['etternavn'] );
		      			}

		      			if ( isset( $_POST['telefon'] ) && ( $row['telefon'] != $_POST['telefon'] ) ) {
		      				$newarray['telefon'] = mysqli_real_escape_string( $con, $_POST['telefon'] );
		      			}

		      			foreach($newarray as $k => $v) {
		      				if ( !mysqli_query($con, "UPDATE fjordcruise_profil
		      					              SET $k = '" . $v . "'
		      					              WHERE fjordcruise_profil.profilid = " . $_POST['profilid']) ) {
		      					echo "Det har skjedd en feil! Kanskje du har skrevet inn en epost som allerede er i bruk. <a href='#' onclick='history.go(-1);'>Prøv igjen?</a>";
		      				}
		      			}

		      			echo "Profilen din har nå blitt oppdatert! Du vil bli tatt tilbake til brukersiden snart. <a href='bruker.php'>Klikk her hvis det tar lenger enn noen sekunder.</a>
		      				<script>
		      					setTimeout( function() { window.location.replace( 'bruker.php' ) }, 5000 );
		      				</script>";

		      		}
		      		else {
		      			$brukernavn = mysqli_real_escape_string( $con, $_POST['profilnavn'] );
		      			$epost = mysqli_real_escape_string( $con, $_POST['epost'] );
		      			$fornavn = mysqli_real_escape_string( $con, $_POST['fornavn'] );
		      			$etternavn = mysqli_real_escape_string( $con, $_POST['etternavn'] );
		      			$telefon = mysqli_real_escape_string( $con, $_POST['telefon'] );

		      			if ( $_POST['passord1'] === $_POST['passord2'] ) {
		      				$passord = $_POST['passord1'];
		      			}
		      			else {
		      				echo "Passordene samsvarte ikke med hverandre! <a href='#' onclick='history.go(-2);'>Gå tilbake og prøv igjen?</a>";
		      				exit;
		      			}

		      			foreach( $_POST as $v ) {
		      				if ( $v == "" ) {
		      				echo "Du har ikke skrevet inn alle verdiene! <a href='#' onclick='history.go(-2);'>Gå tilbake og prøv igjen?</a>";
		      				exit;		      					
		      				}
		      			}

		      			$sqlsentence = "INSERT INTO fjordcruise_profil ( epost, profilnavn, passord, fornavn, etternavn, telefon )
		      					    VALUES ( '" . $epost . "', '" . $brukernavn . "', '" . $passord . "', '" . $fornavn . "', '" . $etternavn . "', '" . $telefon . "' )";



		      			if ( !mysqli_query($con, $sqlsentence) ) {
		      				echo "something just happened";
		      			}
		      			else {
		      				echo "Du har nå blitt registrert! Du vil bli tatt til riktig side snart. <a href='paalogging.php'>Klikk her hvis det tar lenger enn noen sekunder.</a>
			      				<script>
			      					setTimeout( function() { window.location.replace( readCookie('previouspage') ) }, 5000 );
			      				</script>";
		      			}
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
