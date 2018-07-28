var chart_id = document.currentScript.getAttribute('chart_id'); //Sent as a parameter from the page

var ctx = $('#'+chart_id);
var pie_chart = new Chart(ctx, {
	type: 'pie',
	data: {
		labels: [], //Will be filled out from the server
		datasets: [{
			data: [], //Will be filled out from the server
			backgroundColor: [], //Will be filled out from the server
			borderColor: 'rgb(255,255,255)',
			borderWidth: 1
		}]
	},
	options: {
		legend: {
			position: 'right',
		},
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		}
	}
});