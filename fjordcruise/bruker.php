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

	      					echo "<form action='submit_registrasjon.php' method='post'>
	      							<table class='cruisetable'>
	      								<tr>
	      									<th colspan='3'>Bruker: " . $row['profilnavn'] . "</th>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>E-Post:</font></td>
	      									<td>" . $row['epost'] . "</td>
	      									<td><input name='epost' type='text' value='" . $row['fornavn'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>Fornavn</font></td>
	      									<td>" . $row['fornavn'] . "</td>
	      									<td><input name='fornavn' type='text' value='" . $row['fornavn'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>Etternavn</font></td>
	      									<td>" . $row['etternavn'] . "</td>
	      									<td><input name='etternavn' type='text' value='" . $row['etternavn'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>Telefon</font></td>
	      									<td>" . $row['telefon'] . "</td>
	      									<td><input name='telefon' type='text' value='" . $row['telefon'] . "'></td>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>Nåværende passord:</font></td>
	      									<td>xxxxxxxx</td>
	      									<td><input name='gammeltpassord' type='password'></td>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>Nytt passord:</font></td>
	      									<td>xxxxxxxx</td>
	      									<td><input name='passord1' type='password'></td>
	      								</tr>
	      								<tr>
	      									<td><font class='b'>Gjenta nytt passord:</font></td>
	      									<td>xxxxxxxx</td>
	      									<td><input name='passord2' type='password'></td>
	      								</tr>
	      								<tr>
	      									<td colspan='3'><input value='Endre registrerte verdier' type='submit' onclick='createCookie(&#39;previouspage&#39;,window.location.href)'></td>
	      									<input type='hidden' name='omregistrasjon' value='1'>
	      								</tr>
	      							</table>
	      						</form>

	      						<hr>

	      						<h1>Reservasjoner</h1><br>";
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
