<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#agreement_date").Zebra_DatePicker({
		direction:false
	});
	$("#probable_date_of_completion,#agreement_completion_date").Zebra_DatePicker();
	$("#mandal").chained("#district");
	$("#division").chained("#district");
	$("#staff").chained("#division");
});
</script>

  <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD PROJECT</u></h3></center><br>
 <?php echo form_open('projects/create',array('role'=>'form')); ?>
	<div class="form-group">
		<label for="project_name" class="col-md-4">Project Name <span style="color:red">*</span></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Project Name" id="project_name" name="project_name" required />
		</div>
	</div>
	<div class="form-group">
		<label for="work_type" class="col-md-4" >Work Type</label>
		<div  class="col-md-8">
		<select name="work_type" id="work_type" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($work_type as $w){
			echo "<option value='$w->work_type_id'>$w->work_type</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="road_length_target" class="col-md-4">Length (Target) </label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Length Target in Kms" id="road_length_target" name="road_length_target"  />
		</div>
	</div>
	<div class="form-group">
		<label for="project_address" class="col-md-4">Project Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Project Address" id="project_address" name="project_address" />
		</div>
	</div>
	<div class="form-group">
		<label for="district" class="col-md-4" >District <span style="color:red">*</span></label>
		<div  class="col-md-8">
		<select name="district_id" id="district" class="form-control" required >
		<option value="">--SELECT--</option>
		<?php foreach($districts as $district){
			echo "<option value='$district->district_id'>$district->district_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="division" class="col-md-4" >Division <span style="color:red" >*</span></label>
		<div  class="col-md-8">
		<select name="division_id" id="division" class="form-control" required >
		<option value="">--SELECT--</option>
		<?php foreach($divisions as $division){
			echo "<option value='$division->division_id' class='$division->district_id' >$division->division</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="mandal" class="col-md-4" >Mandal</label>
		<div  class="col-md-8">
		<select name="mandal_id" id="mandal" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($mandals as $mandal){
			echo "<option value='$mandal->mandal_id' class='$mandal->district_id'>$mandal->mandal</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="category1_id" class="col-md-4">Budget Head</label>
		<div  class="col-md-8">
		<select name="category1_id" id="category1_id" class="select-box selectized"  >
		<option value="">--SELECT--</option>
		<?php foreach($category1 as $category){
			echo "<option value='$category->category_id'>$category->category_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="grant" class="col-md-4">Grant <span style="color:red">*</span></label>
		<div  class="col-md-8">
		<select name="grant" id="grant" class="select-box selectized" required >
		<option value="">--SELECT--</option>
		<?php foreach($grants as $grant){
			echo "<option value='$grant->phase_id'>$grant->phase_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="category2_id" class="col-md-4">Grant Category</label>
		<div  class="col-md-8">
		<select name="category2_id" id="category2_id" class="select-box selectized"  >
		<option value="">--SELECT--</option>
		<?php foreach($category2 as $category){
			echo "<option value='$category->category_id'>$category->category_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="assembly_constituency" class="col-md-4" >Assembly Constituency</label>
		<div  class="col-md-8">
		<select name="assembly_constituency_id" id="assembly_constituency_id" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($assembly_constituencys as $assembly_constituency){
			echo "<option value='$assembly_constituency->assembly_constituency_id'>$assembly_constituency->assembly_constituency</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="parliament_constituency" class="col-md-4" >Parliament Constituency</label>
		<div  class="col-md-8">
		<select name="parliament_constituency_id" id="parliament_constituency_id" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($parliament_constituencys as $parliament_constituency){
			echo "<option value='$parliament_constituency->parliament_constituency_id'>$parliament_constituency->parliament_constituency</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="staff" class="col-md-4" >Recording Officer</label>
		<div  class="col-md-8">
		<select name="staff" id="staff" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($staff as $s){
			echo "<option value='$s->staff_id' class='$s->division_id'>$s->designation - $s->staff_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<!-- <div class="form-group">
		<label for="facility" class="col-md-4" >Facility</label>
		<div  class="col-md-8">
		<select name="facility" id="facility" class="form-control" required>
		<option value="">--SELECT--</option>
		<?php foreach($facilities as $facility){
			echo "<option value='$facility->facility_id' class='$facility->division_id'>$facility->facility_name</option>";
		}
		?>
		</select>		
	</div>
	</div>	-->
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Ref. to Admin Sanction</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Ref. to Admin Sanction" id="ref_admin" name="ref_admin" />
		</div>
	</div>
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Admin Sanction Amt</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Admin sanction amount" id="admin_amount" name="admin_amount" />
		</div>
	</div>
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Ref. to Technical Sanction</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Ref. to Technical Sanction" id="ref_tech" name="ref_tech" />
		</div>
	</div>
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Technical Sanction Amount</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Technical Sanction Amount" id="tech_amount" name="tech_amount" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_amount" class="col-md-4">Agreement Amount</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agreement Amount Rs" id="agreement_amount" name="agreement_amount" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_number" class="col-md-4">Agreement Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agreement Number" id="agreement_number" name="agreement_number" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_date" class="col-md-4">Agreement Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agreement Date" id="agreement_date" name="agreement_date" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_completion_date" class="col-md-4">Completion Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="as per Agreement" id="agreement_completion_date" name="agreement_completion_date" />
		</div>
	</div>
	<div class="form_group">
		<label for="user_department" class="col-md-4">User Department <span style="color:red">*</span></label>
		<div  class="col-md-8">
		<select name="user_department" id="user_department" class="select-box selectized" required >
		<option value="">--SELECT--</option>
		<?php foreach($user_departments as $user_department){
			echo "<option value='$user_department->user_department_id'>$user_department->user_department</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="agency" class="col-md-4">Agency</label>
		<div  class="col-md-8">
		<select name="agency" id="agency" class="select-box selectized" >
		<option value="">--SELECT--</option>
		<?php foreach($agencies as $agency){
			echo "<option value='$agency->agency_id'>$agency->agency_name</option>";
		}
		?>
		</select>
		</div>
	</div>
	<div class="form_group">
		<label for="probable_date_of_completion" class="col-md-4">Probable Date of Completion</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Probable Date of Completion" id="probable_date_of_completion" name="probable_date_of_completion" />
		</div>
	</div>
	</div> 
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
