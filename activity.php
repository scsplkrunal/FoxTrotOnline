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
			<div id="activity_boxes_container_div" class="row text-center">
				<?php
				$json_obj = activity_update(['all_dates' => 'on'], true, false);
				echo $json_obj->data_arr['activity_boxes'];
				?>
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
						<th>CLIENT ACCOUNT</th>
						<th>CLIENT NAME</th>
						<th>PRODUCT DESCRIPTION</th>
						<th>CUSIP</th>
						<th>PRINCIPAL</th>
						<th>COMMISSION RECEIVED</th>
						<th>PAYOUT RATE</th>
						<th>COMMISSION PAID</th>
						<th>DATE RECEIVED</th>
						<th>DATE PAID</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$json_obj = activity_update(['all_dates' => 'on'], false);
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