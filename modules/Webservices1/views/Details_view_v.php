<?php
if(!empty($modules))
{
?>

<header class="main-header">
        <!-- Logo -->
       
        
        <nav class="navbar navbar-static-top" role="navigation">
          <h4 style="margin-top:3%; margin-left:3%;"><img src="<?php echo base_url(); ?>uploads/logo.jpg" height="42" width="42"><strong><font color="#FFFFFF"> सिद्धी शुगर अँड अलाईड इंडस्ट्रीज लि. 
		 <br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;महेशनगर,  उजना </font></strong></h4>
        </nav>
</header>

<section class="content-header">
      <h1>
			हंगाम  : 
       <?php echo $result->mvseason_code;?>
      </h1>
		<div align="right"> <?php echo date('j-m-y g:i a', strtotime($lastupdate));?></div>
        <table class="table table-condensed" style="background-color:#d2d6de;">
		<tr><td>हंगाम चालू दी</td><td>गळीत दिवस</td><td>आज दिं </td><td>शिफ्ट नं </td></tr>
		<tr><td><?php echo date('j-m-y', strtotime($result->mdseason_star_date));?></td><td><?php echo $result->mncrushday;?></td>
		<td><?php echo date('j-m-y', strtotime($result->mdto_date));?></td><td><?php echo $result->mvshift_no;?></td></tr>
		</table>
        
      
    </section>
<section class="content container-fluid" style="padding: 0px;padding-left: 15px;
    padding-right: 15px;">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<?php 
		if( in_array("1", $modules))
		{
			
		?>
		
		<div class="box box-info box-solid">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-gears"></i>  ऊस गाळप  </h3>
		</div>
		<div class="box-body">
		<table class="table table-bordered" width="100%">
		<tbody>
<tr class="bg-primary">
<th><strong>ऊस वजन</strong> </th>
<th>आज</th>
<th>काल अखेर</th>
<th>एकूण </th>
</tr>
<tr class="bg-info"><td><strong>4-12</strong></td>
<?php
$lblnshift_today_no = json_decode($result->lblnshift_today_no);
$lblnshift_Yesterday_no = json_decode($result->lblnshift_Yesterday_no);
$lblnshift_total_no = json_decode($result->lblnshift_total_no);
$lblnshift = json_decode($result->lblnshift);
$yard_balance = json_decode($result->yard_balance);
$lblnvaritey =  json_decode($result->lblnvaritey);
$nlblshift= json_decode($result->nlblshift);
$productiondt = json_decode($result->productiondt);
$productiontoday = json_decode($result->productiontoday);
$lblnvariteyPer =json_decode($result->lblnvariteyPer);
?>
<td><strong><?php echo $lblnshift_today_no[0];?></strong></td>
<td><?php echo $lblnshift_Yesterday_no[0];?></td>
<td><strong><?php echo $lblnshift_total_no[0];?></strong></td>


</tr>
<tr><td><strong>12-8</strong> </td>
<td><strong><?php echo $lblnshift_today_no[1];?></strong></td>
<td><?php echo $lblnshift_Yesterday_no[1];?></td>
<td><strong><?php echo $lblnshift_total_no[1];?></strong></td>

</tr>

<tr class="bg-info"><td><strong>8-4 </strong></td>

<td><strong><?php echo $lblnshift_today_no[2];?></strong></td>
<td><?php echo $lblnshift_Yesterday_no[2];?></td>
<td><strong><?php echo $lblnshift_total_no[2];?></strong></td>

<tr class="bg-info"><td><strong>एकूण</strong></td>

<td><strong><?php echo $lblnshift_today_no[3];?></strong></td>
<td><?php echo $lblnshift_Yesterday_no[3];?></td>
<td><strong><?php echo $lblnshift_total_no[3];?></strong></td></tr>
</tbody>
</table>
		</div>
		</div>
		<?php
		}
		if( in_array("2", $modules))
		{
			?>
		<div class="box box-info box-solid">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-truck"></i> वाहनवार गाळप   </h3>
		</div>
		<div class="box-body">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ट्र्क </a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ट्रॅक्टर </a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">मिनी ट्रॅक्टर</a></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">एकूण</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-primary" align="center">
                                    	<th><strong>4-12</strong></th>
                                        <th><strong>12-8</strong></th>
                                        <th><strong>8-4</strong></th>
                                        <th><strong>एकूण</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center" class="bg-gray-active">
										<td><?php echo $lblnshift[0][1] ;?></td>
										<td><?php echo $lblnshift[1][1] ;?></td>
										<td><?php echo $lblnshift[2][1] ;?></td>
										<td><?php echo $lblnshift[3][1] ;?></td></tr>
                                </tbody>
                            </table>
					<div class="row">		
					<div class="col-xs-6">
                	<div class="small-box bg-primary">
               			 <div class="inner">
                          	 <p></p><center><h4>आज अखेर</h4></center><p></p>
                             <center><h4><strong><?php echo $lblnshift[4][1] ;?></strong></h4></center>
                        </div>
                        <!--<div class="icon">
                  			<i class="ion ion-bag"></i>
                		</div>-->
                		<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              		</div>
					</div>
					<div class="col-xs-6">
					<div class="small-box bg-primary">
               			 <div class="inner">
                          	 <p></p><center><h4>यार्ड बॅलन्स</h4></center><p></p>
                             <center><h4><strong><?php echo $yard_balance[1] ;?></strong></h4></center>
                        </div>
                        <!--<div class="icon">
                  			<i class="ion ion-bag"></i>
                		</div>-->
                		<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              		</div>
					</div>
					</div>
						
						
							
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-light-blue color-palette" align="center">
                                    	<th><strong>4-12</strong></th>
                                        <th><strong>12-8</strong></th>
                                        <th><strong>8-4</strong></th>
                                        <th><strong>एकूण</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center" class="bg-gray-active">
										<td><?php echo $lblnshift[0][2] ;?></td>
										<td><?php echo $lblnshift[1][2] ;?></td>
										<td><?php echo $lblnshift[2][2] ;?></td>
										<td><?php echo $lblnshift[3][2] ;?></td></tr>
                             
                                </tbody>
                            </table>
					<div class="row">		
					<div class="col-xs-6">
                	<div class="small-box bg-light-blue disabled color-palette">
               			 <div class="inner">
                          	 <p></p><center><h4>आज अखेर</h4></center><p></p>
                             <center><h4><strong><?php echo $lblnshift[4][2] ;?></strong></h4></center>
                        </div>
                        
              		</div>
					</div>
					<div class="col-xs-6">
					<div class="small-box bg-light-blue disabled color-palette">
               			 <div class="inner">
                          	 <p></p><center><h4>यार्ड बॅलन्स</h4></center><p></p>
                             <center><h4><strong><?php echo $yard_balance[2] ;?></strong></h4></center>
                        </div>
                        
              		</div>
					</div>
					</div>
						
					
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-aqua-active color-palette" align="center">
                                    	<th><strong>4-12</strong></th>
                                        <th><strong>12-8</strong></th>
                                        <th><strong>8-4</strong></th>
                                        <th><strong>एकूण</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center" class="bg-gray-active">
                                    	<td><?php echo $lblnshift[0][3] ;?></td>
										<td><?php echo $lblnshift[1][3] ;?></td>
										<td><?php echo $lblnshift[2][3] ;?></td>
										<td><?php echo $lblnshift[3][3] ;?></td></tr>
                                </tbody>
                            </table>
					<div class="row">		
					<div class="col-xs-6">
                	<div class="small-box bg-aqua-active color-palette">
               			 <div class="inner">
                          	 <p></p><center><h4>आज अखेर</h4></center><p></p>
                             <center><h4><strong><?php echo $lblnshift[4][3] ;?></strong></h4></center>
                        </div>
                        <!--<div class="icon">
                  			<i class="ion ion-bag"></i>
                		</div>-->
                		<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              		</div>
					</div>
					<div class="col-xs-6">
					<div class="small-box bg-aqua-active color-palette">
               			 <div class="inner">
                          	 <p></p><center><h4>यार्ड बॅलन्स</h4></center><p></p>
                             <center><h4><strong><?php echo $yard_balance[3] ;?></strong></h4></center>
                        </div>
                        <!--<div class="icon">
                  			<i class="ion ion-bag"></i>
                		</div>-->
                		<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              		</div>
					</div>
					</div>
						
					
              </div>
              <!-- /.tab-pane -->
			   <div class="tab-pane" id="tab_4">
                <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-primary" align="center">
                                    	<th><strong>4-12</strong></th>
                                        <th><strong>12-8</strong></th>
                                        <th><strong>8-4</strong></th>
                                        <th><strong>एकूण</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center" class="bg-gray-active">
                                    	<td><?php echo $lblnshift[0][4] ;?></td>
										<td><?php echo $lblnshift[1][4] ;?></td>
										<td><?php echo $lblnshift[2][4] ;?></td>
										<td><?php echo $lblnshift[3][4] ;?></td></tr>
                                </tbody>
                            </table>
					<div class="row">		
					<div class="col-xs-6">
                	<div class="small-box bg-primary">
               			 <div class="inner">
                          	 <p></p><center><h4>आज अखेर</h4></center><p></p>
                             <center><h4><strong><?php echo $lblnshift[4][4] ;?></strong></h4></center>
                        </div>
                        <!--<div class="icon">
                  			<i class="ion ion-bag"></i>
                		</div>-->
                		<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              		</div>
					</div>
					<div class="col-xs-6">
					<div class="small-box bg-primary">
               			 <div class="inner">
                          	 <p></p><center><h4>यार्ड बॅलन्स</h4></center><p></p>
                             <center><h4><strong><?php echo $yard_balance[4] ;?></strong></h4></center>
                        </div>
                        <!--<div class="icon">
                  			<i class="ion ion-bag"></i>
                		</div>-->
                		<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              		</div>
					</div>
					</div>
						
					
              </div>
            
            </div>
            <!-- /.tab-content -->
          </div>
		</div>
		</div>
    
	<?php
		}
		if( in_array("3", $modules))
		{
			?>
			
			<div class="box box-info box-solid">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-gears"></i> साखर उत्पादन </h3>
		</div>
		<div class="box-body">
		<table class="table table-bordered" width="100%">
		<tbody>
<tr class="bg-primary"><th>4-12</th><th>12-8</th><th>8-4</th><th>एकूण </th><th><strong>आज अखेर</strong> </th></tr>

  <?php
								for($i=0;$i<8;$i++)
								{
									if($productiondt[$i][5]!="00")
									{
								?>
									<tr><td colspan="5" class="bg-gray" ><strong><?php echo $productiondt[$i][0]; ?></strong></td></tr>
									<tr>
									<?php 
									for($j=1;$j<6;$j++)
									{
										
										?>
										<td><strong><?php echo $productiondt[$i][$j]; ?></strong></td>
										
										
										<?php 
										}
									
									?>
									</tr>
									<?php 
									}
								}
								?>
								
								<tr><td colspan="5" class="bg-gray" ><strong>Total</strong></td></tr>
								<tr class="bg-yellow disabled color-palette">
								<td ><strong><?php echo $productiontoday[0]; ?></strong></td>
								<td><strong><?php echo $productiontoday[1]; ?></strong></td>
								<td><strong><?php echo $productiontoday[2]; ?></strong></td>
								<td><strong><?php echo $productiontoday[3]; ?></strong></td>
								<td><strong><?php echo $productiontoday[4]; ?></strong></td>
								</tr>
								
</tbody>
</table>
	

		</div>
		</div>
			
	<?php
		}
		if( in_array("4", $modules) || in_array("5", $modules))
		{
			?>
	<div class="box box-info box-solid">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-gears"></i> तासवार/जातवार  ऊस गाळप  </h3>
		</div>
		
		<div class="box-body">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            	 <?php 
			if(in_array("4", $modules))
			{?>
              <li class="active">
              <a href="#tab_11" data-toggle="tab" aria-expanded="true">
              	<i class="fa fa-tree"></i> तासवार  </a>
              	</li>
              	
              	<?php } 
				if(in_array("5", $modules))
				{?>
					  <li class="">
					  <a href="#tab_22" data-toggle="tab" aria-expanded="false">
					  <i class="fa fa-clock-o"></i> जातवार  </a>
						</li>
					  <li class="">
					  <a href="#tab_33" data-toggle="tab" aria-expanded="false">
					  <i class="fa fa-clock-o"></i>  जातवार %</a>
						</li>
						<?php } 
					?>
              
            </ul>
	
	
	
            <div class="tab-content">
			 	 <?php 
        if(in_array("4", $modules))
        {?>
				              <div class="tab-pane active" id="tab_11">
                <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-primary"><td colspan="2" align="center"><strong>4-12</strong></td><td colspan="2" align="center"><strong>12-8</strong></td><td colspan="2" align="center"><strong>8-4</strong></td></tr>
                                </thead>
                                <tbody>
                                    <?php
								for($i=0;$i<8;$i++)
								{?>
									<tr>
									<?php for($j=0;$j<6;$j++)
									{
										if($j%2==0)
										{
										?>
										<td class="bg-gray"><?php echo $nlblshift[$i][$j];?></td>
										<?php }
										else
										{?>
										<td><?php echo $nlblshift[$i][$j] ;?></td>
										<?php
										}
									}
									?>
									</tr>
									<?php
								}
								?>
                                </tbody>
                            </table>
						
					
              </div>
			  
		<?php }
        if(in_array("5", $modules))
        {?>
			  
              <div class="tab-pane" id="tab_22">
                <table class="table table-bordered table table-striped">
                                <thead>  
                                    <tr class="bg-primary" align="center">
									<th>ऊस जात</th>
									<th><strong>4-12</strong></th>
                                        <th><strong>12-8</strong></th>
                                        <th><strong>8-4</strong></th>
                                        <th><strong>एकूण</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    	
										<?php
										for($i=0;$i<14;$i++)
										{
											if($lblnvaritey[$i][0]!= "00")
											{
											?>	
												<tr align="center">
											<?php	for( $j=0;$j<5;$j++)
												{
												?>	
													<td><?php echo ($lblnvaritey[$i][$j]=="???")?"इतर":$lblnvaritey[$i][$j]; ?></td>
													<?php
												}
											?>
											</tr>
											<?php
											}
										}
										?>	
                                </tbody>
                            </table>
              </div>
              <!-- /.tab-pane -->
				<div class="tab-pane" id="tab_33">
              	<table class="table table-bordered table table-striped">
                                <thead>  
                                    <tr class="bg-primary" align="center">
									<th>ऊस जात</th>
									<th><strong>आज अखेर</strong></th>
                                        <th><strong>टक्केवारी</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    	
										<?php 
										for($i=0;$i<14;$i++)
										{
											if($lblnvariteyPer[$i][0]!= "00")
											{
											?>	
												<tr align="center">
											
													<td><?php echo ($lblnvariteyPer[$i][0]=="???")?"इतर":$lblnvariteyPer[$i][0]; ?></td>
												<td><?php echo $lblnvariteyPer[$i][1]; ?></td>
												<td><?php echo $lblnvariteyPer[$i][2]; ?> %</td>
											</tr>
											<?php
											}
										}
										?>	
                                </tbody>
                            </table>
                
						
					
              </div>
              <!-- /.tab-pane -->
             <?php 
		}
		?>
            </div>
            <!-- /.tab-content -->
          </div>
		</div>
		</div>
    <?php 
		}
		?>
		
	
	</section>	
    <footer class="main-footer">
    <!-- To the right -->
    
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="http://www.softtantra.com">SoftTantra</a>.</strong> All rights reserved.
  </footer>
  
  <?php
}
else
{
	echo "Login failed";
}
?>