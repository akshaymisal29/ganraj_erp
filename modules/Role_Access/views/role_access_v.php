	
	<form method="post">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo rawurldecode($role_name);?></h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            
              <div class="table-responsive">
                <table class="table table-striped table-bordered  no-margin">
                  <thead class="bg-primary">
                  <tr>
                    <th width="5%;">Sr.No.</th>
                    <th width="10%;">Menu</th>
                    <th width="10%;">Selction</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                  	if(!empty($menu_list))
					{
						$cnt = $this->uri->segment(3)!="" ? $this->uri->segment(3) : 0;
						//echo "sdfsdf";
					  foreach($menu_list as $menu)
					  {
						  $cnt = $cnt+1;
						  
						  ?>
                  
	                  	<tr>
	                  		<td><?php echo $cnt; ?></td>
	                  	
		                  	<td>
			                  	<?php 
			                  	if($menu->sub_name == NULL)
			                  	{
			                  		echo $menu->main_name;
			                  	}
			                  	else 
			                  	{
			                  		echo $menu->main_name.'/'.$menu->sub_name;
			                  	}
								  ?>
							 </td>
							 <td>

									<input type="checkbox" name='menu_<?php echo $menu->menu_id?>'
										<?php if($menu->role_id!=NULL) { echo "checked=true";}
										
										?>
									> 

							 </td>
	                  	</tr>
                  	<?php 
					  }
										  
					}					
					else
					{
                  ?>
                 	 <tr><td colspan="3" align="center"><strong>No Records Available</strong></td></tr>
                 <?php } ?> 
                </table>
              </div>
               <div class="box-footer clearfix">
             	<?php //echo $pages;?>
             </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" align="center">
           
             		<?php  if(!empty($menu_list))
					{
						echo form_submit('submit', 'Save','class="btn btn-sm btn-primary"'); 
             		}
             		
             		?>
             		<a class="btn btn-sm btn-danger" href="<?php echo base_url().'Role'; ?>">Cancel</a>
             </div>
            
            <!-- /.box-footer -->
          </div>
          
          </form>