<?php echo $this->session->flashdata('error');?>
<div class="row">

<div class="col-md-3 col-sm-6 col-xs-12">

              <div class="info-box">
                <span  class="info-box-icon bg-aqua"><i  class="fa fa-gear"></i></span>
                <div  class="info-box-content">
                  <span class="info-box-text">Machine Count</span>
                  <span class="info-box-number" id="machine_count"></span>       
                  </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
<div class="col-md-3 col-sm-6 col-xs-12">

              <div class="info-box">
                <span  class="info-box-icon bg-red"><i  class="fa fa-truck"></i></span>
                <div  class="info-box-content">
                  <span class="info-box-text">Vehicle Count</span>
                  <span class="info-box-number" id="vehicle_count"></span>       
                  </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
 <div class="col-md-3 col-sm-6 col-xs-12">

              <div class="info-box">
                <span  class="info-box-icon bg-green"><i  class="fa fa-gears"></i></span>
                <div  class="info-box-content">
                  <span class="info-box-text">Working Machines</span>
                  <span class="info-box-number" id="working_machine"></span>       
                  </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">

              <div class="info-box">
                <span  class="info-box-icon bg-yellow"><i  class="fa fa-truck"></i></span>
                <div  class="info-box-content">
                  <span class="info-box-text">Working Vehicles</span>
                  <span class="info-box-number" id="working_vehicle"></span>       
                  </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
       </div><!-- /.col -->
</div>
<div class="row">
<div class="col-md-6">
<div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Current Stock</h3>

              <div class="box-tools pull-right">
        	 </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive" style="height: 250px; overflow-y: scroll;">
				<table class="table table-bordered" id="stock_table">
				<thead>
					<tr class="bg-primary">
					<td>Material</td><td>Stock Limit</td><td>Current</td><td>Flag</td>
					</tr>
				</thead>
				<tbody>
		
					
				</tbody>
				</table>
				</div>
            </div>
	  </div>
	</div>
<div class="col-md-6">
<div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Daily Log Submission Status</h3>

              <div class="box-tools pull-right">
        	 </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive" style="height: 250px; overflow-y: scroll;">
				<table class="table table-bordered" id="daily_machine_status">
				<thead>
					<tr class="bg-primary">
					<td>Type</td><td>Machine</td><td>Number</td><td>Status</td>
					</tr>
				</thead>
				<tbody>
			
				</tbody>
				</table>
				</div>
            </div>
	  </div>
	</div>
	</div>
	 
<div class="row">
<div class="col-md-8">
<div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Stock Movement</h3>
			   <div class="box-tools pull-right">
				<select class="form-control" name="material_id" id="material_id" onchange="loadMaterialGraph()"  tabindex="3">
				 <option value="">---Select Material---</option>
				
				</select>
        	 </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <div class="chart" >
                <canvas id="lineChartMaterial" style="height:250px"></canvas>
              </div>
            </div>
       
	  </div>
	</div>

  
<div class="col-md-4" >
<div class="box box-primary" style="height:320px;">

            
            <!-- /.box-header -->
            <div class="box-body">
			 
              <canvas id="pieChart" style="height:250px"></canvas>
         
				<div id="maintainance_div"> </div>
				 
				
            </div>
	  </div>
	</div>
</div>


	<div class="row">
	<div class="col-md-6">
		<div class="box box-primary" style="height:320px;">

            <div class="box-header with-border">
              <h3 class="box-title">Approval Status</h3>

              <div class="box-tools pull-right">
        	 </div>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
			</div>
		
	
	
	</div>
	
	
	<div class="col-md-6">
		<div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Vehicle Average Graph</h3>

              <div class="box-tools pull-right">
				<select class="form-control" name="vehicle_id" id="vehicle_id" onchange="loadTable()"  tabindex="3">
				 <option value="">---Select Vehicle---</option>
				
				</select>
        	 </div>
            </div>
            <!-- /.box-header -->
        <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
			</div>
		
	
	
	</div>
	
	
	</div>
	



