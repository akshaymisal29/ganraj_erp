<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Category List</h3>

              <div class="box-tools pull-right">
                <a href="<?php echo base_url()?>Category/add_new/" class="btn btn-sm btn-primary btn-flat pull-left"><i class="glyphicon glyphicon-plus"></i> Add New</a>
        
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
               
              
              <div class="table-responsive">
                <table class="table table-striped table-bordered no-margin" id="example2">
                  <thead>
                  <tr>
                    <th width="5%;">Sr.No</th>
                    <th>Category</th>
                    <th>Status</th>
					<th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  	$total_count = 0;$showing=0;
				  	if(!empty($category_list))
					{
						$total_count = $total_rows;
						
						$showing= 10;
						
						if($this->uri->segment(3)!="")
						{
							$showing = $showing+10;	
						}
						if($total_count <  $showing)
						{
							$showing = $total_count;	
						}
						$cnt = $this->uri->segment(3)!="" ? $this->uri->segment(3) : 0;
						
					  foreach($category_list as $row)
					  {
						  $cnt = $cnt+1;
						  
                  	?>
                  	<tr>
                  	<td><?php echo $cnt; ?></td>
                  	<td><?php echo $row->cat_name;?></td>
                  	<?php 
                  	if($row->status==1)
                  	{
                  	?>
                  	<td><span class="label label-success">Active</span></td>
                  	<?php 
                  	}
                  	else
                  	{
                  	?>
      				<td><span class="label label-danger">Inactive</span></td>
      				<?php 
                  	}?>
                    <td>
                    	<a href="<?php echo base_url().'Category/edit/'.$row->cat_id;?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a> |
                  	    <a href="javascript:delete_area('<?php echo $row->cat_id; ?>')" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-trash"></i></a> 
                           
                  	</td>
                  	</tr>
                  	<?php                	
                  }
				  
					}
					else
					{
                  ?>
                 	 <tr><td colspan="4" align="center"><strong>No Records Available</strong></td></tr>
                 <?php } ?>  
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             	<!--<div class="pull-left">	
             		<?php //echo $pages;?>
                </div>
                <div class="pull-right">
                	Showing <?php //echo $showing; ?> records  of <?php //echo $total_count; ?>  entries
                </div>		
             </div>
			 -->
            <!-- /.box-footer -->
          </div>
  <script type="text/javascript">
  		function delete_area(id)
		{
			if(confirm("Are you sure you want to delete this Record?")){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Category/delete'); ?>",
				data: {"id":id},
				success: function(result){
					location.reload();
				 }
				 
				 
			});
	     }
			
		}
  
  </script>        
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example2").DataTable();
   
  });
</script>  

          