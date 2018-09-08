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
<div class='loader'></div>
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
						<input type="checkbox" name="all_dates" class="custom-control-input"
						       id="all_dates_checkbox" checked>
						<label class="custom-control-label" for="all_dates_checkbox">All Trade Dates</label>
					</div>
					<label>From</label>
					<input type="date" name="from_date" disabled required><br class="d-xs-block d-sm-none">
					<label>To</label>
					<input type="date" name="to_date" disabled required><br class="d-xs-block d-sm-none">
					<input class="btn btn-primary ml-sm-2" type="submit" value="Filter">
					<input name="class" value="no_class" hidden>
					<input name="func" value="activity_update" hidden>
				</form>
			</div>
			<div class="table-responsive mb-5" style="overflow: hidden">
				<table id="activity_table"
				       class="main-table table table-hover table-striped table-sm text-center"
				       style="font-size: 0.8rem">
					<thead>
					<tr>
						<th>DATE</th>
						<th>DATE RECEIVED</th>
						<th>CLIENT ACCOUNT</th>
						<th>CLIENT NAME</th>
						<th>PRODUCT DESCRIPTION</th>
						<th>CUSIP</th>
						<th>PRINCIPAL</th>
						<th>COMMISSION EXPECTED</th>
						<th>COMMISSION RECEIVED</th>
						<th>PAYOUT RATE</th>
						<th>COMMISSION PAID</th>
						<th>DATE PAID</th>
					</tr>
					</thead>
					<tbody>
					<?php
					try{
						$json_obj = activity_update(['all_dates' => 'on'], false);
						echo $json_obj->data_arr['activity_table'];
						$pdf_title_first_line  = $json_obj->data_arr['pdf_title_first_line'];
						$pdf_title_second_line = $json_obj->data_arr['pdf_title_second_line'];
						echo "<script>
							var pdf_title_first_line = '$pdf_title_first_line';
							var pdf_title_second_line = '$pdf_title_second_line';
						</script>";
					}catch(Exception $e){
						catch_doc_first_load_exception($e, 'activity_form');
					}
					?>
					</tbody>
				</table>
				<script type="text/javascript">
					$( document ).ready( function(){
						var currentDate = new Date();
						var current_minutes = ('0'+ currentDate.getMinutes()).slice(-2);
						var top_massage = 'Created: ' + currentDate.getMonth() + '/' + currentDate.getDate() + '/' + currentDate.getFullYear() + ' ' + currentDate.getHours() + ':' + current_minutes;
						const months_names = ["January", "February", "March", "April", "May", "June",
							"July", "August", "September", "October", "November", "December"
						];
						var file_name = 'Transaction Activity ' + currentDate.getDate() + ' ' + months_names[currentDate.getMonth()] + ' ' + currentDate.getFullYear();
						var pdf_title = pdf_title_first_line + '\n\r' + pdf_title_second_line;
						var excel_title = pdf_title_first_line + ' - ' + pdf_title_second_line;
						$( '#activity_table' ).DataTable( {
							language: {search: ""},
							paging: false,
							info: false,
							dom: 'Bfrtip',
							buttons: [
								{
									extend: 'excelHtml5',
									orientation: 'landscape',
									filename: file_name,
									messageTop: top_massage,
									title: excel_title
								},
								{
									extend: 'pdfHtml5',
									orientation: 'landscape',
									filename: file_name,
									messageTop: top_massage,
									title: pdf_title
								}
							],
							// "scrollY": 200,
							"scrollX": true
						} );

						$( '.buttons-html5' ).addClass( 'btn btn-secondary' );
						$( '#activity_table_filter input' ).addClass( 'form-control' ).attr( "placeholder", "Search" ).css( 'margin', 0 );
						$( '#activity_table_filter' ).width( 210 ).css( 'float', 'right' );
						$( '.dt-buttons' ).width( 200 ).css( 'float', 'left' );
						if( $( document ).width() < 992 ){
							$( '#activity_table_filter' ).width( '100%' ).addClass( 'text-left mt-2' );
							$( '#activity_table_filter input' ).width( '100%' );
						}

						$('#activity_table_filter label').after('<small id="search_note" class="form-text text-muted" style="margin-top: -0.5em">Enter EXACTLY what you\'re looking for</small>');

						// $( "#activity_table_filter input" ).keydown( function(){
						// 	var current_value = $( "#activity_table_filter input" ).val();
						// 	current_value = current_value.replace(/,/g, '');
						// 	var key = event.keyCode;
						// 	var entered_value = String.fromCharCode( (96 <= key && key <= 105) ? key - 48 : key );
						//
						// 	if( !isNaN( current_value ) && current_value != '' && !isNaN( entered_value ) ){ //if current and entered value are numeric, and current value is not an empty string
						// 		// parseFloat(current_value) !== 1.00 COULD BE A BUG
						// 		if( current_value % 1 === 0 && current_value.length >= 3 ){ //if the number is an integer and has 3 digits
						// 			// var formatted_value = current_value.slice( 0, current_value.length - 2 ) + ',' + current_value.slice( current_value.length - 2, current_value.length );
						// 			// var first_char = current_value.charAt(0);
						// 			// current_value.substr(1)
						// 			current_value = current_value + '0'; //add a last char
						// 			var formatted_value = parseInt(current_value).toLocaleString(); //format to beautiful
						// 			formatted_value = formatted_value.toString(); //Convert to string
						// 			formatted_value = formatted_value.slice(0,-1); //remove added '0' from the end
						// 			// formatted_value = first_char + formatted_value.toString(); //add removed first char
						// 			$( "#activity_table_filter input" ).val( formatted_value );
						// 		}else{ //if the number is a float
						//
						// 		}


								// if( current_value.length > 3 ){
								// 	if( current_value.includes( '.' ) ){ //if there's a decimal point
								// 		current_value = current_value.slice( 0, current_value.length - 5 ) + ',' + current_value.slice( current_value.length - 5, current_value.length );
								// 	}else{
								// 	}
								//
								// }
								// var new_value = parseFloat( current_value );
								// new_value = new_value.toLocaleString();

						// 	}
						// } );
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