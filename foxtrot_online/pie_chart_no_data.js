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
			var activePoints = pie_chart.getElementsAtEvent(evt);
			if (activePoints[0]) {
				var chartData = activePoints[0]['_chart'].config.data;
				var idx = activePoints[0]['_index'];

				var label = chartData.labels[idx];
				var value = chartData.datasets[0].data[idx];
				var color = chartData.datasets[0].backgroundColor[idx];

				$.post( "junction.php", {func: 'drill_down_pie_chart', class: 'no_class', label: label, value: value, color: color}, function( data ){
					
				});


				var output_string = label + ' ' + value + ' ' + color ;
				alert(output_string);
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