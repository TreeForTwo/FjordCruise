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

	<!-- InstanceBeginEditable name="EditRegion2" -->

	<script>
		function CruiseForm( formname ) {
			if ( readCookie('profil') ) {
				window.paaloggetprofil = readCookie('profil');
				$(".profilid").val(window.paaloggetprofil);
				document.forms[formname].submit();
			}
			else {
				createCookie('previouspage', 'cruise.php');
				window.location.replace('paalogging.php');
			}
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

	      		function FindDates( $id, $connection ) {
	      			$datoer = mysqli_query( $connection, "SELECT fjordcruise_avganger.avgangmandag,  fjordcruise_avganger.avgangtirsdag,  fjordcruise_avganger.avgangonsdag,  fjordcruise_avganger.avgangtorsdag,  fjordcruise_avganger.avgangfredag,  fjordcruise_avganger.avganglordag,  fjordcruise_avganger.avgangsondag
	      				                           FROM fjordcruise_avganger
	      				                           WHERE fjordcruise_avganger.avgangid = $id" );

	      			$datestring = "";

	      			$stuff = mysqli_fetch_assoc( $datoer );

	      			foreach( $stuff as $k => $v ) {
						if ( isset( $v ) ) {
							$datestring = $datestring . ucfirst( str_replace('avgang', '', $k) ) . ", ";
						}
	      			}

	      			$datestring = rtrim( $datestring, ", " );

	      			$datestring = str_replace( 'Lordag', 'Lørdag', $datestring );
	      			$datestring = str_replace( 'Sondag', 'Søndag', $datestring );

	      			return $datestring;
	      		}
      		
	      		$sqlstatement =  "SELECT fjordcruise_avganger.avgangid, fjordcruise_avganger.avgangtid, fjordcruise_avganger.avgangpris, fjordcruise_avganger.avgangprisbarn, 
	      						 fjordcruise_turer.turid, fjordcruise_turer.turnavn, fjordcruise_turer.turbeskrivelse, fjordcruise_baater.baatplasser, fjordcruise_baater.baatnavn
	      					FROM fjordcruise_avganger, fjordcruise_turer, fjordcruise_baater
	      					WHERE fjordcruise_avganger.baatid = fjordcruise_baater.baatid
	      					AND fjordcruise_avganger.turid = fjordcruise_turer.turid
	      					AND fjordcruise_avganger.gjemtavgang IS NULL";

	      		$cruise = mysqli_query($con, $sqlstatement);

	      		while( $row = mysqli_fetch_array($cruise)) {
	      			echo "<form id='bestillingvalg" . $row['avgangid'] . "' action='bestilling.php' method='post'>
		      				<table class='cruisetable'>
		      					<tr>
		      						<th colspan='2'>" . $row['turnavn'] . "</th>
		      						<input type='hidden' name='turid' value='" . $row['turid'] . "'>
		      						<input type='hidden' name='turnavn' value='" . $row['turnavn'] . "'>
		      					</tr>
		      					<tr>
		      						<td rowspan='3'>" . $row['turbeskrivelse'] . "</td>
		      						<td><font class='b'>Avganger</font><br>" . FindDates( $row['avgangid'], $con ) . "<br>" . str_replace('00:00', '00', $row['avgangtid']) . "</td>
		      					</tr>
		      					<tr>
		      						<td><font class='b'>Pris:</font><br>Voksne: " . $row['avgangpris'] . "<br>Barn/Honnør: " . $row['avgangprisbarn'] . "</td>
		      					</tr>
		      					<tr>
		      						<td class='orderbutton'><a href='#' onclick='CruiseForm(&#39;bestillingvalg" . $row['avgangid'] . "&#39;);'>Bestill!</a></td>
		      						<input type='hidden' name='avgangid' value='" . $row['avgangid'] . "'>
		      						<input type='hidden' name='avgangtid' value='" . $row['avgangtid'] . "'>
		      						<input class='profilid' type='hidden' name='profilid' value=''>
		      					</tr>
							</table>
						</form>";

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
