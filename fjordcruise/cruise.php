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
				<li id="paalogging"><a href="paalogging.php">Pålogging</a></li>
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
      		
	      		$sqlstatement =  "SELECT fjordcruise_avganger.avgangid, fjordcruise_avganger.avgangtid, fjordcruise_avganger.avgangpris, fjordcruise_avganger.avgangprisbarn, 
	      						 fjordcruise_avganger.avgangmandag,  fjordcruise_avganger.avgangtirsdag,  fjordcruise_avganger.avgangonsdag,  fjordcruise_avganger.avgangtorsdag,  fjordcruise_avganger.avgangfredag,  fjordcruise_avganger.avganglordag,  fjordcruise_avganger.avgangsondag,  fjordcruise_avganger.avgangdato, 
	      						 fjordcruise_turer.turnavn, fjordcruise_turer.turbeskrivelse, fjordcruise_turer.turvarighet, fjordcruise_baater.baatplasser, fjordcruise_baater.baatnavn
	      					FROM fjordcruise_avganger, fjordcruise_turer, fjordcruise_baater
	      					WHERE fjordcruise_avganger.baatid = fjordcruise_baater.baatid
	      					AND fjordcruise_avganger.turid = fjordcruise_turer.turid
	      					AND fjordcruise_avganger.gjemtavgang IS NULL";

	      		$cruise = mysqli_query($con, $sqlstatement);

	      		while( $row = mysqli_fetch_array($cruise)) {
	      			echo "<table class='cruisetable'>
	      					<tr>
	      						<th colspan='2'>" . $row['turnavn'] . "</th>
	      					</tr>
	      					<tr>
	      						<td rowspan='3'>" . $row['turbeskrivelse'] . "</td>
	      						<td><font class='b'>Avganger</font><br>Dato går hit - " . str_replace('00:00', '00', $row['avgangtid']) . "</td>
	      					</tr>
	      					<tr>
	      						<td><font class='b'>Pris:</font><br>Voksne: " . $row['avgangpris'] . "<br>Barn/Honnør: " . $row['avgangprisbarn'] . "</td>
	      					</tr>
	      					<tr>
	      						<td class='orderbutton'><a href='bestilling.php?id=" . $row['avgangid'] . "'>Bestill!</a></td>
	      					</tr>
						</table>";
	      		}
      		?>



			<!-- InstanceEndEditable -->
		</span>
	</div>
</body>
<!-- InstanceEnd --></html>
