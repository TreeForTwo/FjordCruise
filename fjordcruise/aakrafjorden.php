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
	<script src='js/jquery.flexslider.js'></script>
	<script>
		$( document ).ready(
			function () {
				ResizeTitle();
				CenterNav();
				ScaleContent();
				/* Resizing is handled within these scripts, don't repeat them */
				$("#titlecenter").fitText(1, { minFontSize:'60px', maxFontSize:'80px' } )
				$("#content").flowtype( { fontRatio: 42, maxFont: 21 });
				$(".fjordslideshow").flexslider( { controlNav: false} );

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

	$serverhost="p:elevweb.akershus-fk.no";
	$serveruser="maro0211";
	$serverpass="FjGhrtyu";
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

	<!-- InstanceBeginEditable name="EditRegion2" --><!-- InstanceEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<br><br>
			<!-- InstanceBeginEditable name="EditRegion3" -->
			<font class='b'>Velkommen til Åkrafjorden!</font><br>
			Åkrafjorden er et utsøkt stykke Norge, med praktful natur og utsikt.
			Her finner man Langfoss, en av verdens ti vakreste fosser, som fosser ned fjellsiden inn i fjorden.
			E-134 går langs den ene siden av fjorden, og i nærheten kan man oppleve de veggløse gårdene og se norske tradisjoner med sine egne øyne. 
			Fjordcruise tilbyr deg å oppleve Åkrafjorden og alle aktivitetene langs den 25km lange veien. Klikk i vei!<br><br>

			<a href='http://www.panoramas.no/Akrafjorden/index.html' target='_blank'>Se Langfossen og Åkrafjorden i 360 graders panorama!</a>
			<br>
			<div class="fjordslideshow">
				<ul class='slides'>
					<li><img src='img/fjord/1.jpg' alt='aakrafjorden'></li>
					<li><img src='img/fjord/2.jpg' alt='aakrafjorden'></li>
					<li><img src='img/fjord/3.jpg' alt='aakrafjorden'></li>
					<li><img src='img/fjord/4.jpg' alt='aakrafjorden'></li>
					<li><img src='img/fjord/5.jpg' alt='aakrafjorden'></li>
				</ul>
			</div>

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
