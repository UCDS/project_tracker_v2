<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>

<script type="text/javascript">
	$(function(){
		$("#date_of_birth").Zebra_DatePicker();
		$("#department").on('change',function(){
			var department_id=$(this).val();
			$("#unit option,#area option").hide();
			$("#unit option[class="+department_id+"],#area option[class="+department_id+"]").show();
		});
	$("#reporting_officer").chained("#division");
	});
</script>

<div class="col-md-8 col-md-offset-2">
	
	<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Staff Details</h3>
	</center><br>
	
	<center>
		<?php echo validation_errors(); ?>
	</center>
	<?php 
	//What is form_open ?
	echo form_open('staff/add/staff',array('class'=>'form-horizontal','role'=>'form','id'=>'add_staff')); 
	?>

	<div class="form-group">
		<div class="col-md-3">
			<label for="first_name" class="control-label">First Name</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" required />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="last_name" class="control-label">Last Name</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label class="control-label">Gender</label>
		</div>
		<div class="col-md-6">
			<label class="control-label">
				<input type="radio" name="gender" value="M" checked />Male
			</label>
			<label class="control-label">
				<input type="radio" name="gender" value="F" />Female
			</label>
			<label class="control-label">
				<input type="radio" name="gender" value="O" />Other
			</label>
		</div>
	</div>	
	<div class="form-group">
		<div class="col-md-3">
			<label for="date_of_birth" class="control-label">Date of Birth</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control date" placeholder="Date of Birth" id="date_of_birth" name="date_of_birth" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="division" class="control-label">Division</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="division" name="division" >
				<option value="">Division</option>
				<?php foreach($divisions as $d){
				echo "<option value='$d->division_id'>$d->division</option>";
				}?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="reporting_officer" class="control-label">Reporting Officer</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="reporting_officer" name="reporting_officer" >
				<option value="">Select</option>
				<?php 
					foreach($reporting_officers as $r){
						echo "<option value='$r->staff_id' class='$r->division_id'>$r->designation - $r->staff_name</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="staff_category" class="control-label">Staff Category</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="staff_category" name="staff_category" >
				<option value="">Staff Category</option>
				<?php foreach($staff_category as $sc){
				echo "<option value='$sc->staff_category_id'>$sc->staff_category</option>";
				}?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="staff_role" class="control-label">Staff Role</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="staff_role" name="staff_role" >
				<option value="">Staff Role</option>
				<?php foreach($staff_role as $sr){
				echo "<option value='$sr->staff_role_id'>$sr->staff_role</option>";
				}?>
			</select>
		</div>
	</div>
	

	<div class="form-group">
		<div class="col-md-3">
			<label for="designation" class="control-label">Designation</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Designation" id="designation" name="designation" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="staff_type" class="control-label">Staff Type</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="staff_type" name="staff_type">
				<option value="">Staff Type</option>
				<option value="On Rolls">On Rolls</option>
				<option value="Contract">Contract</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="email" class="control-label">Email</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Email" id="email" name="email" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="phone" class="control-label">Phone</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" />
		</div>
	</div>
		
   	<div class="form-group col-md-9">
		<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</form>
</div>
