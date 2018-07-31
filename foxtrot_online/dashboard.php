<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";
?>

<html lang="en"">
<head>
	<?php
	echo HEAD;
	?>

</head>

<body>
<!--Top Navigation Bar-->
<?php echo show_top_navigation_bar(); ?>

<!--Content-->
<div class="container-fluid">
	<div class="row">
		<!--Sidebar-->
		<?php echo show_sidebar(basename(__FILE__, '.php')); ?>

		<!--Main Content-->
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="pt-3 pb-2 mb-2 border-bottom">
				<h2>
					<?php echo ucfirst(basename(__FILE__, '.php')) ?>
				</h2>
			</div>

			<div class="row text-center">
				<h4 class="col-md-5 mb-4">
					<?php
					echo dashboard_posted_commissions();
					?>
				</h4>
			</div>

			<div class="row"> <!-- Pie Chart div -->
				<div class="col-lg-6">
					<?php
					pie_chart_data_and_labels('dashboard_pie_chart');
					?>
					<canvas id="dashboard_pie_chart"></canvas>
					<script type="text/javascript" src="pie_chart_no_data.js" chart_id="dashboard_pie_chart"></script>
					<script type="text/javascript">
						pie_chart.data = pie_chart_data;
						pie_chart.update();
					</script>
				</div>
				<div class="col-lg-6">
					<button id="restore_pie_chart_btn" class="btn btn-info">
						Back
					</button>
				</div>
			</div>
		</main>
	</div>
</div>

<?php echo FOOTER ?>

</body>
</html>