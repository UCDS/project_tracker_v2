<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#date").Zebra_DatePicker({
		direction:false
	});
	$("#date").Zebra_DatePicker({
		direction:1
	});
});
</script>
		<div class="col-md-8 col-md-offset-2">
				<center>	<h3><u>ADD USER</u></h3></center><br>
	<?php echo form_open('projects/user',array('role'=>'form')); ?>
  <div class="form-group">
  <label for="user_type" class="col-md-4" >User Type</label>
  <div  class="col-md-8">
  <select name="user_type" id="user_type" class="form-control">
  <option value="">--SELECT--</option>
  <option value="superinendant" <?php echo set_select('user_type', 'superinendant'); ?> >Superinendant Engineer</option>
  <option value="executive" <?php echo set_select('user_type', 'executive'); ?> >Executive Engineer</option>
  <option value="deputy" <?php echo set_select('user_type', 'deputy'); ?> >Deputy Executive Engineer</option>
  <option value="assistant" <?php echo set_select('user_type', 'assistant'); ?> >Assistant Executive Engineer </option>
  </select></div></div>
	    <div class="form-group">
		<label for="username" class="col-md-4">User Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="User Name" id="username" name="username" />
		</div>
	    </div>
	<div class="form-group">
    <label for="password" class="col-md-4">Password</label>
	<div  class="col-md-8">
	<input type="password" class="form-control" placeholder="Password" id="password" name="password" />
	</div>
	</div>
	    <div class="form-group">
		<label for="first_name" class="col-md-4">First Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" />
		</div>
	    </div>
	<div class="form-group">
		<label for="last_name" class="col-md-4">Last Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" />
		</div>
	</div>
	
		<div class="form_group">
		<label for="date" class="col-md-4">Date of Birth</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Date of Birth" id="date" name="date" />
		</div>
	</div>

	<div class="form-group">
		<label for="phone_no" class="col-md-4">Phone Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Phone Number" id="phone_no" name="phone_no" />
		</div>
	</div>
	<div class="form-group">
		<label for="email_id" class="col-md-4">Email Id</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Email Id" id="email_id" name="email_id" />
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-md-4">Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Address" id="address" name="address" />
		</div>
	</div>
	<div class="form-group">
		<label for="country" class="col-md-4" >Country</label>
		<div  class="col-md-8">
		<select name="country" id="country" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($country as $c){
			echo "<option value=$c->country</option>";
		}
		?>
		</select>
		</div>
	</div>
	<div class="form-group">
		<label for="state" class="col-md-4" >State</label>
		<div  class="col-md-8">
		<select name="state" id="state" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($state as $state){
			echo "<option value=$state->state</option>";
		}
		?>
		</select>		</div>
	</div>	
	<div class="form-group">
		<label for="city" class="col-md-4" >City</label>
		<div  class="col-md-8">
		<select name="city" id="city" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($city as $city){
			echo "<option value=$city->city</option>";
		}
		?>
		</select>		</div>
	</div>	
	
		
	<div class="form-group">
		<label for="pincode" class="col-md-4">Pincode</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Pincode" id="pincode" name="pincode" />
		</div>
	</div>
	<div class="form_group">
		<label for="gender" class="col-md-4">Gender</label>
		<div  class="col-md-8">
		<label class="radio-inline" for="male">
		<input type="radio" name="male" id="male" value="M" />Male 
		</label>
		<label for="female" class="radio-inline"> 
		<input type="radio" id="female" name="female" value="F" /> 
		Female
		</label>
		</div>
</div></div>	
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