<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>

<script type="text/javascript">


$(document).ready(function(){

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Home/home_details'); ?>",
//		data: {"id":id},
		success: function(result)
		{
			var res=result.split("#");
			$("#machine_count").append(res[0]);
			$("#vehicle_count").append(res[1]);
			$("#working_machine").append(res[2]);
			$("#working_vehicle").append(res[3]);
		 },
		
	});	

	//1.Stock Report

$.ajax({
			type: "POST",
			url: "<?php echo base_url('Home/stock_rpt'); ?>",
		//	data: {"id":id},
			success: function(result)
			{
				
				$("#stock_table tbody").append(result);
			
			 },
			
		});	

//2.Daily Log Submission Status

$.ajax({
	type: "POST",
	url: "<?php echo base_url('Home/daily_log_status'); ?>",
//	data: {"id":id},
	success: function(result)
	{

		$("#daily_machine_status tbody").append(result);
	
	 },
	
});	
//3.Working Count

$.ajax({
	type: "POST",
	url: "<?php echo base_url('Home/working'); ?>",
//	data: {"id":id},
	success: function(result)
	{
		var res=result.split("#");
		var information=[];
		var color;
		var highlight;
		var label;
		
		label = "Working";
		 color = "#00a65a";
		 highlight = "#00a65a";
		 information.push({ value: res[0], color: color, highlight: highlight, label: label});

		 label = "Non Working";
		 color = "#f56954";
		 highlight = "#f56954";
		 information.push({ value: res[1], color: color, highlight: highlight, label: label});
		
		
		 var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
		 var pieChart       = new Chart(pieChartCanvas)
		 var PieData        = information;
		 var pieOptions     = {
		   //Boolean - Whether we should show a stroke on each segment
		   segmentShowStroke    : true,
		   //String - The colour of each segment stroke
		   segmentStrokeColor   : '#fff',
		   //Number - The width of each segment stroke
		   segmentStrokeWidth   : 2,
		   //Number - The percentage of the chart that we cut out of the middle
		   percentageInnerCutout: 50, // This is 0 for Pie charts
		   //Number - Amount of animation steps
		   animationSteps       : 100,
		   //String - Animation easing effect
		   animationEasing      : 'easeOutBounce',
		   //Boolean - Whether we animate the rotation of the Doughnut
		   animateRotate        : true,
		   //Boolean - Whether we animate scaling the Doughnut from the centre
		   animateScale         : false,
		   //Boolean - whether to make the chart responsive to window resizing
		   responsive           : true,
		   // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		   maintainAspectRatio  : true,
		   //String - A legend template
		   legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
		 }
		 //Create pie or douhnut chart
		 // You can switch between pie and douhnut using the method below.
		 pieChart.Doughnut(PieData, pieOptions);
	 },
	
});	





//5.Maintainace Count
$.ajax({
	type: "POST",
	url: "<?php echo base_url('Home/maintainace_graph'); ?>",
//	data: {"id":id},
	success: function(result)
	{
		
		$("#maintainance_div").append(result);
	
	 },
	
});	





