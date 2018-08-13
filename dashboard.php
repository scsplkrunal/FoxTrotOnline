<?php
require_once 'header.php';
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
					<?php echo ucfirst(basename(__FILE__, '.php')) ?>: Gross commission & fees payroll-to-date
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
					$json_obj = pie_chart_data_and_labels('dashboard_pie_chart');
					$pie_chart_data = $json_obj->data_arr['pie_chart_data'];
					echo "<script type='text/javascript'>
							var pie_chart_data = $pie_chart_data;
						</script>";
					?>
					<canvas id="dashboard_pie_chart"></canvas>
					<script type="text/javascript" src="pie_chart_no_data.js" chart_id="dashboard_pie_chart"></script>
					<script type="text/javascript">
						pie_chart.data = pie_chart_data;
						pie_chart.update();
					</script>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade bd-modal-lg" id="drill_down_pie_chart_modal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="forgot_password_modal_title">Trades list</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div id="drill_down_table_div" class="modal-body">
							<!--							<canvas id="drill_down_pie_chart"></canvas>-->
						</div>
					</div>
				</div>
			</div>

		</main>
	</div>
</div>

<?php
require_once 'footer.php';
?>

</body>
</html>