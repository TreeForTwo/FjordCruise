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
				<li id="paalogging"><a href="bruker.php">Pålogging</a></li>
			</ul>
		</div>
	</nav>

	<!-- InstanceBeginEditable name="EditRegion2" --><!-- InstanceEndEditable -->

	<div id="contentwrap">
		<span id="content">
			<br><br>
			<!-- InstanceBeginEditable name="EditRegion3" -->

			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue nisi non nulla dapibus ullamcorper. Praesent sed tellus sit amet est tristique malesuada. Suspendisse a lacus dictum libero dignissim aliquam sed ut mauris. Sed ut cursus quam, vel facilisis nulla. Nulla nec velit commodo ante volutpat egestas. Suspendisse arcu turpis, ultricies vitae elit id, consectetur pretium erat. Vestibulum in dignissim lectus. Ut viverra in urna eget semper. Aliquam tempus est felis, quis posuere tortor eleifend at. Mauris vehicula ac nunc ac rutrum. Aenean pharetra lectus tincidunt, sagittis eros vel, feugiat libero.

			Maecenas congue ligula quis interdum consequat. Etiam tempus mi ut purus dignissim, ac hendrerit orci placerat. Donec sed justo rhoncus, tincidunt mi luctus, dapibus mauris. Aliquam posuere in lorem eget ultrices. Nullam molestie luctus massa a interdum. Maecenas imperdiet eleifend libero, iaculis volutpat odio cursus vel. Nullam dapibus eros iaculis, aliquam neque ac, scelerisque urna. Nam pulvinar id lectus ac consequat. Pellentesque iaculis pellentesque sapien. Pellentesque sollicitudin tincidunt semper. Morbi accumsan consectetur dolor non ultricies. Morbi ut faucibus ipsum. Nullam at scelerisque nulla.

			Quisque sodales turpis id convallis fringilla. Integer at convallis mauris. Integer sit amet gravida risus. Nam pulvinar imperdiet nulla dapibus molestie. Cras id fermentum odio, non lobortis urna. Nunc egestas, dui id vestibulum porta, metus tortor pellentesque metus, sit amet luctus nisi elit eget lacus. Nunc nec pellentesque leo. Morbi condimentum dictum consectetur. Sed tincidunt, lorem vitae sollicitudin convallis, leo urna molestie mauris, eu cursus ipsum mi et enim. Cras id dui luctus, pharetra arcu vitae, sagittis ante. Nullam rutrum sem bibendum massa dapibus commodo. Sed sodales orci ac urna sagittis ornare. Fusce convallis sagittis blandit.

			Etiam imperdiet mauris sit amet massa ullamcorper mattis. Quisque in nisl in urna elementum tempor congue vitae dui. Nulla ac mattis risus. Vivamus ultrices odio vel fermentum dignissim. Aliquam erat volutpat. Duis sollicitudin, eros ut suscipit elementum, augue eros tempor nibh, in consequat nisl nisi eu justo. Etiam metus leo, porta eu urna quis, rutrum iaculis odio. Nullam dapibus lorem et consectetur viverra. Integer ac dignissim lorem.

			Morbi sodales nunc arcu, nec suscipit erat lacinia sed. Donec quis dui commodo, lacinia lorem vitae, congue metus. Donec euismod erat at quam eleifend vestibulum. Donec vel sagittis leo. Vivamus venenatis pellentesque dolor eu lobortis. Nam nec ipsum et nulla tincidunt egestas. Mauris blandit consequat bibendum. Suspendisse potenti. Pellentesque non est at lectus accumsan sodales et a velit. Quisque nec felis et lectus rhoncus ultricies. Proin vitae ipsum id augue rhoncus pretium ut quis purus. Vivamus sagittis rutrum eros vitae malesuada. Integer feugiat odio sodales sem luctus, at rhoncus sem laoreet. Sed congue sem diam, eu commodo eros vehicula gravida.f<!-- InstanceEndEditable -->
		</span>
	</div>
</body>
<!-- InstanceEnd --></html>
