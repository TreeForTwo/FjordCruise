<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
				<li><a href="index.php">Åkrafjorden</a></li>
				<li><a href="index.php">Cruise</a></li>
				<li><a href="index.php">Aktiviteter</a></li>
				<li><a href="index.php">Informasjon</a></li>
				<li id="paalogging"><a href="index.php">Pålogging</a></li>
			</ul>
		</div>
	</nav>

	<!-- TemplateBeginEditable name="EditRegion2" --><!-- TemplateEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<!-- TemplateBeginEditable name="EditRegion3" --><!-- TemplateEndEditable -->
		</span>
	</div>
</body>
</html>
