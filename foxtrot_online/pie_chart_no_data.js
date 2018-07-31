var chart_id = document.currentScript.getAttribute( 'chart_id' ); //Sent as a parameter from the page

var ctx = $( '#' + chart_id );
var config = {
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
};

var pie_chart = new Chart( ctx, config );