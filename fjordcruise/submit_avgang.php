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

	      		if ( isset( $_POST['endreavgang'] ) ) {
	      			$previousvalues = mysqli_query($con, "SELECT * FROM fjordcruise_avganger WHERE fjordcruise_avganger.avgangid = '" . $_POST['avgangid'] . "'");
	      			$row = mysqli_fetch_array($previousvalues);

	      			// Manually comparing these is simpler than doing a foreach loop		      			

	      			if ( isset( $_POST['avgangtid'] ) && ( $row['avgangtid'] != $_POST['avgangtid'] ) ) {
	      				$newarray['avgangtid'] = mysqli_real_escape_string( $con, $_POST['avgangtid'] );
	      			}

	      			if ( isset( $_POST['avgangpris'] ) && ( $row['avgangpris'] != $_POST['avgangpris'] ) ) {
	      				$newarray['avgangpris'] = mysqli_real_escape_string( $con, $_POST['avgangpris'] );
	      			}

	      			if ( isset( $_POST['avgangprisbarn'] ) && ( $row['avgangprisbarn'] != $_POST['avgangprisbarn'] ) ) {
	      				$newarray['avgangprisbarn'] = mysqli_real_escape_string( $con, $_POST['avgangprisbarn'] );
	      			}

	      			if ( isset( $_POST['baatid'] ) && ( $row['baatid'] != $_POST['baatid'] ) ) {
	      				$newarray['baatid'] = mysqli_real_escape_string( $con, $_POST['baatid'] );
	      			}

	      			if ( isset( $_POST['turid'] ) && ( $row['turid'] != $_POST['turid'] ) ) {
	      				$newarray['turid'] = mysqli_real_escape_string( $con, $_POST['turid'] );
	      			}

	      			if ( isset( $_POST['gjemtavgang'] ) && ( $row['gjemtavgang'] != $_POST['gjemtavgang'] ) ) {
	      				$newarray['gjemtavgang'] = mysqli_real_escape_string( $con, $_POST['gjemtavgang'] );
	      			}

	      			if ( isset( $_POST['avgangmandag'] ) && ( $row['avgangmandag'] != $_POST['avgangmandag'] ) ) {
	      				$newarray['avgangmandag'] = mysqli_real_escape_string( $con, $_POST['avgangmandag'] );
	      			}

	      			if ( isset( $_POST['avgangtirsdag'] ) && ( $row['avgangtirsdag'] != $_POST['avgangtirsdag'] ) ) {
	      				$newarray['avgangtirsdag'] = mysqli_real_escape_string( $con, $_POST['avgangtirsdag'] );
	      			}

	      			if ( isset( $_POST['avgangonsdag'] ) && ( $row['avgangonsdag'] != $_POST['avgangonsdag'] ) ) {
	      				$newarray['avgangonsdag'] = mysqli_real_escape_string( $con, $_POST['avgangonsdag'] );
	      			}

	      			if ( isset( $_POST['avgangtorsdag'] ) && ( $row['avgangtorsdag'] != $_POST['avgangtorsdag'] ) ) {
	      				$newarray['avgangtorsdag'] = mysqli_real_escape_string( $con, $_POST['avgangtorsdag'] );
	      			}

	      			if ( isset( $_POST['avgangfredag'] ) && ( $row['avgangfredag'] != $_POST['avgangfredag'] ) ) {
	      				$newarray['avgangfredag'] = mysqli_real_escape_string( $con, $_POST['avgangfredag'] );
	      			}

	      			if ( isset( $_POST['avganglordag'] ) && ( $row['avganglordag'] != $_POST['avganglordag'] ) ) {
	      				$newarray['avganglordag'] = mysqli_real_escape_string( $con, $_POST['avganglordag'] );
	      			}

	      			if ( isset( $_POST['avgangsondag'] ) && ( $row['avgangsondag'] != $_POST['avgangsondag'] ) ) {
	      				$newarray['avgangsondag'] = mysqli_real_escape_string( $con, $_POST['avgangsondag'] );
	      			}

	      			if ( isset( $_POST['avgangdato'] ) && ( $row['avgangdato'] != $_POST['avgangdato'] ) ) {
	      				$newarray['avgangdato'] = mysqli_real_escape_string( $con, $_POST['avgangdato'] );
	      			}

	      			foreach($newarray as $k => $v) {
	      				if ( !mysqli_query($con, "UPDATE fjordcruise_avganger
	      					              SET $k = '" . $v . "'
	      					              WHERE fjordcruise_avganger.avgangid = " . $_POST['avgangid']) ) {
	      					echo "Det har skjedd en feil! <a href='#' onclick='history.go(-1);'>Prøv igjen?</a>";
	      				}
	      			}

	      			echo "Avgangen har nå blitt oppdatert! Du vil bli tatt tilbake til avgangsiden snart. <a href='administrasjon.php?modus=avganger'>Klikk her hvis det tar lenger enn noen sekunder.</a>
	      				<script>
	      					setTimeout( function() { window.location.replace( 'administrasjon.php?modus=avganger' ) }, 5000 );
	      				</script>";

	      		}
	      		else {

	      			$insertinto = "INSERT INTO fjordcruise_avganger ( ";
	      			$values = "VALUES ( ";

	      			foreach( $_POST as $k => $v ) {
	      				${$k} = mysqli_real_escape_string( $con, $v );

	      				$insertinto = $insertinto . $k . ", ";
	      				$values = $values . "'" . ${$k} . "', ";
	      			}

	      			$insertinto = rtrim($insertinto, ", , ") . " ) ";
					$values = rtrim($values, ", , ") . " )";

					$sqlsentence = $insertinto . $values;

	      			if ( !mysqli_query($con, $sqlsentence) ) {
	      				echo "something just happened";
	      				mysqli_errno( $con );
	      			}
	      			else {
	      				echo "Avgangen har nå blitt lagt til. Du blir snart tatt tilbake til avgangsiden. <a href='administrasjon.php?modus=avganger'>Klikk her hvis det tar lenger enn noen sekunder.</a>
		      				<script>
		      					setTimeout( function() { window.location.replace( 'administrasjon.php?modus=avganger' ) }, 5000 );
		      				</script>";
	      			}
	      		}
			?>

			<!-- InstanceEndEditable -->
		</span>
	</div>
</body>
<!-- InstanceEnd --></html>
