<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Framework Básico: <?php if(isset($this->titulo)) { echo $this->titulo; } ?></title>
	<script src="jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="<?php echo APP_URL_CSS."bootstrap.min.css"; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams["ruta_css"]; ?>
	style.css">

	<!--Import Google Icon Font
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
-->

	<!-- Compiled and minified CSS 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
-->
    <!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<?php
	if (isset($this->flashMessage)) {
		echo "<h3>".$this->flashMessage."</h3>";
	}
	?>
	<div class="container z-depth-5">
