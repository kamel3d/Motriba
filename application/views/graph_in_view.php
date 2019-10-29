<script>           
            var lineChartData_in = [
			<?php foreach ($graph_data as $row):  
			
			if (date("Y-m-d") == $row['date'])// if date in table stats in equale to today 
			{
			$row['inhate']=$stats->inhate;
			$row['inlike']=$stats->inlike;	   
			}
			
			$pst = percentage($row['inlike'],$row['inhate']);
			$timestamp = strtotime($row['date']);
						
			// 2 javascript starts from 0 to 11 			
			?>{ 
	            <?php /*?>date: new Date(<?php echo date("Y,m,d", $timestamp);?>),<?php */?>
				<?php  $Jm=date("m", $timestamp)-1;    ?>
                date: new Date(<?php echo date("Y", $timestamp).','.$Jm.','.date("d", $timestamp);?>),				
				like_pst:<?php echo $pst['likepst'];?>,			
				hate_pst:<?php echo $pst['hatepst'];?>,
				like: <?php echo $row['inlike']; ?>,
				hate: <?php echo $row['inhate']; ?>
            },<?php endforeach; ?>];

            AmCharts.ready(function () {$('.slider-graph').slideToggle(1);
                var chart = new AmCharts.AmSerialChart();
                chart.dataProvider = lineChartData_in; 
                chart.categoryField = "date";

                // sometimes we need to set margins manually
                // autoMargins should be set to false in order chart to use custom margin values
                chart.autoMargins = false;
                chart.marginRight = 0;
                chart.marginLeft = 0;
                chart.marginBottom = 20;
                chart.marginTop = 0;

                // AXES
                // category                
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.inside = false;
                categoryAxis.gridAlpha = 0;
                categoryAxis.tickLength = 0;
                categoryAxis.axisAlpha = 0;
               
                
				// value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 4;
                valueAxis.axisAlpha = 0;
                chart.addValueAxis(valueAxis);

                // GRAPH likes
                var graph = new AmCharts.AmGraph();
                graph.title = "Likes";
				graph.type = "line";
                graph.valueField = "like";
                graph.balloonText = "[[like_pst]]% Likes = [[like]] Votes";
				graph.lineColor = "#009933";
                graph.bullet = "round";
				graph.bulletSize = 4; // bullet image should be a rectangle (width = height)
                graph.lineThickness = 2;// line size
				chart.addGraph(graph);
                
				// GRAPH hates
                var graph = new AmCharts.AmGraph();
                graph.title = "Hates";
				graph.type = "line";
                graph.valueField = "hate";
                graph.balloonText = "[[hate_pst]]% Hates = [[hate]] Votes";
				graph.lineColor = "#FF0000";
                graph.bullet = "round";
				graph.bulletSize = 4; // bullet image should be a rectangle (width = height)
                graph.lineThickness = 2;// line size
			    chart.addGraph(graph);
			   
			    // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                
				chart.addChartCursor(chartCursor);

                // WRITE
                chart.write("chartdiv-in");
            });
</script>
        <div class="graph" id="chartdiv-in"></div>
    