

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Add User</h3>
</div>
<!-- /.box-header -->
<!-- form start -->

<?php echo form_open(); ?>
<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="box-body">
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
 	
 	<div class="form-group">
	<label>Name <label style="color: #F00;">*</label></label>
	<?php 
			$data_form =array(
					'id'=> 'name',
					'name' => 'name',
					'value'=> set_value('name'),
					'class'=>'form-control',
					'tabindex'=>'1',
					'placeholder'=>'Enter Name'
			);
	
			echo form_input($data_form);
	?>
	 <?php echo form_error('name',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
 </div>
 
  
</div>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
 	
 	<div class="form-group">
	<label>Username <label style="color: #F00;">*</label></label>
	<?php 
			$data_form =array(
					'id'=> 'username',
					'name' => 'username',
					'value'=> set_value('username'),
					'class'=>'form-control',
					'tabindex'=>'2',
					'placeholder'=>'Enter Username'
			);
	
			echo form_input($data_form);
	?>
	 <?php echo form_error('username',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
 </div>
 
  
</div>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
	
 
 <div class="form-group">
	<label>Password <label style="color: #F00;">*</label></label>
	<?php 
	$data_form =array(
			'id'=> 'pass',
			'name' => 'pass',
			'value'=> set_value('pass'),
			'class'=>'form-control',
			'tabindex'=>'3',
			'placeholder'=>'Enter Password'
	);
	
	echo form_password($data_form); ?>
	<?php echo form_error('pass',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
 </div>
 
</div>

 
</div>
<!-- /.box-body -->

<div class="box-footer">
						<center>
							<input type="submit" name="btnsave" value="Submit" class="btn btn-sm btn-primary" tabindex="4"> 
							<a class="btn btn-sm btn-danger" href="<?php echo base_url().'User'; ?>" tabindex="5">Cancel</a>
						</center>
					</div>
				</div>
			</div>
		</form>
	</div>
