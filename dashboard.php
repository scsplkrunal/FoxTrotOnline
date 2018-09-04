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
				<h2>Gross Commission & Fees Payroll-To-Date</h2>
			</div>
			<div class="card" style="margin-bottom: 0.75rem">
				<div class="card-header">
					<h4 class="card-title mb-0">Gross Commissions Received Payroll-To-Date</h4>
				</div>
				<div class="card-body">
					<h5 class="card-subtitle mb-2" id="posted_commission_heading">
						<?php
						echo dashboard_posted_commissions();
						?>
					</h5>
					<form id="dashboard_form" class="dates_form mb-0">
						<div class="server_response_div">
							<div class="alert" role="alert"></div>
						</div>
						<label>Transactions through Payroll Cutoff Date:</label>
						<input type="date" name="to_date" required>
						<script type="text/javascript">
							var now = new Date();
							var day = ("0" + now.getDate()).slice( -2 );
							var month = ("0" + (now.getMonth() + 1)).slice( -2 );
							var today = now.getFullYear() + "-" + (month) + "-" + (day);
							$( "#dashboard_form input[type=date]" ).val( today );
						</script>
						<input class="btn btn-primary ml-sm-2" type="submit" value="Refresh" required>
						<input name="class" value="no_class" hidden>
						<input name="func" value="dashboard_update" hidden>
					</form>
				</div>
			</div>
			<div class="card-columns mb-5">
				<div class="card" >
					<div class="card-header">
						<h4 class="card-title mb-0">Gross Commissions By Product Category</h4>
					</div>
					<div class="card-body" style="height: 300px;">
						<?php
						$json_obj       = pie_chart_data_and_labels('dashboard_pie_chart');
						$pie_chart_data = $json_obj->data_arr['pie_chart_data'];
						echo "<script type='text/javascript'>
									var pie_chart_data = $pie_chart_data;
								</script>";
						?>
						<canvas id="dashboard_pie_chart"></canvas>
						<script type="text/javascript" src="pie_chart_no_data.js"
						        chart_id="dashboard_pie_chart"></script>
						<script type="text/javascript">
							var pie_charts_arr = [];
							pie_charts_arr.push( pie_chart );
							pie_charts_arr[0].data = pie_chart_data;
							pie_charts_arr[0].update();
						</script>
					</div>
					<div class="card-footer text-muted">
						Click on chart for details
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Net Commissions Total<br>Drop-down of date ranges</h4>
					</div>
					<div class="card-body">
						<form id="dashboard_time_period_form" class="dates_form col-md-12">
							<div class="server_response_div">
								<div class="alert" role="alert"></div>
							</div>
							<label>Date:</label>
							<select id="time_periods_select" name="time_period" class="mr-2">
								<option value="Year to Date">Year to Date</option>
								<option value="Month to Date">Month to Date</option>
								<option value="Previous 12 Months">Previous 12 Months</option>
								<option value="Last Year">Last Year</option>
								<option value="Last Month">Last Month</option>
							</select>
							<input name="choose_date_radio" value="dateTrade" hidden>
							<input name="choose_pay_radio" value="rep_comm" hidden>
							<input name="class" value="no_class" hidden>
							<input name="func" value="reports_update" hidden>
						</form>
						<?php
						$line_chart_data = line_chart_data_and_labels(['time_period' => 'Year to Date']);
						echo "<script type='text/javascript'>
									var line_chart_data = $line_chart_data;
								</script>";
						?>
						<canvas id="dashboard_line_chart"></canvas>
						<script type="text/javascript" src="line_chart_no_data.js"
						        chart_id="dashboard_line_chart"></script>
						<script type="text/javascript">
							line_chart.data = line_chart_data;
							line_chart.options.title = {
								display: true,
								fontSize: 14,
								text: "Net Commission"
							};
							line_chart.update();
						</script>
					</div>
				</div>
				<div class="card d-none d-lg-inline-block">
					<div class="card-header">
						<h4 class="card-title mb-0">Commission Statement</h4>
					</div>
					<div class="card-body">
						<object id="statement_pdf_object" data="none" type="application/pdf" height="300px"
						        width="100%"></object>
						<?php
						$x = statement::statements_list("{$_SESSION['company_name']}/data"); //x doesn't matter, initial the function for $_SESSION['first_statement_url']
						echo statement::statement_buttons_pdf_url_changer();
						?>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Net Commissions by Product Category</h4>
					</div>
					<div class="card-body">
						<div style="height: 300px">
							<?php
							$json_obj       = pie_chart_data_and_labels('reports_pie_chart', [
								'time_period'       => 'Year to Date',
								'choose_date_radio' => 'dateTrade',
								'choose_pay_radio'  => 'rep_comm'
							]);
							$pie_chart_data = $json_obj->data_arr['pie_chart_data'];
							echo "<script type='text/javascript'>
							var pie_chart_data = $pie_chart_data;
						</script>";
							?>
							<canvas id="dashboard_pie_chart_2"></canvas>
							<script type="text/javascript" src="pie_chart_no_data.js"
							        chart_id="dashboard_pie_chart_2"></script>
							<script type="text/javascript">
								pie_charts_arr.push( pie_chart );
								pie_charts_arr[1].data = pie_chart_data;
								pie_charts_arr[1].options.title = {
									display: true,
									fontSize: 14,
									text: "Breakdown by Product Category"
								};
								pie_charts_arr[1].update();
							</script>
						</div>

					</div>
					<div class="card-footer text-muted">
						Click on chart for details
					</div>
				</div>
			</div>
<!--			<div class="row mb-2">-->
<!--				<div class="col-lg-6 col-xs-12 mb-5" style="width: 300px; height: 300px;">-->
<!---->
<!--<!--					<p class="text-center text-lg-left"><small class="text-muted ml-lg-5 pl-lg-5">Click on chart for details</small></p>-->-->
<!--				</div>-->
<!--				<div class="col-lg-6 ">-->
<!---->
<!--				</div>-->
<!--			</div>-->
<!---->
<!--			<div class="row mb-5">-->
<!--				<div class="col-lg-6 col-xs-12">-->
<!--				</div>-->
<!--				<div class="col-lg-6 mb-5" style="width: 300px; height: 300px;">-->
<!--				</div>-->
<!--			</div>-->

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
						<div id="drill_down_table_div" class="modal-body"></div>
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