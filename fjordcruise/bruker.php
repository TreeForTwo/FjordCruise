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

	<!-- InstanceBeginEditable name="EditRegion2" -->

	<script>
		if ( readCookie('profil') ) {
			window.paaloggetprofil = readCookie('profil');
			// Hacky workarounds, woo!
			if ( window.location.href.indexOf('?profil=' + window.paaloggetprofil) == -1 ) {
				window.location.replace(window.location.href + '?profil=' + window.paaloggetprofil);
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

					if ($_GET['profil']) {
	      				if (@!$con=mysqli_connect($serverhost, $serveruser, $serverpass, $serverschema)){
	            				echo "<h3>MySQL-serveren er ikke tilgjengelig nå. Last inn nettsiden på nytt, eller prøv igjen senere.</h3>";
	            				exit;
	      				}

	      				$sqlsentence = "SELECT fjordcruise_profil.epost, fjordcruise_profil.profilnavn, fjordcruise_profil.passord, fjordcruise_profil.fornavn, fjordcruise_profil.etternavn, fjordcruise_profil.telefon, fjordcruise_profil.admin
	      						    FROM fjordcruise_profil
	      						    WHERE fjordcruise_profil.profilid = " . $_GET['profil'];

	      				$profilresultat = mysqli_query($con, $sqlsentence);

	      				// Run sanity-checks
	      				if ( mysqli_num_rows($profilresultat) == 1 ) { 
	      					$row = mysqli_fetch_array($profilresultat);

	      					if ( $row['admin'] ) {
	      						echo "<table id='admintable' class='cruisetable'>
	      								<tr>
	      									<th colspan='3'>Administrasjon</th>
	      								</tr>
	      								<tr>
	      									<td><a href='administrasjon.php?modus=turer'>Turer</a></td>
	      									<td><a href='administrasjon.php?modus=avganger'>Avganger</a></td>
	      									<td><a href='administrasjon.php?modus=reservasjoner'>Reservasjoner</a></td>
	      								</tr>
	      							</table>";
	      					}

	      					echo "<form id='omregistrasjonform' action='submit_registrasjon.php' method='post'>
	      							<table class='cruisetable'>
	      								<tr>
	      									<th colspan='6'>Bruker: " . $row['profilnavn'] . "</th>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>E-Post:</font></td>
	      									<td colspan='2'>" . $row['epost'] . "</td>
	      									<td colspan='2'><input name='epost' type='text' value='" . $row['epost'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>Fornavn</font></td>
	      									<td colspan='2'>" . $row['fornavn'] . "</td>
	      									<td colspan='2'><input name='fornavn' type='text' value='" . $row['fornavn'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>Etternavn</font></td>
	      									<td colspan='2'>" . $row['etternavn'] . "</td>
	      									<td colspan='2'><input name='etternavn' type='text' value='" . $row['etternavn'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>Telefon</font></td>
	      									<td colspan='2'>" . $row['telefon'] . "</td>
	      									<td colspan='2'><input name='telefon' type='text' value='" . $row['telefon'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>Nåværende passord:</font></td>
	      									<td colspan='2'>xxxxxxxx</td>
	      									<td colspan='2'><input name='gammeltpassord' type='password'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>Nytt passord:</font></td>
	      									<td colspan='2'>xxxxxxxx</td>
	      									<td colspan='2'><input name='passord1' type='password'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='2'><font class='b'>Gjenta nytt passord:</font></td>
	      									<td colspan='2'>xxxxxxxx</td>
	      									<td colspan='2'><input name='passord2' type='password'></td>
	      								</tr>
	      								<tr style='text-align:center;'>
	      									<td colspan='3'><a href='#' onclick='eraseCookie(&#39;profil&#39);window.location.replace(&#39;index.php&#39);'>Logg av</a></td>
	      									<td colspan='3'><a href='#' onclick='createCookie(&#39;previouspage&#39;,window.location.href);document.forms[&#39;omregistrasjonform&#39;].submit();'>Endre verdier</a></td>
	      									<input type='hidden' name='omregistrasjon' value='1'>
	      									<input type='hidden' name='profilid' value='" . $_GET['profil'] . "'>
	      								</tr>
	      							</table>
	      						</form>";

	      						$reservationsentence = "SELECT fjordcruise_bestillinger.antallbilletter, fjordcruise_bestillinger.antallbarnebilletter, fjordcruise_bestillinger.bestiltdato, fjordcruise_turer.turnavn, fjordcruise_baater.baatnavn, fjordcruise_profil.fornavn, fjordcruise_profil.etternavn
	      										FROM fjordcruise_bestillinger, fjordcruise_baater, fjordcruise_turer, fjordcruise_profil, fjordcruise_avganger
	      										WHERE fjordcruise_bestillinger.avgangid = fjordcruise_avganger.avgangid
	      										AND fjordcruise_avganger.baatid = fjordcruise_baater.baatid
	      										AND fjordcruise_avganger.turid = fjordcruise_turer.turid
	      										AND fjordcruise_bestillinger.profilid = " . $_GET['profil'] . "
	      										AND fjordcruise_profil.profilid = " . $_GET['profil'] . "
	      										ORDER BY fjordcruise_bestillinger.bestiltdato DESC";

	      						$reservationarray = mysqli_query($con, $reservationsentence);

	      						if ( mysqli_num_rows($reservationarray) ) {
		      						echo "<hr>
		      							<h1>Reservasjoner</h1><br><div id='reservationwrap'>";

		      						while( $reservations = mysqli_fetch_array($reservationarray) ) {
		      							echo "<table class='reservationtable'>
		      									<tr>
		      										<th colspan='2'>" . $reservations['turnavn'] . "</th>
		      									</tr>
		      									<tr>
		      										<td colspan='2'>" . $reservations['fornavn'] . " " . $reservations['etternavn'] . "</td>
		      									</tr>
		      									<tr>
		      										<td>" . $reservations['antallbilletter'] . " voksenbilletter</td>
		      										<td>" . $reservations['antallbarnebilletter'] . " barnebilletter</td>
		      									</tr>
		      									<tr>
		      										<td>" . $reservations['bestiltdato'] . "</td>
		      										<td>" . $reservations['baatnavn'] . "</td>
		      									</tr>
		      								</table>";
		      						}

		      						echo "</div>";
		      					}
		      					else {
		      						echo "Found no reservations.";
		      					}

	      				}
	      				else {
	      					//panic
	      					echo "Here i was, spending days on an elaborate and hacky login system, and you go and change cookies to try to bypass it. No. Go away. Go to your browser's cookie viewer and delete the login cookie. You should feel ashamed.";
	      					exit;
	      				}
					}
				
				?>
			<!-- InstanceEndEditable -->
		</span>
	</div>
</body>
<!-- InstanceEnd --></html>
