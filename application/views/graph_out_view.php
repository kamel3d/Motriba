<script>           
            var lineChartData_out = [
			<?php foreach ($graph_data as $row):  
			
			if (date("Y-m-d") == $row['date'])// if date in table stats in equale to today 
			{
			$row['outhate']=$stats->outhate;
			$row['outlike']=$stats->outlike;	   
			}
			
			$pst = percentage($row['outlike'],$row['outhate']);
			$timestamp = strtotime($row['date']);//-2629743;
			
			// 2629743 is the number of seconds in one month and thats because javascript starts from 0 to 11 
			// months not 1 to 12
			?>{
	            
				<?php  $Jm=date("m", $timestamp)-1;?>
                date: new Date(<?php echo date("Y", $timestamp).','.$Jm.','.date("d", $timestamp);?>),
                like_pst:<?php echo $pst['likepst'];?>,			
				hate_pst:<?php echo $pst['hatepst'];?>,
				like: <?php echo $row['outlike']; ?>,
				hate: <?php echo $row['outhate']; ?>
            },<?php endforeach; ?>];

            AmCharts.ready(function () {
                var chart = new AmCharts.AmSerialChart();
                chart.dataProvider = lineChartData_out; 
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
                chart.write("chartdiv-out");
            });
</script>
        <div id="chartdiv-out" class="graph"></div>
    