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
		},
		tooltips: {
			callbacks: {
				label: function(tooltipItem, data) {
					var dataset = data.datasets[tooltipItem.datasetIndex];
					var meta = dataset._meta[Object.keys(dataset._meta)[0]];
					var total = meta.total;
					var currentValue = dataset.data[tooltipItem.index];
					var percentage = parseFloat((currentValue/total*100).toFixed(1));
					return currentValue + ' (' + percentage + '%)';
				},
				title: function(tooltipItem, data) {
					return data.labels[tooltipItem[0].index];
				}
			}
		}
	}
};

var pie_chart = new Chart( ctx, config );