<?php 
class Staff_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function login($username, $password){
	   $this -> db -> select('users.user_id,username');
	   $this -> db -> from('users');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	 
	   $query = $this -> db -> get();
	   if($query -> num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}
	function user_function($user_id){
		$this->db->select('user_functions.function_id,user_function,add,edit,view')->from('users')
		->join('user_function_link','users.user_id=user_function_link.user_id')
		->join('user_functions','user_function_link.function_id=user_functions.function_id')
		->where('user_function_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}	
	function user_division($user_id){
		$this->db->select('divisions.division_id,division')->from('users')
		->join('user_division_link','users.user_id=user_division_link.user_id')
		->join('divisions','user_division_link.division_id=divisions.division_id')
		->where('user_division_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	function user_state($user_id){
		$this->db->select('states.state_id,state')->from('users')
		->join('user_state_link','users.user_id=user_state_link.user_id')
		->join('states','user_state_link.state_id=states.state_id')
		->where('user_state_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	function user_department($user_id){
		$this->db->select('user_departments.user_department_id,user_department')->from('users')
		->join('user_department_link','users.user_id=user_department_link.user_id')
		->join('user_departments','user_department_link.user_department_id=user_departments.user_department_id')
		->where('user_department_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	function change_password($user_id){
		$this->db->select('password')->from('users')->where('user_id',$user_id);
		$query=$this->db->get();
		$password=$query->row();
		$form_password=$this->input->post('old_password');
		if($password->password==md5($form_password)){
			$this->db->where('user_id',$user_id);
			if($this->db->update('users',array('password'=>md5($this->input->post('password'))))){
				return true;
				}
			else return false;
		}
		else return false;
	}		
	function get($type){
		if($type=="facility"){
			if($this->input->post('facility_id')){
				$facility_id=$this->input->post('facility_id');
				$this->db->where('facility_id',$facility_id);
			}
			if($this->input->post('search_facility_type')){
				$facility_type=$this->input->post('search_facility_type');
				$this->db->where('facility_types.facility_type_id',$facility_type);
			}
			if($this->input->post('search_division')){
				$division=$this->input->post('search_division');
				$this->db->where('divisions.division_id',$division);
			}
			if($this->input->post('search_facility_name')){
				$name=strtolower($this->input->post('search_facility_name'));
				$this->db->like('LOWER(facility_name)',$name,'after');
			}
			$this->db->select("facility_id,facility_types.facility_type_id,facility_name,facilities.longitude,facilities.latitude,facility_type,division,divisions.division_id")->from("facilities")
			->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
			->join('divisions','facilities.division_id=divisions.division_id')
			->order_by('facility_name');	
		}

		$query=$this->db->get();
		return $query->result();
	}
	function get_districts($projects=-1){
		if($this->input->post('facility_type') || $this->input->post('grant') || $projects==1){
			$this->db->select("districts.district_id,district_name")->from('districts')
			->join('divisions','districts.district_id=divisions.district_id')
			->join('facilities','divisions.division_id=facilities.division_id')
			->join('projects','facilities.facility_id=projects.facility_id');
		}
		else
		$this->db->select("district_id,district_name")->from("districts");
		$this->db->order_by('district_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_divisions(){
		$this->db->select("division_id,division")->from("divisions")->order_by('division');
		$query=$this->db->get();
		return $query->result();
	}
	function get_states(){
		$this->db->select("state_id,state")->from("states")->order_by('state');
		$query=$this->db->get();
		return $query->result();
	}
	function get_user_function(){
		$this->db->select("function_id,user_function")->from("user_functions");
		$query=$this->db->get();
		return $query->result();
	}
	function get_staff(){
		$this->db->select("staff_id,CONCAT(IF(first_name!='',first_name,''),' ',IF(last_name!='',last_name,'')) staff_name,designation,division_id",false)
		->from("staff")->where('status',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_work_type(){
		$this->db->select("work_type_id, work_type")
		->from("work_type");
		$query=$this->db->get();
		return $query->result();
	}
	function get_sanction_type(){
		$this->db->select("sanction_type_id, sanction_type")
		->from("sanction_type");
		$query=$this->db->get();
		return $query->result();
	}
	function get_facilities($divisions=0){
		if(count($divisions)>0){
			$division_list=array();
			foreach($divisions as $d){
				$division_list[]=$d->division_id;
			}
			$this->db->where_in('divisions.division_id',$division_list);
		}
		if($this->input->post('facility_id')){
			$facility_id=$this->input->post('facility_id');
			$this->db->where('facility_id',$facility_id);
		}
		if($this->input->post('search_facility_type')){
			$facility_type=$this->input->post('search_facility_type');
			$this->db->where('facility_types.facility_type_id',$facility_type);
		}
		if($this->input->post('search_division')){
			$division=$this->input->post('search_division');
			$this->db->where('divisions.division_id',$division);
		}
		if($this->input->post('search_facility_name')){
			$name=strtolower($this->input->post('search_facility_name'));
			$this->db->like('LOWER(facility_name)',$name,'after');
		}
		$this->db->select("facility_id,facility_types.facility_type_id,facility_name,facilities.longitude,facilities.latitude,facility_type,division,divisions.division_id")->from("facilities")
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->order_by('facility_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_facility_types(){
		$this->db->select("facility_type_id,facility_type")->from("facility_types")->order_by('facility_type');
		$query=$this->db->get();
		return $query->result();
	}
	function get_agencies(){
		$this->db->select("agency_id,agency_name")->from("agency")->order_by('agency_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_grants($projects=-1){
		if($this->input->post('grant') || $projects==1){
			$this->db->select("*")->from('grants')
			->join('grant_phase','grants.grant_id=grant_phase.grant_id')
			->join('projects','grant_phase.phase_id=projects.grant_phase_id')
			->group_by('phase_id');
			if($this->input->post('facility_type'))
			$this->db->where('facility_type_id',$this->input->post('facility_type'));
			else if($this->input->post('districts'))
			$this->db->where('district_id',$this->input->post('districts'));
		}
		else{
		$this->db->select("phase_id,phase_name")->from("grant_phase")->join('grants','grant_phase.grant_id=grants.grant_id')->order_by('phase_name');
		}
		$query=$this->db->get();
		return $query->result();
	}
	function get_user_departments(){
		$this->db->select("*")->from("user_departments")->order_by('user_department');
		$query=$this->db->get();
		return $query->result();
	}
	function get_grant_sources(){
		$this->db->select("*")->from("grant_sources")->order_by('grant_source');
		$query=$this->db->get();
		return $query->result();
	}
	function get_status_types(){
		$this->db->select("*")->from("status_types")->order_by('status_type_id');
		$query=$this->db->get();
		return $query->result();
	}
	function get_work_stages(){
		$this->db->select("*")->from("work_stages")->order_by('status_type_id');
		$query=$this->db->get();
		return $query->result();
	}
	function get_expenses($project_id){
		$this->db->select("*")->from("project_expenses")->where('project_id',$project_id)->order_by('expense_id');
		$query=$this->db->get();
		return $query->result();
	}
	function get_bills($project_id){
		$this->db->select("*")->from("project_bills")->where('project_id',$project_id)->order_by('bill_id')->where('active',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_pendencies($project_id,$user_departments=0,$divisions=0){
		if($user_departments!=0 && $user_departments!='0' && count($user_departments)>0){
			$this->db->join('projects','ho_pendency.project_id = projects.project_id');
			$ud_id=array();
			foreach($user_departments as $ud){
				$ud_id[] = $ud->user_department_id;
			}
			$this->db->where_in('projects.user_department_id',$ud_id);
			if($divisions!=-1 && count($divisions)>0){
			$division_list=array();
			foreach($divisions as $d){
				$division_list[]=$d->division_id;
			}
			$this->db->join('facilities','projects.facility_id = facilities.facility_id');
			$this->db->join('divisions','facilities.division_id = divisions.division_id');
			$this->db->where_in('divisions.division_id',$division_list);
			}
		}
		else if($divisions!=0 && count($divisions)>0){
			$this->db->join('projects','ho_pendency.project_id = projects.project_id');
			$this->db->join('facilities','projects.facility_id = facilities.facility_id');
			$this->db->join('divisions','facilities.division_id = divisions.division_id');
			$division_list=array();
			foreach($divisions as $d){
				$division_list[]=$d->division_id;
			}
			$this->db->where_in('divisions.division_id',$division_list);
		}
		if($project_id!=0){
			$this->db->where('project_id',$project_id);
		}
		$this->db->select('pendency_type,pendency_id,pendency_date, pendency_details,ho_pendency.project_id')
		->from("ho_pendency")
		->join('pendency_type','ho_pendency.pendency_type_id = pendency_type.pendency_type_id')
		->order_by('pendency_id')
		->where('active',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_pendency_types(){
		$this->db->select("*")->from("pendency_type")->order_by('pendency_type');
		$query=$this->db->get();
		return $query->result();
	}
	function get_extensions($project_id){
		$this->db->select("*")->from("project_extension")->where('project_id',$project_id)->order_by('extension_date','DESC')->where('active',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_category1(){
		$this->db->select("*")->from("category1")->order_by("category_name");
		$query=$this->db->get();
		return $query->result();
	}
	function get_category2(){
		$this->db->select("*")->from("category2")->order_by("category_name");
		$query=$this->db->get();
		return $query->result();
	}
	function get_mandal(){
		$this->db->select("*")->from("mandal")->order_by("mandal");
		$query=$this->db->get();
		return $query->result();
	}
	function get_division(){
		$this->db->select("*")->from("divisions")->order_by("division");
		$query=$this->db->get();
		return $query->result();
	}
	function assembly_constituency(){
		$this->db->select("*")->from("assembly_constituency")->order_by("assembly_constituency");
		$query=$this->db->get();
		return $query->result();
	}
	function parliament_constituency(){
		$this->db->select("*")->from("parliament_constituency")->order_by("parliament_constituency");
		$query=$this->db->get();
		return $query->result();
	}
	function get_district(){
		$this->db->select("*")->from("districts")->order_by("district_name");
		$query=$this->db->get();
		return $query->result();
	}
	function get_targets($project_id){
	
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year_start=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year_start=date("Y-m-d",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		$this->db->select("MONTH(projection_month) month,YEAR(projection_month) year, target_amount")->from("project_targets")->where('project_id',$project_id)->where('current',1)->where("(projection_month BETWEEN '$year_start' AND '$year_end')");
		$query=$this->db->get();
		return $query->result();
	}
	function get_expense_targets($project_id){		
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year_start=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year_start=date("Y-m-d",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		$this->db->select('SUM(expense_amount) expense_amount,target_amount,projection_month')
		->from("(SELECT target_amount,project_id,MONTH(projection_month) month,projection_month FROM project_targets WHERE project_id =$project_id AND current=1 AND (projection_month BETWEEN '$year_start' AND '$year_end')) targets")
		->join("(SELECT expense_amount,project_id,MONTH(expense_date) month,expense_date FROM project_expenses WHERE project_id = $project_id AND (expense_date BETWEEN '$year_start' AND '$year_end')) expenses",'targets.month = expenses.month','left')
		->group_by('MONTH(projection_month)')
		->order_by('projection_month');
		$query=$this->db->get();
		return $query->result();

	
	}
	
	function get_images($project_id){
		$this->db->select('*')->from('project_images')->where('project_id',$project_id)->order_by('image_id','desc')->limit(4);
		$query=$this->db->get();
		return $query->result();
	}        
        
	function get_projects($user_departments=0,$divisions=-1,$division_id=-1,$facility_type=-1,$agency_id=-1,$grant=-1,$user_department=-1){
		$year_start=date("Y-m-d",strtotime("April 1"));  //April first of this year.
		$year_current=date("Y-m-d");                     //Current year
		if($year_current>=$year_start){                 //This is april or after april.
                    $year_start=date("Y-m-d",strtotime($year_start)); 
                    $year_end=date("Y-m-d",strtotime("March 31 Next year"));                     
                }
		else {                                          //This is before april
                    $year_start=date("Y-m-d",strtotime("April 1 Last year"));    //April first last year
                    $year_end=date("Y-m-d",strtotime("March 31"));                    
                }
		if($this->input->post('project_id') || $this->input->post('selected_project')){
			if($this->input->post('project_id')) $project_id=$this->input->post('project_id');
			else if($this->input->post('selected_project')) $project_id=$this->input->post('selected_project');
			$this->db->where('projects.project_id',$project_id);
		}
		// if($this->input->post('facility_id')){
		//     $this->db->where('projects.facility_id',$this->input->post('facility_id'));
		// }
		if($division_id!=-1 || $facility_type!=-1){
			if($division_id==0){
			$this->db->where('projects.division_id',0);
			}
			else{
				$this->db->where('divisions.division_id',$division_id);
			}
		}
		if($this->input->post('division_id')){
			$this->db->where('divisions.division_id',$this->input->post('division_id'));
		}
		if($this->input->post('district_id')){
			$this->db->where('districts.district_id',$this->input->post('district_id'));
		}
		if($facility_type!=-1 || $this->input->post('facility_type_id')){
				if($this->input->post('facility_type_id')) $facility_type=$this->input->post('facility_type_id');
				$this->db->where('facilities.facility_type_id',$facility_type);
		}
		if($this->input->post('phase_id')){
				$this->db->where('grant_phase_id',$this->input->post('phase_id'));
		}
		if($this->input->post('staff_id')){
				$this->db->where('projects.staff_id',$this->input->post('staff_id'));
		}
		if($this->input->post('agency_id')){
				$this->db->where('projects.agency_id',$this->input->post('agency_id'));
		}
		if($this->input->post('user_department_id')){
				$this->db->where('projects.user_department_id',$this->input->post('user_department_id'));
		}
		if($agency_id!=-1){
				$this->db->where('projects.agency_id',0);
		}
		if($user_department!=-1){
				$this->db->where('projects.user_department_id',0);
		}
		if($grant!=-1){
				$this->db->where('projects.grant_phase_id',0);
		}
		if($this->input->post('state')){
			$this->db->where('state_id',$this->input->post('state'));
		}
		if($this->input->post('work_type')){
			$this->db->where('projects.work_type_id',$this->input->post('work_type'));
		}
		if($this->input->post('sanction_type')){
			$this->db->where('projects.sanction_type_id',$this->input->post('sanction_type'));
		}
		if($user_departments!=0 && $user_departments!='0' && count($user_departments)>0){
			$ud_id=array();
			foreach($user_departments as $ud){
				$ud_id[] = $ud->user_department_id;
			}
			$this->db->where_in('projects.user_department_id',$ud_id);
			if($divisions!=-1 && count($divisions)>0){
			$division_list=array();
			foreach($divisions as $d){
				$division_list[]=$d->division_id;
			}
			$this->db->where_in('divisions.division_id',$division_list);
			}
		}
		else if($divisions!=-1 && count($divisions)>0){
			$division_list=array();
			foreach($divisions as $d){
				$division_list[]=$d->division_id;
			}
			$this->db->where_in('divisions.division_id',$division_list);
		}
		if($this->input->post('month') && $this->input->post('year')){
			$month=$this->input->post('month');
			$year=$this->input->post('year');
			$year_start=date("Y-m-d",strtotime("April 1 $year"));
			$year_current=date("Y-m-t",strtotime("1 ".date("M", mktime(0, 0, 0, $month+1, 0, 0))." ".$year));
			if($year_current>=$year_start){ 
				$year_start=date("Y-m-01",strtotime($year_start)); 
				$year_end=date("Y-m-t",strtotime("March 31 $year + 1year"));
			}
			else { 
				$year_start=date("Y-m-01",strtotime("April 1 $year previous year")); 
				$year_end=date("Y-m-t",strtotime("March 31 $year"));
			}
		}
		else{
			$month="MONTH(CURDATE())";
			$year="YEAR(CURDATE())";
		}
		if($this->input->post('agreement_filter')){
			if($this->input->post('agreement_filter')=="in") {
				$this->db->where('agreement_date != 0');
				$this->db->where('agreement_completion_date !=0');
				$this->db->having('((completion_date != "" AND completion_date >= "'.date("Y-m-d").'") OR (completion_date ="" AND agreement_completion_date >= "'.date("Y-m-d").'"))');			
			}
			else{
				$this->db->where('final_bill',0);
				$this->db->where('agreement_date !=0 ');
				$this->db->where('agreement_completion_date !=0');
				$this->db->having('((completion_date != "" AND completion_date < "'.date("Y-m-d").'") OR (completion_date ="" AND agreement_completion_date < "'.date("Y-m-d").'"))');			
			}
		}
		if($this->input->post('status_filter')){
			$this->db->where('status_types.status_type_id',$this->input->post('status_filter'));
		}
		if($this->input->post('cumilative_report')==='0'){
			$this->db->where("IF(final_bill=1,IF(final_bill_date>='$year_start' AND final_bill_date<='$year_end',1,0),1)");
		}
		$this->db->select("expense_upto_last_year,expense_upto_last_month,expense_current_month,expenses, road_length_target, road_length_completed,
		target_upto_last_month,target_current_month,targets,pending_bills,COUNT(image_id) image_count,
		IFNULL(extension_date,'') completion_date,projects.*,districts.*,
		divisions.*,grant_phase.*,project_status.*,sanctions.*,status_types.*,work_stages.stage_id,
		work_stages.stage,work_stages.status_type_id as status_id,agency.*,user_departments.*,projects.staff_id,CONCAT(IF(first_name!='',first_name,''),' ',IF(last_name!='',last_name,'')) staff_name,
		designation, work_type,sanction_type, agency.agency_name, category1.category_name category1_name, category2.category_name category2_name,
		category1_id, category2_id, projects.mandal_id, projects.assembly_constituency_id, projects.parliament_constituency_id, projects.district_id,
		parliament_constituency, mandal, assembly_constituency",false);
		$this->db->from("projects")
		->join('category1', 'projects.category1_id=category1.category_id','left')
		->join('category2', 'projects.category2_id=category2.category_id','left')
		->join('mandal', 'projects.mandal_id=mandal.mandal_id','left')
		->join('assembly_constituency', 'projects.assembly_constituency_id=assembly_constituency.assembly_constituency_id','left')
		->join('parliament_constituency', 'projects.parliament_constituency_id=parliament_constituency.parliament_constituency_id','left')
		->join('work_type','projects.work_type_id=work_type.work_type_id','left')
		->join('sanction_type','projects.sanction_type_id=sanction_type.sanction_type_id','left')
		->join('agency','projects.agency_id=agency.agency_id','left')
		->join('staff','projects.staff_id=staff.staff_id','left')
		->join('project_status','projects.project_id=project_status.project_id','left')
		->join('project_images','projects.project_id=project_images.project_id','left')
		->join('status_types','project_status.status_type_id=status_types.status_type_id','left')
		->join('work_stages','project_status.stage_id=work_stages.stage_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		// ->join('facilities','projects.facility_id=facilities.facility_id','left')
		// ->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id','left')
		->join('divisions','projects.division_id=divisions.division_id','left')
		->join('districts','projects.district_id=districts.district_id','left')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id','left')
		->join('user_departments','projects.user_department_id=user_departments.user_department_id','left')
		->join("(SELECT project_id,
		SUM(CASE WHEN project_expenses.expense_date<'$year_start'  THEN expense_amount ELSE 0 END) expense_upto_last_year,
		SUM(CASE WHEN ((month(project_expenses.expense_date)<$month AND YEAR(project_expenses.expense_date)=$year) OR (YEAR(project_expenses.expense_date)<$year))
		AND expense_date>='$year_start'  THEN expense_amount ELSE 0 END) expense_upto_last_month,
		SUM(CASE WHEN month(project_expenses.expense_date)=$month AND YEAR(project_expenses.expense_date)=$year THEN expense_amount ELSE 0 END) expense_current_month,
		SUM(CASE WHEN (month(project_expenses.expense_date)<=$month AND YEAR(project_expenses.expense_date)<=$year) OR (YEAR(project_expenses.expense_date)<$year) THEN expense_amount ELSE 0 END) expenses
		FROM project_expenses GROUP BY project_id) table_expenses",'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id,SUM(CASE WHEN ((month(project_targets.projection_month)<$month AND YEAR(project_targets.projection_month)=$year) OR (YEAR(projection_month)<$year)) AND projection_month>='$year_start'  THEN target_amount ELSE 0 END) target_upto_last_month,
		SUM(CASE WHEN month(project_targets.projection_month)=$month AND YEAR(project_targets.projection_month)=$year THEN target_amount ELSE 0 END) target_current_month,
		SUM(CASE WHEN projection_month >= '$year_start' AND projection_month<='$year_end' THEN target_amount ELSE 0 END) targets 
		FROM project_targets WHERE current=1 GROUP BY project_id) table_targets",'projects.project_id=table_targets.project_id','left')
		->join("(SELECT project_id, 
			 SUM(bill_amount) pending_bills
			 FROM project_bills WHERE active=1  GROUP BY project_id) table_bills" ,'projects.project_id=table_bills.project_id','left')
		->join("(SELECT project_id, 
			MAX(extension_date) extension_date
			 FROM project_extension WHERE active=1 GROUP BY project_id ORDER BY extension_date) table_extensions" ,'projects.project_id=table_extensions.project_id','left')
		;
		$this->db->where("admin_sanction_date <= '$year_current'");
		$this->db->group_by('projects.project_id')
		->order_by('tech_sanction_amount','DESC');
		$this->db->where('project_status.current',1);
		
		if($this->input->post('filter') && $this->input->post('filter')!=""){
			if($this->input->post('filter')=="TS0"){
				$this->db->where('tech_sanction_amount',0);
			}
			if($this->input->post('filter')=="AGT0"){
				$this->db->where('agreement_amount',0);
			}
			if($this->input->post('filter')=="EXP0"){
				$this->db->where('expense_upto_last_month',0);
			}
		}
		if($query=$this->db->get()){
			return $query->result();
		}
		else{ return false;}
	}
	
	function create_user(){
		$data=array(
		'username'=>$this->input->post('username'),
		'password'=>md5($this->input->post('password')),
		'staff_id'=>$this->input->post('staff')
		);

		$this->db->trans_start();
		$this->db->insert('users',$data);
		$user_id=$this->db->insert_id();
		$user_function=$this->input->post('user_function');
		$division=$this->input->post('division');
		$user_department=$this->input->post('user_department');
		$user_function_data=array();
		$user_division_data=array();
		$user_department_data=array();
		if(count($user_function)>0){
			foreach($user_function as $u){
				$add=0;
				$edit=0;
				$view=0;
				if($this->input->post($u)){
					foreach($this->input->post($u) as $access){
						if($access=="add") $add=1;
						if($access=="edit") $edit=1;
						if($access=="view") $view=1;
					}
					$user_function_data[]=array(
						'user_id'=>$user_id,
						'function_id'=>$u,
						'add'=>$add,
						'edit'=>$edit,
						'view'=>$view
					);
				}
			}
			$this->db->insert_batch('user_function_link',$user_function_data);
		}
		if(count($division)>0){
		foreach($division as $d){

				$user_division_data[]=array(
					'user_id'=>$user_id,
					'division_id'=>$d
				);
		}
			$this->db->insert_batch('user_division_link',$user_division_data);
		}
		if(count($state)>0){
		foreach($state as $s){

				$user_state_data[]=array(
					'user_id'=>$user_id,
					'state_id'=>$s
				);
		}
			$this->db->insert_batch('user_state_link',$user_state_data);
		}
		if(!!$user_department){
		foreach($user_department as $u){

				$user_department_data[]=array(
					'user_id'=>$user_id,
					'user_department_id'=>$u
				);
		}
		$this->db->insert_batch('user_department_link',$user_department_data);
		}
		$this->db->trans_complete();
		if($this->db->trans_status()===TRUE) return true; else return false;
	}	
        
	function get_ho_pendency(){
		$this->db->select('*')->from('ho_pendency')->where('active',1);
		$query=$this->db->get();
		return $query->result();
	}
}
?>
