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

	$serverhost="p:elevweb.akershus-fk.no";
	$serveruser="maro0211";
	$serverpass="FjGhrtyu";
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

	      		$sqlstatement =  "SELECT fjordcruise_profil.profilid
	      					FROM fjordcruise_profil
	      					WHERE ( fjordcruise_profil.epost = '" . $_POST['brukernavn'] . "' OR fjordcruise_profil.profilnavn = '" . $_POST['brukernavn'] . "' )
	      					AND fjordcruise_profil.passord = '" . $_POST['passord'] . "'";


	      		$profilresultat = mysqli_query($con, $sqlstatement);

	      		if ( $profilresultat !== false && mysqli_num_rows($profilresultat) > 0 ) {
	      			echo "<script>
	      					createCookie('profil', '" . mysqli_fetch_array($profilresultat)['profilid'] . "', 7);
	      					if ( readCookie('previouspage') ) {
	      						setTimeout( function() { window.location.replace( readCookie('previouspage') ) }, 5000 );
	      					}
	      					else {
	      						setTimeout( function() { window.location.replace( 'bruker.php' ) }, 5000 );
	      					}
	      				</script>
	      				Du har blitt logget inn på profilen " . $_POST['brukernavn'] . ". Du vil bli videresendt til nettsiden du ville besøke straks.";
	      		}
	      		else {
	      			echo "Brukernavnet eller passordet som ble oppgitt er ikke riktig. <a href='#' onclick='window.location.replace(&#39;paalogging.php&#39;)'>Prøv igjen?</a>";
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
