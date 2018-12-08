<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Role List</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            
              <div class="table-responsive">
                <table class="table table-striped table-bordered no-margin"  id="example2">
                  <thead class="bg-primary">
                  <tr>
                    <th width="5%;">Sr.No</th>
                    <th>Name</th>
                    <th>Status</th>
                 
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                   $cnt=0;
                  	if(!empty($roles_list))
					{
						
					  foreach($roles_list as $role)
					  {
						  $cnt = $cnt+1;
						  
						  ?>
                  
                  	<tr>
                  	<td><?php echo $cnt; ?></td>
                  	
                  	<td><?php echo $role->role_name;?></td>
                  	<?php 
                  	if($role->status==1)
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
                 
                  	</tr>
                  	<?php 
					  }
					}					
				 ?> 
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
             </div>
            <!-- /.box-footer -->
          </div>
          
             <script type="text/javascript">
  		function delete_record(id)
		{
			if(confirm("Are you sure you want to delete this Record?")){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Role/delete'); ?>",
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