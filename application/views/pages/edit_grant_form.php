
<?php echo validation_errors(); ?>
<div class="col-md-12 col-md-offset-2">
    <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>EDIT GRANT</u></h3></center><br> 
 <?php if(isset($grant)){   $grant = (object) $grant[0]; ?>
 
    <?php echo form_open('masters/update_grant',array('role'=>'form')); ?>
    <div class="form-group">
        <label for="grant_name" class="col-md-4">Grant Name</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Grant Name" id="grant_name" name="grant_name" value="<?php echo $grant->grant_name; ?>" required />
        </div>
    </div>    
    <div class="form-group">
        <label for="grant_phase" class="col-md-4">Grant Phases</label>
        <?php $i=1; 
            foreach($grant_phases as $grant_phase){
        ?>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Phase" id="phase_name_<?php echo $i;?>" name="phase_name_<?php echo $i;?>" value="<?php echo $grant_phase->phase_name; ?>" />
        <input type="hidden" class="form-control" id="phase_id_<?php echo $i;?>" name="phase_id_<?php echo $i;?>" value="<?php echo $grant_phase->phase_id; ?>" />
        </div>
        <?php 
          $i++;  }
        ?>
        <input type="hidden" class="form-control" id="phases" name="phases" value="<?php echo sizeof($grant_phases); ?>" />
    </div>    
    <div class="form-group">

           <label for="grant_source" class="col-md-4" >Grant Source</label>
           <div  class="col-md-8">
           <select name="grant_source" id="grant_source" class="form-control">
           <option value="">--SELECT--</option>
           <?php foreach($grant_sources as $grant_source){
                   $option = "<option ";
                   if($grant_source->grant_source_id == $grant->grant_source_id){
                       $option .= " value= '".$grant_source->grant_source_id."' selected ";
                   }
                   echo $option.">$grant_source->grant_source</option>";
           }
           ?>
           </select>		
   </div>
	</div>
       <div class="col-md-3 col-md-offset-4"> 
         <input type='hidden' value="<?php echo $grant->grant_id; ?>" name="grant_id" />
         <input type='hidden' value="1" name="update" />
    <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
    </div>
 <?php } else{ ?>
   <?php  echo form_open('masters/update_grant',array('role'=>'form')); ?>
 <div class="form-group">        
        <div  class="col-md-8">
            <table class="table table-bordered table-striped">
                 <tr>
                     <th>Grant ID</th>
                     <th>Grant Source</th>
                     <th>Grant Name</th>
                     <th>Grant Phase</th>                     
                 </tr>
                 <?php foreach($grant_names as $grant_name){ ?>
                 <tr onclick="$('#select_grant_form_<?php echo $grant_name->grant_id; ?>').submit();">                    
                    <td><?php echo form_open('masters/update_grant',array('id'=>'select_grant_form_'.$grant_name->grant_id,'role'=>'form')); ?>
                        <?php echo $grant_name->grant_id; ?>
                        <input name="search" value='1' type="hidden" />
                        <input name="grant_id" value='<?php echo $grant_name->grant_id; ?>' type="hidden" />
                    </td>
                    <td><?php echo $grant_name->grant_source; ?></td>
                    <td><?php echo $grant_name->grant_name; ?></td>
                    <td>                        
                        <?php echo $grant_name->phase_name; ?>                        
                    </td>
                    </form>
                 </tr>
                 <?php } ?>
             </table>
        
        </div>
</div>
<?php }?>
</div>