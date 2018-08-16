<?php
require_once 'header.php';
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
				<h2>Commissions & Fees</h2>
			</div>
			<form id="reports_form" class="dates_form col-md-12">
				<div class="server_response_div">
					<div class="alert" role="alert"></div>
				</div>
				<label>Date:</label>
				<select id="time_periods_select" name="time_period" class="mr-2">
					<option value="all_dates">All Dates</option>
					<option value="Year to Date">Year to Date</option>
					<option value="Month to Date">Month to Date</option>
					<option value="Previous 12 Months">Previous 12 Months</option>
					<option value="Last Year">Last Year</option>
					<option value="Last Month">Last Month</option>
					<option id="dates_form_option_custom" value="Custom">Custom</option>
				</select>
				<div class="row">
					<div class="col-xs-2 mr-3 ml-3">
						<div class="custom-control custom-radio custom-control">
							<input type="radio" id="trade_date_radio" name="choose_date_radio"
							       class="custom-control-input" value="dateTrade" checked>
							<label class="custom-control-label" for="trade_date_radio">Trade Date</label>
						</div>
						<div class="custom-control custom-radio custom-control">
							<input type="radio" id="date_posted_radio" name="choose_date_radio"
							       class="custom-control-input" value="date_rec">
							<label class="custom-control-label" for="date_posted_radio">Date
								Posted</label>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="custom-control custom-radio custom-control">
							<input type="radio" id="net_pay_radio" name="choose_pay_radio"
							       class="custom-control-input" value="rep_comm" checked>
							<label class="custom-control-label" for="net_pay_radio">Net Pay</label>
						</div>
						<div class="custom-control custom-radio custom-control">
							<input type="radio" id="gross_comm_radio" name="choose_pay_radio"
							       class="custom-control-input" value="comm_rec">
							<label class="custom-control-label" for="gross_comm_radio">Gross
								Commission</label>
						</div>
					</div>
				</div>
				<div class="hidden_form_div mt-2">
					<label>From</label>
					<input type="date" name="from_date" required><br class="d-xs-block d-sm-none">
					<label>To</label>
					<input type="date" name="to_date" required><br class="d-xs-block d-sm-none">
				</div>
				<input class="btn btn-primary mt-2" type="submit" value="Filter">
				<input name="class" value="no_class" hidden>
				<input name="func" value="reports_update" hidden>
			</form>
			<div class="row"> <!-- Line Chart div -->
				<div class="col-lg-6">
					<?php
					$line_chart_data = line_chart_data_and_labels([]);
					echo "<script type='text/javascript'>
							var line_chart_data = $line_chart_data;
						</script>";
					?>
					<canvas id="reports_line_chart"></canvas>
					<script type="text/javascript" src="line_chart_no_data.js"
					        chart_id="reports_line_chart"></script>
					<script type="text/javascript">
						line_chart.data = line_chart_data;
						line_chart.update();
					</script>
				</div>
			</div>

			<div class="row mt-5 mb-5">
				<div class="col-lg-6"> <!-- Pie Chart div -->
					<?php
					$json_obj       = pie_chart_data_and_labels('reports_pie_chart');
					$pie_chart_data = $json_obj->data_arr['pie_chart_data'];
					echo "<script type='text/javascript'>
							var pie_chart_data = $pie_chart_data;
						</script>";
					?>
					<canvas id="reports_pie_chart"></canvas>
					<script type="text/javascript" src="pie_chart_no_data.js"
					        chart_id="reports_pie_chart"></script>
					<script type="text/javascript">
						pie_chart.data = pie_chart_data;
						pie_chart.update();
					</script>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="drill_down_pie_chart_modal" tabindex="-1" role="dialog"
			     aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="forgot_password_modal_title">Trades list</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div id="drill_down_table_div" class="modal-body">
						</div>
					</div>
				</div>
			</div>

			<div id="reports_table">
				<?php
				$json_obj = pie_chart_data_and_labels('reports_pie_chart');
				echo $json_obj->data_arr['reports_table_html'];
				?>
			</div>
		</main>
	</div>
</div>


<?php
require_once 'footer.php';
?>
</body>
</html>