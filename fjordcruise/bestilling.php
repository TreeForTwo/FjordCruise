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
		if ( readCookie('profil') ) {
			window.paaloggetprofil = readCookie('profil');
		}
		else {
			createCookie('previouspage', window.location.href);
			window.location.replace('paalogging.php');
		}

		function ClampValues( bool ) {
			selectedoption = $("[name='bestiltdato']").find(":selected");
			date = selectedoption.val();
			seats = Number( selectedoption.html().substr( selectedoption.html().lastIndexOf(", ") + 2, 2) );

			barn = $("[name='antallbarnebilletter']");
			voksne = $("[name='antallbilletter']");

			maxbarn = seats - voksne.val();
			maxvoksne = seats - barn.val();

			barn.attr('max', maxbarn);
			voksne.attr('max', maxvoksne);

			// Remove the password warning
			innerhtml = $("#bestillingstable tr:last td").html();
			$("#bestillingstable tr:last td").html( innerhtml.substr(0, 90) );
			window.passwordchecked = 0;

			if ( bool ) {
				barn.val(0);
				voksne.val(0);
			}
		}

		function SubmitBestilling() {
			if ( $("[name='antallbarnebilletter']").val() + $("[name='antallbilletter']").val() > 0 ) {
				document.forms['bestillingsform'].submit();
			}
			else if ( typeof window.passwordchecked !== 'undefined' ) {
				window.passwordchecked = 1;

				$("#bestillingstable tr:last td").append("   <font style='color:red;'>Du må bestille et antall billetter</font>");
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
	            		echo "<h3>MySQL-serveren er ikke tilgjengelig n?. Last inn nettsiden p? nytt, eller pr?v igjen senere.</h3>";
	            		exit;
	      		}

	      		$avgangdager = mysqli_query( $con, "SELECT fjordcruise_avganger.avgangmandag, fjordcruise_avganger.avgangtirsdag, fjordcruise_avganger.avgangonsdag, fjordcruise_avganger.avgangtorsdag, fjordcruise_avganger.avgangfredag, fjordcruise_avganger.avganglordag, fjordcruise_avganger.avgangsondag 
	      								 FROM fjordcruise_avganger
	      								 WHERE fjordcruise_avganger.avgangid = $_POST[avgangid]");

	      		function DateTranslate( $string ) {
	      			$string = str_replace( "avgang", "", $string );

	      			if ( $string == "mandag" ) {
	      				$date = "monday";
	      			}
	      			elseif ( $string == "tirsdag" ) {
	      				$date = "tuesday";
	      			}
	      			elseif ( $string == "onsdag" ) {
	      				$date = "wednesday";
	      			}
	      			elseif ( $string == "torsdag" ) {
	      				$date = "thursday";
	      			}
	      			elseif ( $string == "fredag" ) {
	      				$date = "friday";
	      			}
	      			elseif ( $string == "lordag" ) {
	      				$date = "saturday";
	      			}
	      			elseif ( $string == "sondag" ) {
	      				$date = "sunday";
	      			}

	      			return $date;
	      		}

	      		function DateOptions( $con, $k, $datestring ) {
						$date = date("Y-m-d", strtotime( $datestring ) );
						$date = mysqli_real_escape_string( $con, str_replace( "/", "-", $date ) );
						$dato = ucfirst( str_replace("avgang", "", $k ) );

						$dato = str_replace( 'Lordag', 'Lørdag', $dato );
	      				$dato = str_replace( 'Sondag', 'Søndag', $dato );


						$dag = mysqli_query( $con, "SELECT SUM(antallbilletter) +  SUM(antallbarnebilletter)
												    FROM fjordcruise_bestillinger
												    WHERE fjordcruise_bestillinger.bestiltdato = '" . $date . "'
												    GROUP BY fjordcruise_bestillinger.bestiltdato" );

						$lbarray = mysqli_fetch_array($dag);

						$ledigebilleter = 50 - $lbarray[0];

						if ( $ledigebilleter > 0 ) {
							echo "<option value='" . $date . "'>" . $dato . ", " . $date . ", " . substr( $_POST['avgangtid'], 0, -3 ) . ", " . $ledigebilleter . " ledige plasser.</option>";
						}
						else {
							echo "<option value='" . $date . "' disabled>" . $dato . ", " . $date . ", ingen ledige plasser.</option>";
						}
	      		}

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
								<td><select name='bestiltdato' onchange='ClampValues(true);'>";

								foreach( mysqli_fetch_assoc($avgangdager) as $k => $v ) {
									if ( isset($v) && $v != '' ) {
										$datetranslation = DateTranslate($k);
										$datestring = "next " . $datetranslation;
										
										DateOptions($con, $k, $datestring);

										$datestring = "second " . $datetranslation;

										DateOptions($con, $k, $datestring);

										$datestring = "third " . $datetranslation;

										DateOptions($con, $k, $datestring);
									}
								}

				echo 			     "</select></td>
							</tr>
							<tr>
								<td><font class='b'>Billetter</font></td>
								<td>Voksne: <input type='number' name='antallbilletter' style='width:50px;' value='0' min='0' onchange='ClampValues();'> Barn/Honnør: <input type='number' style='width:50px;' size='4' name='antallbarnebilletter' value='0' min='0' onchange='ClampValues();'></td>
							</tr>
							<tr>
								<td colspan='2' class='orderbutton'><a href='#' onclick='SubmitBestilling();'>Send inn bestilling!</a></td>
								<input type='hidden' name='avgangid' value='" . $_POST['avgangid'] . "'>
								<input type='hidden' name='bestilttid' value='" . $_POST['avgangtid'] . "'>
								<input type='hidden' name='profilid' value='" . $_POST['profilid'] . "'>
							</tr>
						</table>
					</form>";

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
