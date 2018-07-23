<?php

/**
 * The head tag of each html document.
 */
define('HEAD', '
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>FoxTrot Online</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
	      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

	<!-- JQuery -->
	<script src="lib/jquery-3.2.1.js"></script>

	<!-- Custom CSS and JS -->
	<link href="stylesheet.css" rel="stylesheet">
	<script src="main_js.js"></script>
	
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="lib/favicon.ico">

');

/**
 * The JavaScript styling for the charts. Optional.
 */
define('CHART_JS', '
<style type="text/css">/* Chart.js */
		@-webkit-keyframes chartjs-render-animation{
			from{
				opacity: 0.99
				}
			to{
				opacity: 1
				}
			}

		@keyframes chartjs-render-animation{
			from{
				opacity: 0.99
				}
			to{
				opacity: 1
				}
			}

		.chartjs-render-monitor{
			-webkit-animation: chartjs-render-animation 0.001s;
			animation:         chartjs-render-animation 0.001s;
			}
	</style>
');