

	<!-- general form elements -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit User</h3>
		</div>
		<!-- /.box-header -->
        	

	<!-- form start -->
<form method="post" role="form">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="box-body">
			<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
	
 
 					<div class="form-group">
						<label>Name <label style="color: #F00;">*</label></label> 
						<input type="text" name="name" value="<?php echo $user->name;?>" id="name" class="form-control" tabindex="1">
                    	   <?php echo form_error('name',"<span class='help-block alert-dismissible alert-danger'>" ,"</span>"); ?>
                    	 
                        </div>
 
				</div>
				<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
					<div class="form-group">
						<label>Username <label style="color: #F00;">*</label></label> 
						<input type="text" name="username" value="<?php echo $user->user_name;?>" id="username" class="form-control" tabindex="2" onblur="check_name()">
                    	   <?php echo form_error('username',"<span class='help-block alert-dismissible alert-danger'>" ,"</span>"); ?>
                    	    <input type="hidden" name="user_name_old" id="user_name_old" value="<?php if(isset($user->name)){ echo $user->user_name; }?>">
                    	  	  <div id="name_err"></div>
                        </div>
						<?php
						$data_form = array (
								'id' => 'id',
								'name' => 'id',
								'value' => $user->user_id,
								'hidden' => TRUE 
						);
						
						echo form_input ( $data_form );
						?>
						
						
							
					
				</div>
				
				<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
	
 
 					<div class="form-group">
						<label>Password <label style="color: #F00;">*</label></label> 
						<input type="password" name="pass" value="<?php echo $user->password;?>" id="pass" class="form-control" tabindex="3">
                    	   <?php echo form_error('pass',"<span class='help-block alert-dismissible alert-danger'>" ,"</span>"); ?>
                    	 
                        </div>
 
				</div>

			
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<center>
							<input type="submit" name="btnsave" id="btnsave" value="Update" class="btn btn-sm btn-primary" tabindex="4"> 
							<a class="btn btn-sm btn-danger" href="<?php echo base_url().'User'; ?>" tabindex="5">Cancel</a>
						</center>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">

	function check_name()
	{
		username     = document.getElementById("username").value;
		username_old = document.getElementById("user_name_old").value;

		alert(username);
		if(username_old==username)
		{
			document.getElementById("btnsave").disabled=false;
			document.getElementById('name_err').innerHTML = "";
	
		
		}
		else
		{
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('User/check_user'); ?>",
				data: {"username":username},
				success: function(result)
				{
					
					if($.trim(result) == "error")
					{
						 
						 document.getElementById("btnsave").disabled=true;
						document.getElementById('name_err').innerHTML = "<span class='help-block alert alert-dismissible alert-danger'>User Name already in use!.</span>";
						 document.getElementById('username').focus(); 
					
					
			
					}
					else if($.trim(result) == "success")
					{
						document.getElementById("btnsave").disabled=false;
						document.getElementById('name_err').innerHTML = "<span></span>";
						
					}
				 }
			});
		}	
	}

	


	</script>