//8.Approval Status
$.ajax({
	type: "POST",
	url: "<?php echo base_url('Home/approval_status_graph'); ?>",
//	data: {"id":id},
	success: function(result)
	{
	

		var res=result.split("#");
		
		var strApprover = res[0].split(',');
		var intstrApprover = [];
		for(var i=0; i < strApprover.length; i++)
		   intstrApprover.push(strApprover[i]);

		var strArr1 = res[1].split(',');
		var intArr1 = [];
		for(var i=0; i < strArr1.length; i++)
		   intArr1.push(parseInt(strArr1[i]));

		var strArr2 = res[2].split(',');
		var intArr2 = [];
		for(var i=0; i < strArr2.length; i++)
		   intArr2.push(parseInt(strArr2[i]));

		var strArr3 = res[3].split(',');
		var intArr3 = [];
		for(var i=0; i < strArr3.length; i++)
		   intArr3.push(parseInt(strArr3[i]));

		var strArr4 = res[4].split(',');
		var intArr4 = [];
		for(var i=0; i < strArr4.length; i++)
		   intArr4.push(parseInt(strArr4[i]));

		   
		 var areaChartData = {
			      labels  : intstrApprover,
			      datasets: [
			        {
			          label               : 'O.I.',
			          fillColor           : 'rgba(0, 255, 255, 1)',
			          strokeColor         : 'rgba(0, 255, 255, 1)',
			          pointColor          : 'rgba(0, 255, 255, 1)',
			          pointStrokeColor    : '#c1c7d1',
			          pointHighlightFill  : '#fff',
			          pointHighlightStroke: 'rgba(220,220,220,1)',
			          data                : intArr1
			        },
			        {
			          label               : 'M.I.',
			          fillColor           : 'rgba(60,141,188,0.9)',
			          strokeColor         : 'rgba(60,141,188,0.8)',
			          pointColor          : '#3b8bba',
			          pointStrokeColor    : 'rgba(60,141,188,1)',
			          pointHighlightFill  : '#fff',
			          pointHighlightStroke: 'rgba(60,141,188,1)',
			          data                : intArr2
			        },
			        {
			          label               : 'M.R.',
			          fillColor           : 'rgba(255, 51, 255, 1)',
			          strokeColor         : 'rgba(255, 51, 255, 1)',
			          pointColor          : 'rgba(255, 51, 255, 1)',
			          pointStrokeColor    : '#c1c7d1',
			          pointHighlightFill  : '#fff',
			          pointHighlightStroke: 'rgba(220,220,220,1)',
			          data                : intArr3
			        },
			        {
			          label               : 'D.L.',
			          fillColor           : 'rgba(128, 128, 128, 1)',
			          strokeColor         : 'rgba(128, 128, 128, 1)',
			          pointColor          : 'rgba(128, 128, 128, 1)',
			          pointStrokeColor    : '#c1c7d1',
			          pointHighlightFill  : '#fff',
			          pointHighlightStroke: 'rgba(220,220,220,1)',
			          data                : intArr4
			        }
			      ]
			    }
		//$("#approval_status tbody").append(result);

		 var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
		    var barChart                         = new Chart(barChartCanvas)
		    var barChartData                     = areaChartData
		    barChartData.datasets[1].fillColor   = '#00a65a'
		    barChartData.datasets[1].strokeColor = '#00a65a'
		    barChartData.datasets[1].pointColor  = '#00a65a'
		    var barChartOptions                  = {
		      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		      scaleBeginAtZero        : true,
		      //Boolean - Whether grid lines are shown across the chart
		      scaleShowGridLines      : true,
		      //String - Colour of the grid lines
		      scaleGridLineColor      : 'rgba(0,0,0,.05)',
		      //Number - Width of the grid lines
		      scaleGridLineWidth      : 1,
		      //Boolean - Whether to show horizontal lines (except X axis)
		      scaleShowHorizontalLines: true,
		      //Boolean - Whether to show vertical lines (except Y axis)
		      scaleShowVerticalLines  : true,
		      //Boolean - If there is a stroke on each bar
		      barShowStroke           : true,
		      //Number - Pixel width of the bar stroke
		      barStrokeWidth          : 2,
		      //Number - Spacing between each of the X value sets
		      barValueSpacing         : 5,
		      //Number - Spacing between data sets within X values
		      barDatasetSpacing       : 1,
		      //String - A legend template
		      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		      //Boolean - whether to make the chart responsive
		      responsive              : true,
		      maintainAspectRatio     : true
		    }

		    barChartOptions.datasetFill = false
		    barChart.Bar(barChartData, barChartOptions)
		 
	
	 },
	
});	

