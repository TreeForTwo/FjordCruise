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
				<li><a href="aakrafjorden.php">�krafjorden</a></li>
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

				if (@!$con=mysqli_connect($serverhost, $serveruser, $serverpass, $serverschema)){
	            		echo "<h3>MySQL-serveren er ikke tilgjengelig nå. Last inn nettsiden på nytt, eller prøv igjen senere.</h3>";
	            		exit;
	      		}

	      		$avgangsdager = mysqli_query( $con, "SELECT fjordcruise_avganger.avgangmandag, fjordcruise_avganger.avgangtirsdag, fjordcruise_avganger.avgangonsdag, fjordcruise_avganger.avgangtorsdag, fjordcruise_avganger.avgangfredag, fjordcruise_avganger.avganglordag, fjordcruise_avganger.avgangsondag 
	      								 FROM fjordcruise_avganger
	      								 WHERE fjordcruise_avganger.avgangid = $_POST[avgangid]");

				echo "<form name='bestillingsform' action='submit_bestilling.php' method='post'>
						<table id='bestillingstable'>
							<tr>
								<th colspan='2'>Bestill billett til cruise</th>
							</tr>
							<tr>
								<td><font class='b'>Cruise:</font></td>
								<td>" . $_POST['turnavn'] . "</td>
							</tr>
							<tr>
								<td><font class='b'>Dato:</font></td>
								<td><select name='bestiltdato'>";

								$datoer = mysqli_fetch_assoc($avgangdager);

				      			if ( isset( $datoer['avgangmandag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next monday") ) . "'>Mandag, " . date("Y-m-d", strtotime("next monday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option>"; 
				      			}

				      			if ( isset( $datoer['avgangtirsdag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next tuesday") ) . "'>Tirsdag, " . date("Y-m-d", strtotime("next tuesday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option>"; 
				      			}

				      			if ( isset( $datoer['avgangonsdag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next wednesday") ) . "'>Onsdag, " . date("Y-m-d", strtotime("next wednesday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option>"; 
				      			}

				      			if ( isset( $datoer['avgangtorsdag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next thursday") ) . "'>Torsdag, " . date("Y-m-d", strtotime("next thursday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option>"; 
				      			}

				      			if ( isset( $datoer['avgangfredag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next friday") ) . "'>Fredag, " . date("Y-m-d", strtotime("next friday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option";
				      			}

				      			if ( isset( $datoer['avganglordag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next saturday") ) . "'>Lørdag, " . date("Y-m-d", strtotime("next saturday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option>"; 
				      			}

				      			if ( isset( $datoer['avgangsondag'] ) ) {
				      				echo "<option value='" . date("Y-m-d", strtotime("next sunday") ) . "'>Søndag, " . date("Y-m-d", strtotime("next sunday") ) . ", " . rtrim( $_POST['avgangtid'], ":00" ) . "</option>"; 
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
