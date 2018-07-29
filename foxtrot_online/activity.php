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
					<input name="class" value="I_DONT_KNOW_YET" hidden>
					<input name="func" value="I_DONT_KNOW_YET" hidden>
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
					<tr>
						<td>1,001</td>
						<td>Lorem</td>
						<td>ipsum</td>
						<td>dolor</td>
						<td>sit</td>
						<td>1,001</td>
						<td>Lorem</td>
						<td>ipsum</td>
						<td>dolor</td>
						<td>sit</td>
						<td>sit</td>
					</tr>
					<tr>
						<td>1,002</td>
						<td>amet</td>
						<td>consectetur</td>
						<td>adipiscing</td>
						<td>elit</td>
						<td>1,002</td>
						<td>amet</td>
						<td>consectetur</td>
						<td>adipiscing</td>
						<td>elit</td>
						<td>elit</td>
					</tr>
					<tr>
						<td>1,003</td>
						<td>Integer</td>
						<td>nec</td>
						<td>odio</td>
						<td>Praesent</td>
						<td>1,003</td>
						<td>Integer</td>
						<td>nec</td>
						<td>odio</td>
						<td>Praesent</td>
						<td>Praesent</td>
					</tr>
					<tr>
						<td>1,003</td>
						<td>libero</td>
						<td>Sed</td>
						<td>cursus</td>
						<td>ante</td>
						<td>1,003</td>
						<td>libero</td>
						<td>Sed</td>
						<td>cursus</td>
						<td>ante</td>
						<td>ante</td>
					</tr>
					<tr>
						<td>1,004</td>
						<td>dapibus</td>
						<td>diam</td>
						<td>Sed</td>
						<td>nisi</td>
						<td>1,004</td>
						<td>dapibus</td>
						<td>diam</td>
						<td>Sed</td>
						<td>nisi</td>
						<td>nisi</td>
					</tr>
					<tr>
						<td>1,005</td>
						<td>Nulla</td>
						<td>quis</td>
						<td>sem</td>
						<td>at</td>
						<td>1,005</td>
						<td>Nulla</td>
						<td>quis</td>
						<td>sem</td>
						<td>at</td>
						<td>at</td>
					</tr>
					<tr>
						<td>1,006</td>
						<td>nibh</td>
						<td>elementum</td>
						<td>imperdiet</td>
						<td>Duis</td>
						<td>1,006</td>
						<td>nibh</td>
						<td>elementum</td>
						<td>imperdiet</td>
						<td>Duis</td>
						<td>Duis</td>
					</tr>
					<tr>
						<td>1,007</td>
						<td>sagittis</td>
						<td>ipsum</td>
						<td>Praesent</td>
						<td>mauris</td>
						<td>1,007</td>
						<td>sagittis</td>
						<td>ipsum</td>
						<td>Praesent</td>
						<td>mauris</td>
						<td>mauris</td>
					</tr>
					<tr>
						<td>1,008</td>
						<td>Fusce</td>
						<td>nec</td>
						<td>tellus</td>
						<td>sed</td>
						<td>1,008</td>
						<td>Fusce</td>
						<td>nec</td>
						<td>tellus</td>
						<td>sed</td>
						<td>sed</td>
					</tr>
					<tr>
						<td>1,009</td>
						<td>augue</td>
						<td>semper</td>
						<td>porta</td>
						<td>Mauris</td>
						<td>1,009</td>
						<td>augue</td>
						<td>semper</td>
						<td>porta</td>
						<td>Mauris</td>
						<td>Mauris</td>
					</tr>
					<tr>
						<td>1,010</td>
						<td>massa</td>
						<td>Vestibulum</td>
						<td>lacinia</td>
						<td>arcu</td>
						<td>1,010</td>
						<td>massa</td>
						<td>Vestibulum</td>
						<td>lacinia</td>
						<td>arcu</td>
						<td>arcu</td>
					</tr>
					<tr>
						<td>1,011</td>
						<td>eget</td>
						<td>nulla</td>
						<td>Class</td>
						<td>aptent</td>
						<td>1,011</td>
						<td>eget</td>
						<td>nulla</td>
						<td>Class</td>
						<td>aptent</td>
						<td>aptent</td>
					</tr>
					<tr>
						<td>1,012</td>
						<td>taciti</td>
						<td>sociosqu</td>
						<td>ad</td>
						<td>litora</td>
						<td>1,012</td>
						<td>taciti</td>
						<td>sociosqu</td>
						<td>ad</td>
						<td>litora</td>
						<td>litora</td>
					</tr>
					</tbody>
				</table>
				<script type="text/javascript">
					$(document).ready( function () {
						$('#activity_table').DataTable( {
							searching: false,
							paging: false,
							info: false
						} );
					} );
				</script>
			</div>
		</main>
	</div>
</div>
<?php echo FOOTER ?>

</body>
</html>