//9.Load Vehicle


		$.ajax({
				type: "POST",
				url: "<?php echo base_url('Home/getvehicle'); ?>",
				//data: {"id":id},
				success: function(result)
				{
					
					$('#vehicle_id').empty();
					$('#vehicle_id').append(result);
				 }
			});	
		
		//10.Highest Moving
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Home/getMaterial'); ?>",
//			data: {"id":id},
			success: function(result)
			{
				
				$('#material_id').empty();
				$('#material_id').append(result);
			
			 },
			
		});	
	

		
});


function loadTable()
{
	id = document.getElementById("vehicle_id").value;
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Home/vehicle_graph1'); ?>",
		data: {"id":id},
		success: function(result)
		{
			var res=result.split("#");
			var intArr1 = [];
			var intArr2 = [];
			var intArr3 = [];
		
			if(res[0]!='')
			{
			var strArr1 = res[0].split(',');
			for(var i=0; i < strArr1.length; i++)
			   intArr1.push(parseInt(strArr1[i]));
			}
			if(res[1]!='')
			{
			var strArr2 = res[1].split(',');
			for(var i=0; i < strArr2.length; i++)
			   intArr2.push(parseInt(strArr2[i]));
			}
			if(res[2]!='')
			{
			var strArr3 = res[2].split(',');
			for(var i=0; i < strArr3.length; i++)
			   intArr3.push(parseInt(strArr3[i]));
			}
	
		    var areaChartData = {
		    	      labels  : ['1','2','3','4','5','6'],
		    	      datasets: [
		    	        {
		    	          label               : 'Expected Avg. Min',
		    	          fillColor           : 'rgba(0, 100, 0, 1)',
		    	          strokeColor         : 'rgba(0, 100, 0, 1)',
		    	          pointColor          : 'rgba(0, 100, 0, 1)',
		    	          pointStrokeColor    : '#c1c7d1',
		    	          pointHighlightFill  : '#fff',
		    	          pointHighlightStroke: 'rgba(220,220,220,1)',
		    	          data                : intArr1
		    	        },
		    	        {
		    	          label               : 'Current Average',
		    	          fillColor           : 'rgba(60,141,188,0.9)',
		    	          strokeColor         : 'rgba(60,141,188,0.8)',
		    	          pointColor          : '#3b8bba',
		    	          pointStrokeColor    : 'rgba(60,141,188,1)',
		    	          pointHighlightFill  : '#fff',
		    	          pointHighlightStroke: 'rgba(60,141,188,1)',
		    	          data                : intArr2
		    	        },
		    	        {
		    				label               : 'Expected Avg. Max',
		    				fillColor           : 'rgba(255, 0, 0, 1)',
		    				strokeColor         : 'rgba(255, 0, 0, 1)',
		    				pointColor          : 'rgba(255, 0, 0, 1)',
		    				pointStrokeColor    : '#c1c7d1',
		    				pointHighlightFill  : '#fff',
		    				pointHighlightStroke: 'rgba(220,220,220,1)',
		    			
		    				data                : intArr3
		    				
		    			}
		    	      ]
		    	    };
    	    
			  var areaChartOptions = {
				     
				      showScale               : true,
				    
				      scaleShowGridLines      : false,
				     
				      scaleGridLineColor      : 'rgba(0,0,0,.05)',
				     
				      scaleGridLineWidth      : 1,
				     
				      scaleShowHorizontalLines: true,
				     
				      scaleShowVerticalLines  : true,
				     
				      bezierCurve             : true,
				      
				      bezierCurveTension      : 0.3,
				     
				      pointDot                : false,
				     
				      pointDotRadius          : 4,
				     
				      pointDotStrokeWidth     : 1,
				    
				      pointHitDetectionRadius : 20,
				    
				      datasetStroke           : true,
				     
				      datasetStrokeWidth      : 2,
				      
				      datasetFill             : true,
				     
				      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
				      
				      maintainAspectRatio     : true,
				     
				      responsive              : true
				    }

				   
			var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
		    var lineChart                = new Chart(lineChartCanvas)
		    var lineChartOptions         = areaChartOptions
		    lineChartOptions.datasetFill = false
		    lineChart.Line(areaChartData, lineChartOptions)
			
		
		 },
		
	});	
	
	  	 
}

