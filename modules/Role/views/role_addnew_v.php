
<div class="col-md-7 col-lg-7 col-xs-12 col-sm-12">
<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Add Role</h3>
</div>
<!-- /.box-header -->
<!-- form start -->


	<?php echo form_open(); ?>
<div class="box-body">
<div class="form-group">
<label>Name <label style="color: #F00;">*</label></label>
<?php 
$data_form =array(
		'id'=> 'role_name',
		'name' => 'role_name',
		'value'=> set_value('role_name'),
		'class'=>'form-control',
		'placeholder' => 'Enter Role',
		'tabindex' => '1'
);

echo form_input($data_form); ?>
 <?php echo form_error('role_name',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
</div>

<div class="checkbox">
<label>
	<input type="checkbox" name='status' checked="true" tabindex="2"> Active
</label>
</div>
</div>
<!-- /.box-body -->

<div class="box-footer">
<center>
<?php echo form_submit('submit', 'Submit','class="btn btn-sm btn-primary" tabindex="3" '); ?>
 <a class="btn btn-sm btn-danger" href="<?php echo base_url().'Role'; ?>" tabindex="4">Cancel</a>
 </center>
</div>
<?php echo form_close(); ?>
</div>
<!-- /.box -->
</div>
