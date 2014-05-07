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
				<li id="paalogging"><a href="bruker.php" class="activepage">Bruker</a></li>
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
					else if ( $_GET['modus'] == 'avganger' ) {
						$turerresultcopy = mysqli_query( $con, "SELECT fjordcruise_turer.turid, fjordcruise_turer.turnavn FROM fjordcruise_turer");
						$baater = mysqli_query( $con, "SELECT * FROM fjordcruise_baater" );

						echo "<form id='avgangform' action='submit_avgang.php' method='post'>
								<table class='avgangtabell'>
									<tr>
										<th colspan='2'>Legg til avgang</th>
									</tr>
									<tr>
										<td><font class='b'>Tur:</font></td>
										<td><select name='turid'>";

										while ( $turrow = mysqli_fetch_array( $turerresultcopy ) ) {
											echo "<option value='" . $turrow['turid'] . "'>" . $turrow['turnavn'] . "</option>";
										}
						
						echo 			"</select></td>
									</tr>
									<tr>
										<td><font class='b'>Pris:</font></td>
										<td><input type='number' name='avgangpris'></td>
									</tr>
									<tr>
										<td><font class='b'>Pris(Barn/Honnør):</font></td>
										<td><input type='number' name='avgangprisbarn'></td>
									</tr>
									<tr>
										<td><font class='b'>Avgangdato:</font></td>
										<td>
											<input type='checkbox' name='avgangmandag' value='1'> Ma 
											<input type='checkbox' name='avgangtirsdag' value='1'> Ti 
											<input type='checkbox' name='avgangonsdag' value='1'> On 
											<input type='checkbox' name='avgangtorsdag' value='1'> To 
											<input type='checkbox' name='avgangfredag' value='1'> Fr 
											<input type='checkbox' name='avganglordag' value='1'> Lø 
											<input type='checkbox' name='avgangsondag' value='1'> Sø
										</td>
									</tr>
									<tr>
										<td><font class='b'>Avgangstid:</font></td>
										<td><input type='time' name='avgangtid'></td>
									</tr>
									<tr>
										<td><font class='b'>Båt:</font></td>
										<td><select name='baatid'>";

										while ( $baaterrow = mysqli_fetch_array( $baater ) ) {
											echo "<option value='" . $baaterrow['baatid'] . "'>" . $baaterrow['baatnavn'] . "</option>";
										}	

						echo			     "</select></td>
									<tr>
										<td><font class='b'>Deaktiver: </font><input type='checkbox' name='gjemtavgang' value='1'> (Gjem fra brukere)</td>
										<td><a href='#' onclick='document.forms[&#39;avgangform&#39;].submit();'>Legg til avgang</a></td>
									</tr>
								</table>
							</form>";

						$avgangresult = mysqli_query( $con, "SELECT * FROM fjordcruise_avganger, fjordcruise_turer, fjordcruise_baater WHERE fjordcruise_avganger.turid = fjordcruise_turer.turid AND fjordcruise_avganger.baatid = fjordcruise_baater.baatid" );

						if ( mysqli_num_rows($avgangresult) > 0 ){ echo "<div class='c'><font class='b'>Se og endre avganger:</font></div><br>";}

						while ( $avgangrow = mysqli_fetch_array( $avgangresult ) ) {
							$turerresultcopies = mysqli_query( $con, "SELECT fjordcruise_turer.turid, fjordcruise_turer.turnavn FROM fjordcruise_turer" );
							$baatercopy = mysqli_query( $con, "SELECT * FROM fjordcruise_baater" );

							echo "<form id='avgangform" . $avgangrow['avgangid'] . "' action='submit_avgang.php' method='post'>
									<table class='avgangtabell'>
										<tr>
											<td colspan='2'><font class='b'>Tur:</font></td>
											<td colspan='2'>" . $avgangrow['turnavn'] . "</td>
											<td colspan='2'><select name='turid'>";

											while ( $turerow = mysqli_fetch_array( $turerresultcopies ) ) {
												echo "<option value='" . $turerow['turid'] . "'";
												if ( $turerow['turid'] == $avgangrow['turid'] ) { echo "selected='selected'"; }
												echo">" . $turerow['turnavn'] . "</option>";
											}
							
							echo 			"</select></td>
										</tr>
										<tr>
											<td colspan='2'><font class='b'>Pris:</font></td>
											<td colspan='2'>" . $avgangrow['avgangpris'] . "</td>
											<td colspan='2'><input type='number' name='avgangpris' value='" . $avgangrow['avgangpris'] . "'></td>
										</tr>
										<tr>
											<td colspan='2'><font class='b'>Pris(Barn/Honnør):</font></td>
											<td colspan='2'>" . $avgangrow['avgangprisbarn'] . "</td>
											<td colspan='2'><input type='number' name='avgangprisbarn' value='" . $avgangrow['avgangprisbarn'] . "'></td>
										</tr>
										<tr>
											<td colspan='2'><font class='b'>Avgangdato:</font></td>
											<td colspan='4'>";
												echo "<input type='checkbox' name='avgangmandag' value='1'"; if ( $avgangrow['avgangmandag'] == 1 ) { echo " checked"; } echo "> Ma"; 
												echo "<input type='checkbox' name='avgangtirsdag' value='1'"; if ( $avgangrow['avgangtirsdag'] == 1 ) { echo " checked"; } echo "> Ti"; 
												echo "<input type='checkbox' name='avgangonsdag' value='1'"; if ( $avgangrow['avgangonsdag'] == 1 ) { echo " checked"; } echo "> On"; 
												echo "<input type='checkbox' name='avgangtorsdag' value='1'"; if ( $avgangrow['avgangtorsdag'] == 1 ) { echo " checked"; } echo "> To"; 
												echo "<input type='checkbox' name='avgangfredag' value='1'"; if ( $avgangrow['avgangfredag'] == 1 ) { echo " checked"; } echo "> Fr"; 
												echo "<input type='checkbox' name='avganglordag' value='1'"; if ( $avgangrow['avganglordag'] == 1 ) { echo " checked"; } echo "> Lø"; 
												echo "<input type='checkbox' name='avgangsondag' value='1'"; if ( $avgangrow['avgangsondag'] == 1 ) { echo " checked"; } echo "> Sø"; 
							echo		   "</td>
										</tr>
										<tr>
											<td colspan='2'><font class='b'>Avgangstid:</font></td>
											<td colspan='2'>" . $avgangrow['avgangtid'] . "
											<td colspan='2'><input type='time' name='avgangtid' value='" . $avgangrow['avgangtid'] . "'></td>
										</tr>
										<tr>
											<td colspan='2'><font class='b'>Båt:</td>
											<td colspan='2'>" . $avgangrow['baatnavn']  . "
											<td colspan='2'><select name='baatid'>";

											while ( $baatrow = mysqli_fetch_array( $baatercopy ) ) {
												echo "<option value='" . $baatrow['baatid'] . "'";
												if ( $baatrow['baatid'] == $avgangrow['baatid'] ) { echo "selected='selected'"; }
												echo">" . $baatrow['baatnavn'] . "</option>";
											}
										
							echo		     "<tr>
											<td colspan='3'>Deaktiver: <input type='checkbox' name='gjemtavgang' value='1'"; if ( $avgangrow['gjemtavgang'] == 1 ) { echo " checked"; } echo "> (Gjem fra brukere)</td>
											<td colspan='3'><a href='#' onclick='document.forms[&#39;avgangform" . $avgangrow['avgangid'] . "&#39;].submit();'>Endre avgang</a></td>
											<input type='hidden' name='avgangid' value='" . $avgangrow['avgangid'] . "'>
											<input type='hidden' name='endreavgang' value='1'>
										</tr>
									</table>
								</form>";
						}
					}
					else if ( $_GET['modus'] == "reservasjoner" ) {
						$reservationsentence = "SELECT fjordcruise_bestillinger.antallbilletter, fjordcruise_bestillinger.antallbarnebilletter, fjordcruise_bestillinger.bestiltdato, fjordcruise_turer.turnavn, fjordcruise_baater.baatnavn, fjordcruise_profil.fornavn, fjordcruise_profil.etternavn
	      										FROM fjordcruise_bestillinger, fjordcruise_baater, fjordcruise_turer, fjordcruise_profil, fjordcruise_avganger
	      										WHERE fjordcruise_bestillinger.avgangid = fjordcruise_avganger.avgangid
	      										AND fjordcruise_avganger.baatid = fjordcruise_baater.baatid
	      										AND fjordcruise_avganger.turid = fjordcruise_turer.turid
	      										AND fjordcruise_bestillinger.profilid = fjordcruise_profil.profilid
	      										ORDER BY fjordcruise_bestillinger.bestiltdato DESC";

	      						$reservationarray = mysqli_query($con, $reservationsentence);

	      						if ( mysqli_num_rows($reservationarray) ) {
		      						echo "<h1>Reservasjoner</h1><div id='reservationwrap'>";

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
		      						echo "Det finnes ingen reservasjoner.";
		      					}

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
