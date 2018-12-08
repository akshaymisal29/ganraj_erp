
<div class="col-md-6 col-lg-7 col-xs-12 col-sm-12">
<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Edit Role</h3>
</div>
<!-- /.box-header -->
<!-- form start -->

	<?php echo form_open(); ?>
<div class="box-body">
<div class="form-group">
<label>Name</label>
<?php 
$data_form =array(
		'id'=> 'id',
		'name' => 'id',
		'value'=> $role->role_id,
		'hidden' => TRUE
);

echo form_input($data_form); ?>
  <?php //echo form_input('role_name',$role->role_name,'class=form-control','tabindex = "1"','onblur="check_name()"'); ?>
  <input type="text" name="role_name" id="role_name" class="form-control" tabindex="1" value="<?php if(isset($role->role_name)){ echo $role->role_name; }else{ echo set_value('role_name'); }?>" onblur="check_name()">
   <?php echo form_error('role_name',"<span class='help-block alert alert-dismissible alert-danger'>" ,"</span>"); ?>
   <input type="hidden" name="role_name_old" id="role_name_old" value="<?php if(isset($role->role_name)){ echo $role->role_name; }?>">
   <div id="name_err"></div>
</div>

<div class="checkbox">
<label>
	<input type="checkbox" name='status' tabindex="2"
	<?php if($role->status==1) 
	{ echo "checked=true";
}?> > Active
</label>
</div>
</div>
<!-- /.box-body -->

<div class="box-footer">
<center>
<?php echo form_submit('submit', 'Update','id="btnsave" name="btnsave" class="btn btn-sm btn-primary" tabindex = "3"'); ?>
<a class="btn btn-sm btn-danger" href="<?php echo base_url().'Role'; ?>" tabindex="4">Cancel</a>
</center>
</div>
<?php echo form_close(); ?>
</div>
<!-- /.box -->
</div>

<script type="text/javascript">

function check_name()
{
	name     = document.getElementById("role_name").value;
	name_old = document.getElementById("role_name_old").value;

	if(name_old==name)
	{
		document.getElementById("btnsave").disabled=false;
		document.getElementById('name_err').innerHTML = "";
	
	}
	else
	{
		$.ajax({
			type: "POST",
		url: "<?php echo base_url('Role/check_role'); ?>",
			data: {"name":name},
			success: function(result)
			{
				if($.trim(result) == "error")
				{
					document.getElementById("btnsave").disabled=true;
					document.getElementById('name_err').innerHTML = "<span class='help-block alert alert-dismissible alert-danger'>Role Name already in use!.</span>";
					 document.getElementById('role_name').focus(); 
		
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

