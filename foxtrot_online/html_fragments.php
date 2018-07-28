<?php

/**
 * The head tag of each html document.
 */
define('HEAD', '
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>FoxTrot Online</title>

	<!-- JQuery -->
	<script src="lib/jquery-3.2.1.js"></script>

	<!-- Bootstrap core CSS and JS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<!-- ChartJS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> -->

	
	<!-- Custom CSS and JS -->
	<link href="main_stylesheet.css" rel="stylesheet">
	<script src="main_js.js"></script>
	
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="lib/favicon.ico">

');

/**
 * Footer HTML
 */
define('FOOTER', '
<footer class="text-center bg-dark">
	<div class="container">
		<span class="text-muted">2018 Copyright &copy; FoxTrot, LLC</span>
	</div>
</footer>
');