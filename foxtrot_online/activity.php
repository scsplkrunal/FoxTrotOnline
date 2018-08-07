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
				<h2>
					<?php echo ucfirst(basename(__FILE__, '.php')) ?>
				</h2>
			</div>
			<div class="row text-center">
				<div class="col-sm-4">
					<div class="alert alert-info">
						<strong>Regular Commissions $3415.10</strong>
						<!--This is the total commission amounts of all trades that are not Trails and not Clearing-->
					</div>
				</div>
				<div class="col-sm-4">
					<div class="alert alert-info">
						<strong>Trail Commissions $0</strong>
						<!--the total commission amounts of trades that have "1" or "2" as the right-most character of the SOURCE field. The SOURCE field is 2-characters wide and may include things like "12" or "N1"-->
					</div>
				</div>
				<div class="col-sm-4">
					<div class="alert alert-info">
						<strong>Clearing Commissions $3.12</strong>
						<!-- the total commission amounts of trades that include any of the following in the SOURCE field: "PE", "NF", "IN", "DN", "FC", "HT", "LG", "PN", "RE", "SW"-->
					</div>
				</div>
			</div>
			<div class="row">
				<form id="activity_form" class="col-md-12 dates_form">
					<div class="server_response_div mt-2">
						<div class="alert" role="alert"></div>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="all_dates" class="custom-control-input" id="all_dates_checkbox" checked>
						<label class="custom-control-label" for="all_dates_checkbox">All Dates</label>
					</div>
					<label>From</label>
					<input type="date" name="from_date" disabled><br class="d-xs-block d-sm-none">
					<label>To</label>
					<input type="date" name="to_date" disabled><br class="d-xs-block d-sm-none">
					<input class="btn btn-primary ml-2" type="submit" value="Filter">
					<input name="class" value="no_class" hidden>
					<input name="func" value="activity_update" hidden>
				</form>
			</div>
			<div class="table-responsive mb-5">
				<table id="activity_table" class="main-table table table-hover table-striped table-sm text-center">
					<thead>
					<tr>
						<th>DATE</th>
<!--						<th>CLIENT ACCOUNT</th>-->
						<th>CLIENT NAME</th>
						<th>PRODUCT DESCRIPTION</th>
<!--						<th>CUSIP</th>-->
						<th>PRINCIPAL</th>
						<th>COMMISSION RECEIVED</th>
<!--						<th>PAYOUT RATE</th>-->
						<th>COMMISSION PAID</th>
						<th>DATE RECEIVED</th>
						<th>DATE PAID</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$json_obj = activity_update(['all_dates' => 'on']);
					echo $json_obj->data_arr['activity_table'];
					?>
					</tbody>
				</table>
				<script type="text/javascript">
					$(document).ready( function () {
						$('#activity_table').DataTable( {
							searching: false,
							paging: false,
							info: false,
							dom: 'Bfrtip',
							buttons: [
								'excelHtml5',
								'pdfHtml5'
								]
						} );

						$('.buttons-html5').addClass('btn btn-secondary');
					} );
				</script>
			</div>
		</main>
	</div>
</div>
<?php
require_once 'footer.php';
?>
</body>
</html>