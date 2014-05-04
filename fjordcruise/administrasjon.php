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
	$serverschema="maro0211"

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

	<!-- InstanceBeginEditable name="EditRegion2" -->

	<script>
		if ( readCookie('profil') ) {
			window.paaloggetprofil = readCookie('profil');
			// Hacky workarounds, woo!
			if ( window.location.href.indexOf('&profil=' + window.paaloggetprofil) == -1 ) {
				window.location.replace(window.location.href + '&profil=' + window.paaloggetprofil);
			}
		}
		else {
			createCookie('previouspage', window.location.href);
			window.location.replace('paalogging.php');
		}
	</script>

	<!-- InstanceEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<br><br>
			<!-- InstanceBeginEditable name="EditRegion3" -->
			<?php
				if (@!$con=mysqli_connect($serverhost, $serveruser, $serverpass, $serverschema)){
		            	echo "<h3>MySQL-serveren er ikke tilgjengelig nå. Last inn nettsiden på nytt, eller prøv igjen senere.</h3>";
		            	exit;
		      	}

		      	$admincheck = mysqli_query( $con, "SELECT fjordcruise_profil.admin
		      						     FROM fjordcruise_profil
		      						     WHERE fjordcruise_profil.profilid = '" . $_GET['profil'] . "'" );

		      	$adminrow = mysqli_fetch_array( $admincheck );

		      	if ( $adminrow['admin'] != 1 ) {
		      		echo "Du har ikke rettigheter til å se denne siden.";
		      		exit;
		      	}	
		      	else {
		      		if ( $_GET['modus'] == 'turer' ) {
		      			echo "<form id='turform' action='submit_tur.php' method='post'>
		      					<table class='turtabell'>
		      						<tr>
		      							<th colspan='2'>Legg til tur</th>
		      						</tr>
		      						<tr>
		      							<td><font class='b'>Turnavn:</font></td>
		      							<td><input type='text' name='turnavn'></td>
		      						</tr>
		      						<tr>
		      							<td><font class='b'>Turbeskrivelse:</font></td>
		      							<td><textarea class='turtextarea' name='turbeskrivelse'></textarea><script>$('.turtextarea').elastic();</script></td>
		      						</tr>
		      						<tr>
		      							<td colspan='2'><a href='#' onclick='document.forms[&#39;turform&#39;].submit();'>Legg til tur</a></td>
		      						</tr>
		      					</table>
		      				</form>";

		      			$turerresult = mysqli_query( $con, "SELECT * FROM fjordcruise_turer" );

		      			if ( mysqli_num_rows($turerresult) > 0 ){ echo "<div class='c'><font class='b'>Se og endre turer:</font></div><br>";}

		      			while( $row = mysqli_fetch_array( $turerresult ) ) {
		      				echo "<form id='turform" . $row['turid'] . "' action='submit_tur.php' method='post'>
		      						<table class='turtabell'>
		      							<tr>
		      								<td><font class='b'>Turnavn:</font></td>
		      								<td>" . $row['turnavn'] . "</td>
		      								<td><input type='text' name='turnavn' value='" . $row['turnavn'] . "'></td>
		      							</tr>
		      							<tr>
		      								<td><font class='b'>Turbeskrivelse:</font></td>
		      								<td>" . $row['turbeskrivelse'] . "</td>
		      								<td><textarea class='turtextarea' name='turbeskrivelse'>" . $row['turbeskrivelse'] . "</textarea></td>
		      							</tr>
		      							<tr>
		      								<td colspan='3'><a href='#' onclick='document.forms[&#39;turform" . $row['turid'] . "&#39;].submit();'>Endre tur</a></td>
		      								<input type='hidden' name='endretur' value='1'>
		      								<input type='hidden' name='turid' value='" . $row['turid'] . "'>
		      							</tr>
		      						</table>
		      					</form>";
		      			}
		      		}

		      	}
			?>
			<!-- InstanceEndEditable -->
		</span>
	</div>
</body>
<!-- InstanceEnd --></html>
