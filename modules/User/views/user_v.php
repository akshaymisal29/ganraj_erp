<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User List</h3>

              <div class="box-tools pull-right">
                <a href="<?php echo base_url()?>User/add_new/" class="btn btn-sm btn-primary btn-flat pull-left"><i class="glyphicon glyphicon-plus"></i> Add New</a>
        
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           
        
               
              <div class="table-responsive">
                <table class="table table-striped table-bordered no-margin" id="example2">
                  <thead class="bg-primary"> 
                  <tr>
                    <th width="10%">Sr.No</th>
                    <th width="30%">Name</th>
                    <th width="20%">Username</th>
                 	<th width="40%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $cnt=0;
                  	if(!empty($user_list))
					{
					 foreach($user_list as $user)
					  {
						  $cnt = $cnt+1;
						  
						  ?>
	  	                  	<tr>
	  	                  	<td><?php echo $cnt; ?></td>
	  	                  	<td><?php echo $user->name;?></td>
	  	                  	<td><?php echo $user->user_name;?></td>
	  	                 
	  	                  	<td>
	  		                  	<a href="<?php echo base_url().'User/edit/'.$user->user_id;?>" class="btn btn-sm btn-primary" title="Edit User"><i class="glyphicon glyphicon-edit" ></i></a>
	  		                  	|
	  		                  <a href="javascript:delete_record('<?php echo $user->user_id;?>')" class="btn btn-sm btn-danger" title="Delete User"><i class="glyphicon glyphicon-trash"></i></a>|
	  		                  <a href="<?php echo base_url().'Module_Access/edit/'.$user->user_id;?>" class="btn btn-sm btn-primary">Assign Module</a>
	  	                  	</td>
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
				url: "<?php echo base_url('User/delete'); ?>",
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
  