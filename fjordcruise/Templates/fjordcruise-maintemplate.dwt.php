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
	<script>
		$( document ).ready(
			function () {
				ResizeTitle()
				CenterNav()
				$("#titlecenter").fitText(1, { minFontSize:'60px', maxFontSize:'80px' } )
			}
		);

		$( window ).resize(
			function () {
				ResizeTitle()
				CenterNav()
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
			<ul id="testshit">
				<li><a href="index.php">Åkrafjorden</a></li>
				<li><a href="index.php">Cruise</a></li>
				<li><a href="index.php">Aktiviteter</a></li>
				<li><a href="index.php">Spesial</a></li>
				<li><a href="index.php">Informasjon</a></li>
			</ul>
		</div>
	</nav>

</body>
</html>
