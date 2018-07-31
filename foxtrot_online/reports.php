<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";
?>

<html lang="en">
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
			<form id="reports_form" class="dates_form col-md-12">
				<div class="server_response_div">
					<div class="alert" role="alert"></div>
				</div>
				<label>Date:</label>
				<select id="time_periods_select" name="time_periods">
					<option id="dates_form_option_choose" value="none">Choose a period of time</option>
					<option value="Year to Date">Year to Date</option>
					<option value="Month to Date">Month to Date</option>
					<option value="Previous 12 Months">Previous 12 Months</option>
					<option value="Last Year">Last Year</option>
					<option value="Last Month">Last Month</option>
					<option id="dates_form_option_custom" value="Custom">Custom</option>
				</select>
				<div class="hidden_form_div">
					<label>From</label>
					<input type="date" name="from_date" required><br class="d-xs-block d-sm-none">
					<label>To</label>
					<input type="date" name="to_date" required><br class="d-xs-block d-sm-none">
					<input class="btn btn-primary ml-2" type="submit" value="Filter">

				</div>
				<input name="class" value="I_DONT_KNOW_YET" hidden>
				<input name="func" value="I_DONT_KNOW_YET" hidden>
			</form>
			<div class="row"> <!-- Line Chart div -->
				<div class="col-lg-6">
					<?php
					line_chart_data_and_labels('reports_line_chart');
					?>
					<canvas id="reports_line_chart"></canvas>
					<script type="text/javascript" src="line_chart_no_data.js" chart_id="reports_line_chart"></script>
					<script type="text/javascript">
						line_chart.data.datasets[0].data = line_chart_data;
						line_chart.data.labels = line_chart_labels;
						line_chart.update();
					</script>
				</div>
			</div>

			<div class="row mt-5 mb-5">
				<div class="col-lg-6"> <!-- Pie Chart div -->
					<?php
					pie_chart_data_and_labels('reports_pie_chart');
					?>
					<canvas id="reports_pie_chart"></canvas>
					<script type="text/javascript" src="pie_chart_no_data.js" chart_id="reports_pie_chart"></script>
					<script type="text/javascript">
						pie_chart.data = pie_chart_data;
						pie_chart.update();
					</script>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="drill_down_pie_chart_modal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="forgot_password_modal_title">A RELEVANT TITLE</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<canvas id="dashboard_drill_down_pie_chart"></canvas>
						</div>
					</div>
				</div>
			</div>

			<?php
			echo REPORTS_TABLE_HTML;
			?>
		</main>
	</div>
</div>


<?php echo FOOTER ?>

</body>
</html>