function loadMaterialGraph()
{
	// document.getElementById(materialDiv).innerHTML = "";
	
	id = document.getElementById("material_id").value;
	var canvas = document.getElementById("lineChartMaterial");
    var context = canvas.getContext("2d");
   
    context.clearRect(0, 0, 600,250);
    context.beginPath(); 
    
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Home/material_graph1'); ?>",
		data: {"id":id},
		success: function(result)
		{
			
			var intArr1 = [];
			var intArr2 = [];
			var res=result.split("#");
		
			if(res[0]!='')
			{
			var strArr1 = res[0].split(',');
		
			for(var i=0; i < strArr1.length; i++)
			   intArr1.push(parseInt(strArr1[i]));
			}
			if(res[1]!='')
			{
				
			var strArr2 = res[1].split(',');
			
			for(var i=0; i < strArr2.length; i++)
			   intArr2.push(parseInt(strArr2[i]));
			}

		
		
		    var areaChartData1 = {
		    	      labels  : ['1','2','3','4','5','6','8','9','10'],
		    	      datasets: [
		    	        {
		    	          label               : 'Material Receipt',
		    	          fillColor           : 'rgba(0, 100, 0, 1)',
		    	          strokeColor         : 'rgba(0, 100, 0, 1)',
		    	          pointColor          : 'rgba(0, 100, 0, 1)',
		    	          pointStrokeColor    : '#c1c7d1',
		    	          pointHighlightFill  : '#fff',
		    	          pointHighlightStroke: 'rgba(220,220,220,1)',
		    	          data                : intArr1
		    	        },
		    	        {
		    	          label               : 'Material Issue',
		    	          fillColor           : 'rgba(60,141,188,0.9)',
		    	          strokeColor         : 'rgba(60,141,188,0.8)',
		    	          pointColor          : '#3b8bba',
		    	          pointStrokeColor    : 'rgba(60,141,188,1)',
		    	          pointHighlightFill  : '#fff',
		    	          pointHighlightStroke: 'rgba(60,141,188,1)',
		    	          data                : intArr2
		    	        }
		    	    
		    	      ]
		    	    };
    	  
			  var areaChartOptions1 = {
				     
				      showScale               : true,
				      
				      scaleShowGridLines      : false,
				     
				      scaleGridLineColor      : 'rgba(0,0,0,.05)',
				    
				      scaleGridLineWidth      : 1,
				     
				      scaleShowHorizontalLines: true,
				    
				      scaleShowVerticalLines  : true,
				    
				      bezierCurve             : true,
				     
				      bezierCurveTension      : 0.3,
				     
				      pointDot                : false,
				    
				      pointDotRadius          : 4,
				      
				      pointDotStrokeWidth     : 1,
				     
				      pointHitDetectionRadius : 20,
				     
				      datasetStroke           : true,
				      
				      datasetStrokeWidth      : 2,
				     
				      datasetFill             : true,
				      
				      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
				     
				      maintainAspectRatio     : true,
				  
				      responsive              : true
				    }
			 
			 var lineChartCanvas1          = $('#lineChartMaterial').get(0).getContext('2d');
			
		    var lineChart1               = new Chart(lineChartCanvas1);
		    
		    var lineChartOptions1         = areaChartOptions1;
		    lineChartOptions1.datasetFill = false;
		    lineChart1.Line(areaChartData1, lineChartOptions1);
		
		   
		 },
		 
	});	
	
	  
}

</script>
	
	  
	  
	 
			
			
		