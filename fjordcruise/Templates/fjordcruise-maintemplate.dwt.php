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
				$("#titlecenter").fitText(1, { minFontSize:'60px', maxFontSize:'80px' } )
			}
		);

		$( window ).resize(
			function () {
				ResizeTitle()
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

	</nav>

</body>
</html>
