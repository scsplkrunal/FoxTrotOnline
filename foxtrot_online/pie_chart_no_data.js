var chart_id = document.currentScript.getAttribute( 'chart_id' ); //Sent as a parameter from the page

var ctx = $( '#' + chart_id );
var pie_chart = new Chart( ctx, {
	type: 'pie',
	data: {}, //Will be filled out through PHP
	options: {
		legend: {
			position: 'right',
		},
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	}
} );


/**
 * If clicking the chart, sent the data to the server.
 */
$(document).ready(
	function() {
		$( '#' + chart_id )[0].onclick = function(evt) {
			var is_shown = $('#restore_pie_chart_btn').attr( 'style' );
			if( is_shown == undefined ){
				var activePoints = pie_chart.getElementsAtEvent(evt);
				if (activePoints[0]) {
					var chartData = activePoints[0]['_chart'].config.data;
					var idx = activePoints[0]['_index'];

					var label = chartData.labels[idx];
					var value = chartData.datasets[0].data[idx];
					var color = chartData.datasets[0].backgroundColor[idx];

					$.post( "junction.php", {func: 'drill_down_pie_chart', class: 'no_class', label: label, value: value, color: color}, function( server_response_data ){
						var json_obj = $.parseJSON( server_response_data );
						pie_chart.data = json_obj.data_arr['drill_down_pie_chart_data'];
						pie_chart.update();
						$('#restore_pie_chart_btn').show();
					});
				}
			}
		};
	}
);


// $( '#' + chart_id ).click(function(  ){
// 	var activePoints = myNewChart.getElementsAtEvent( evt );
// 	if( activePoints[0] ){
// 		var chartData = activePoints[0]['_chart'].config.data;
// 		var idx = activePoints[0]['_index'];
//
// 		var label = chartData.labels[idx];
// 		var value = chartData.datasets[0].data[idx];
//
// 		var url = "http://example.com/?label=" + label + "&value=" + value;
// 		console.log( url );
// 		alert( url );
// 	}
// });