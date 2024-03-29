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

		if (readCookie('profil') && readCookie('previouspage')) {
			window.location.replace(readCookie('previouspage'));
		}
		else if (readCookie('profil')) {
			window.location.replace('bruker.php');
		}

		function SubmitRegistration() {
			passord1 = $("[name='passord1']").val();
			passord2 = $("[name='passord2']").val();

			if ( passord1 == passord2 ) {
				document.forms['registrationform'].submit()
			}
			else if ( !window.passwordchecked ) {
				window.passwordchecked = 1;

				$("#registrationform tr:last td").append("   <font style='color:red;'>Passordene stemmer ikke overens med hverandre!</font>");
			}
		}
	</script>

	<!-- InstanceEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<br><br>
			<!-- InstanceBeginEditable name="EditRegion3" -->

			<form id="registrationform" action="submit_registrasjon.php" method="post">
				<table class="registrationtable">
					<tr>
						<th colspan="2">Registrasjon</th>
					</tr>
					<tr>
						<td><font class="b">Brukernavn</font></td>
						<td><input type="text" name='profilnavn' required></td>
					</tr>
					<tr>
						<td><font class="b">E-Post</font></td>
						<td><input type="text" name='epost' required></td>
					</tr>
					<tr>
						<td><font class="b">Fornavn</font></td>
						<td><input type="text" name='fornavn' required></td>
					</tr>
					<tr>
						<td><font class="b">Etternavn</font></td>
						<td><input type="text" name='etternavn' required></td>
					</tr>
					<tr>
						<td><font class="b">Telefon</font></td>
						<td><input type="text" name='telefon' required></td>
					</tr>
					<tr>
						<td><font class="b">Passord</font></td>
						<td><input type="password" name='passord1' required></td>
					</tr>
					<tr>
						<td><font class="b">Gjenta passord</font></td>
						<td><input type="password" name='passord2' required></td>
					</tr>
					<tr>
						<td colspan='2' class='orderbutton'><a href='#' onclick="SubmitRegistration();">Send inn registrasjon</a></td>
					</tr>
			</form>

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
