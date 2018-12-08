
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<!-- general form elements -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Password Change</h3> for <label><?php echo $user->name;?></label>
		</div>
		<!-- /.box-header -->
        	

	<!-- form start -->
<form method="post" role="form">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="box-body">
				<div class="col-lg-6 col-md-6 col-xs-6">
					
				 <div class="form-group">
	<label>Password <label style="color: #F00;">*</label></label>
	<?php 
	$data_form =array(
			'id'=> 'pass',
			'name' => 'pass',
			
			'class'=>'form-control',
			'tabindex'=>'3',
			'placeholder'=>'Enter Password'
	);
	
	echo form_password($data_form); ?>
	<?php echo form_error('pass',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
 </div>

				<div class="form-group">
	<label>Confirm Password <label style="color: #F00;">*</label></label>
	<?php 
		$data_form =array(
				'id'=> 'cpass',
				'name' => 'cpass',
				
				'class'=>'form-control',
				'tabindex'=>'4',
				'placeholder'=>'Confirm Password'
		);
		
		echo form_password($data_form);
	?>
   <?php echo form_error('cpass',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<center>
							<input type="submit" name="btnsave" value="Update" class="btn btn-sm btn-primary" tabindex="5"> 
							<a class="btn btn-sm btn-danger" href="<?php echo base_url().'User'; ?>" tabindex="6">Cancel</a>
						</center>
					</div>
				</div>
			</div>
		</form>
	</div>