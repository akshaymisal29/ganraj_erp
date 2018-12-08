<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<!-- general form elements -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Category</h3>
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
                            <input type="text" name="cat_name" id="cat_name" value="<?php if(isset($area_details ->cat_name)){ echo $area_details ->cat_name; }else{ echo set_value('cat_name'); } ?>" placeholder="Enter Category" class="form-control" tabindex="1" onblur="check_name()">
                    	   <?php echo form_error('cat_name',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
                    	    <input type="hidden" name="area_name_old" id="area_name_old" value="<?php if(isset($area_details->cat_name)){ echo $area_details ->cat_name; }?>">
							<input type="hidden" name="cat_id" id="cat_id" value="<?php if(isset($area_details->cat_id)){ echo $area_details ->cat_id; }?>">
                    	   <div id="name_err"></div>
                        </div>
                        
						 <div class="checkbox">
                        	<label>
                        		<input type="checkbox" name='status'
                       			 <?php if($area_details ->status==1) 
                        				{ echo "checked=true";
                        		 }?> tabindex="2">
                                  Active
                        </label>
                        </div>
                       
                            
            		</div>
                    
                   
                </div>	
                
                <div class="box-footer">
                    <center>	
                        <input type="submit" name="btnsave" value="Update" class="btn btn-sm btn-primary" tabindex="3">
                        <a class="btn btn-sm btn-danger" href="<?php echo base_url().'Category'; ?>" tabindex="4">Cancel</a>
                    </center>
                </div>
            </div>
         </div>       
      </form>
   </div>
</div>

<script type="text/javascript">

		function check_name()
		{
			
			area_name = document.getElementById("cat_name").value;
			area_name_old=document.getElementById("area_name_old").value;
			area_id  = document.getElementById("cat_id").value;

			//alert(area_name); alert(area_id);
			if(area_name_old==area_name)
			{
				document.getElementById('name_err').innerHTML = "";
			
			}
			else
			{
				$.ajax({
 				type: "POST",
				url: "<?php echo base_url('Category/checkcat'); ?>",
 				data: {"id":area_id,"cat_name":area_name},
 				success: function(result)
 				{
 					if($.trim(result) == "error")
 					{
 						document.getElementById('name_err').innerHTML = "<span class='help-block alert alert-dismissible alert-danger'>Category already in use!.</span>";
 						 document.getElementById('area_name').focus(); 
 			
 					}
 					else if($.trim(result) == "success")
 					{
 						document.getElementById('name_err').innerHTML = "<span></span>";
 					}
 				 }
 			});
			}	
		}
		

		
		
</script>