<div class="row col-md-offset-2">
	<?php if(isset($msg)){ ?>
		<div class="alert alert-info"><?php echo $msg;?></div>
	<?php
	}
	?>
	<?php echo form_open('user_panel/create_user',array('role'=>'form','class'=>'form-horizontal','id'=>'create_user')); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Create User</h4>
		</div>
		<div class="panel-body">
				<p class="lead">Login details</p>	
					<div class="form-group col-md-12">
						<div class="col-md-3">
							<label for="username" class="control-label">Username</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Username" id="username" name="username" />
						</div>
					</div>	
					<div class="form-group col-md-12">
						<div class="col-md-3">
							<label for="password" class="control-label">Password</label>
						</div>
						<div class="col-md-6">
							<input type="password" class="form-control" placeholder="Password" id="password" name="password" />
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-3">
						<label class="control-label">Staff</label>
						</div>
						<div class="col-md-6">						
						<select name="staff" class="form-control" required >
						<option value="">--Select--</option>
						<?php 
						foreach($staff as $s){
							echo "<option value='".$s->staff_id."' >".$s->staff_name."</option>";
						}
						?>
						</select>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-striped">
							<thead>
								<th>#</th>
								<th>Function</th>
								<th>Add</th>
								<th>Edit</th>
								<th>View</th>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($user_functions as $f){ ?>
								<tr>
									<td><?php echo $i++;?>
									<td><?php echo $f->user_function;?>
									<input type="checkbox" value="<?php echo $f->function_id;?>" name="user_function[]" class="sr-only" checked /></td>
									<td><input type="checkbox" name="<?php echo $f->function_id;?>[]" value="add" /></td>
									<td><input type="checkbox" name="<?php echo $f->function_id;?>[]" value="edit" /></td>
									<td><input type="checkbox" name="<?php echo $f->function_id;?>[]" value="view" /></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>State</th>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($states as $s){ ?>
								<tr>
									<td><?php echo $i++;?>
									<td><?php echo $s->state;?></td>
									<td><input type="checkbox" value="<?php echo $s->state_id;?>" name="state[]" /></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Division</th>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($divisions as $d){ ?>
								<tr>
									<td><?php echo $i++;?>
									<td><?php echo $d->division;?></td>
									<td><input type="checkbox" value="<?php echo $d->division_id;?>" name="division[]" /></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>User Department</th>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($user_departments as $u){ ?>
								<tr>
									<td><?php echo $i++;?>
									<td><?php echo $u->user_department;?></td>
									<td><input type="checkbox" value="<?php echo $u->user_department_id;?>" name="user_department[]" /></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
		</div>
		<div class="panel-footer">
				<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
		</div>
	</div>	
	</form>
</div>