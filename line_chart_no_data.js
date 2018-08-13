var chart_id = document.currentScript.getAttribute('chart_id'); //Sent as a parameter from the page

var ctx = $('#'+chart_id);
var line_chart = new Chart(ctx, {
	type: 'line',
	data: {}, //filled up from server
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: false
				}
			}]
		},
		legend: {
			display: false,
		}
	}
});
