var chart_id = document.currentScript.getAttribute('chart_id'); //Sent as a parameter from the page

var ctx = $('#'+chart_id);
var line_chart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: [], //Will be filled out from the server
		datasets: [{
			data: [], //Will be filled out from the server
			lineTension: 0,
			backgroundColor: 'transparent',
			borderColor: '#007bff',
			borderWidth: 4,
			pointBackgroundColor: '#007bff'
		}]
	},
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
