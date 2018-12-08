<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<!-- general form elements -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Category</h3>
		</div>
		<!-- /.box-header -->
        
           
		<!-- form start -->
      <form method="post" role="form">
      	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="box-body">
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <div class="form-group">
                            <label>Category <label style="color:#F00;">*</label></label>
                            <input type="text" name="cat_name" value="<?php echo set_value('cat_name'); ?>" placeholder="Enter Category" class="form-control" tabindex="1">
                    	   <?php echo form_error('cat_name',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
                        </div>
                        
						<div class="checkbox">
                            <label>
                            	<input type="checkbox" name='status' checked="true" tabindex="2"> Active
                            </label>
                        </div>
                        
                    </div>
                    
                   
                </div>	
                
                <div class="box-footer">
                    <center>	
                        <input type="submit" name="btnsave" value="Submit" class="btn btn-sm btn-primary" tabindex="3">
                        <a class="btn btn-sm btn-danger" href="<?php echo base_url().'Category'; ?>" tabindex="4">Cancel</a>
                    </center>
                </div>
            </div>
         </div>       
      </form>
   </div>
</div> 