<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<!-- TemplateBeginEditable name="doctitle" -->
<title>FjordCruise</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.scalewindow.js"></script>
	<script src="../js/jquery.fittext.js"></script>
	<script src="../js/jquery.flowtype.js"></script>	
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

	<!-- TemplateBeginEditable name="EditRegion2" --><!-- TemplateEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<br><br>
			<!-- TemplateBeginEditable name="EditRegion3" -->

			<!-- TemplateEndEditable -->
		</span>
	</div>
</body>
</html>
