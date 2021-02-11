<!DOCTYPE html>
<html>
<head>
	<title>RajExim Lead Management | Graph Export</title>
	<style>
		.highcharts-figure, .highcharts-data-table table {
		  min-width: 360px; 
		  max-width: 800px;
		  margin: 1em auto;
		}

		.highcharts-data-table table {
			font-family: Verdana, sans-serif;
			border-collapse: collapse;
			border: 1px solid #EBEBEB;
			margin: 10px auto;
			text-align: center;
			width: 100%;
			max-width: 500px;
		}
		.highcharts-data-table caption {
		  padding: 1em 0;
		  font-size: 1.2em;
		  color: #555;
		}
		.highcharts-data-table th {
			font-weight: 600;
		  padding: 0.5em;
		}
		.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
		  padding: 0.5em;
		}
		.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
		  background: #f8f8f8;
		}
		.highcharts-data-table tr:hover {
		  background: #f1f7ff;
		}
	</style>
</head>
<body>
<figure class="highcharts-figure">
  <div id="container"></div>
 <!--  <p class="highcharts-description">
    This chart shows how data labels can be added to the data series. This
    can increase readability and comprehension for small datasets.
  </p> -->
</figure>
<input type="hidden" name="graph_data" id="graph_data" value='<?php echo $graph_json_data; ?>'>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
	var json_data = $('#graph_data').val();
	var res_array = json_data.split('|');
	var cat = eval(JSON.parse(res_array[0])); 
	var series_arr = eval(JSON.parse(res_array[1])); 
	console.log(cat);
	// var json_arr = JSON.parse(json_data);
	Highcharts.chart('container', {
	  chart: {
	    type: 'line'
	  },
	  title: {
	    text: 'Graph Based Lead Report'
	  },
	  credits: {
	    enabled: false
	  },
	  subtitle: {
	    text: 'RajExim Companies'
	  },
	  xAxis: {
	    categories: cat
	  },
	  yAxis: {
	    title: {
	      text: 'Counts'
	    }
	  },
	  plotOptions: {
	    line: {
	      dataLabels: {
	        enabled: true
	      },
	      enableMouseTracking: false
	    }
	  },
	  series: series_arr
	});
});

</script>
</body>
</html>