
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
	<!-- general form elements -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Change Password</h3>
		</div>
		<!-- /.box-header -->
        	

	<!-- form start -->
<form method="post" role="form">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			<div class="box-body">
				<div class="form-group">
<label>Current Password <label style="color: #F00;">*</label></label>
<?php 
$data_form =array(
		'id'=> 'curr_pass',
		'name' => 'curr_pass',
		'class'=>'form-control',
		'placeholder' =>"Current Password"
);

echo form_password($data_form); ?>
<?php echo form_error('curr_pass',"<span class='help-block alert-dismissible alert-danger'>" ,"</span>"); ?>
</div>

<div class="form-group">
<label>New Password <label style="color: #F00;">*</label></label>
<?php 
$data_form =array(
		'id'=> 'pass',
		'name' => 'pass',
		'class'=>'form-control',
		'placeholder' =>"New Password"
);

echo form_password($data_form); ?>
<?php echo form_error('pass',"<span class='help-block alert-dismissible alert-danger'>" ,"</span>"); ?>
</div>
<div class="form-group">
<label>Confirm Password <label style="color: #F00;">*</label></label>
<?php 
$data_form =array(
		'id'=> 'cpass',
		'name' => 'cpass',
		'class'=>'form-control',
		'placeholder' =>"Confirm Password"
);

echo form_password($data_form); ?>
<?php echo form_error('cpass',"<span class='help-block alert-dismissible alert-danger'>" ,"</span>"); ?>
</div>
						
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<center>
							<input type="submit" name="btnsave" value="Update"
								class="btn btn-sm btn-primary"> <a class="btn btn-sm btn-danger"
								href="<?php echo base_url().'Home'; ?>">Cancel</a>
						</center>
					</div>
				</div>
			</div>
		</form>
	</div>