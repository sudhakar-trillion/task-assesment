<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taskassesment extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata'); 
		
		$this->load->model('commonmodel');
		
		$FirstUriSegement = $this->uri->segment(1);
		
		if($FirstUriSegement=='')
		{
			if( $this->session->userdata('LoginId')!='' && $this->session->userdata('SLNO')>0 )	
				redirect( base_url('add-task') );
		}
		else
		{
			
			if( $this->session->userdata('LoginId')=='' || $this->session->userdata('SLNO')=='' )	
				redirect( base_url('') );
		}
		
		define('HEADER','header');
		define('FOOTER','footer');
		
			
	}
	public function index()
	{
		if($this->input->post('adminlogin'))
		{
			$this->form_validation->set_rules( $this->config->item('adminlogin') );
			
			if($this->form_validation->run()===false)
				$this->load->view('login');
			else
			{
				
				$table='logins';
				$cond= array();
				
				$cond['LoginId'] = $this->input->post('userid');
				$cond['Password'] = md5($this->input->post('password'));
				
				$exists = $this->commonmodel->checkexists($table,$cond);

				if($exists>0)
				{
					$field='Slno';$order_by='';$order_by_field='';$limit='';
					
					$Slno = $this->commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
					$this->session->set_userdata('SLNO',$Slno);
					$this->session->set_userdata('LoginId',$this->input->post('userid'));
					
					redirect( base_url('add-task') );
					
						
				}
				else
				{
					$msg = "<div class='alert alert-danger'>Check your login credentials </div>";	
					$this->session->set_flashdata('invalidCredentials',$msg);
					redirect(base_url());
				}
				
				
			}
		}
		else
			$this->load->view('login');
		
		
	}// index ends here
	
	public function addtask()
	{
		$this->load->view(HEADER);
		
		if( $this->input->post('addnewtask') )
		{
			$this->form_validation->set_rules( $this->config->item('addtask'));
			
			if( $this->form_validation->run() === false ) 
				$this->load->view('add-task');
			else
			{
				$table = 'tasks';
				
				$insertdata = array();
				

				$insertdata['Task'] = $this->input->post('Task');
				$insertdata['Status'] = $this->input->post('Status');
				$ScheduledAt = date_create($this->input->post('ScheduledAt'));
				$ScheduledAt = date_format($ScheduledAt,"Y-m-d");
				
				$insertdata['ScheduledAt'] = $ScheduledAt;
				$insertdata['LastUpdate'] = time();
				
				if( $this->commonmodel->insertdata($table,$insertdata))
				{
					$msg = "<div class='alert alert-success'> New task added successfully</div>";
					$this->session->set_flashdata('task-success',$msg);
					
				}
				else
				{
					$msg = "<div class='alert alert-danger'>Unable to add new task </div>";
					$this->session->set_flashdata('task-success',$msg);
				}
				
				redirect(base_url('add-task'));
				
				
			}
			
			
		}
		else		
			$this->load->view('add-task');
			
			
		$this->load->view(FOOTER);
	}//add tasks ends here
	
	
	public function viewtasks()
	{
		$this->load->view(HEADER);
		
		$table='tasks as ts'; 
		$cond=array();
		
		//$cond['Status'] = 'Assigned';
		
		$baseurl='view-tasks';
		$perpage=10;
		$order_by_field='TaskId';
		$datastring='tasks';
		$pagination_string = 'pagination_string';
		
		
		//$table,$cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string
		$data = $this->tsmpaginate->singletablePaginateion($table,$cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string);

		$data['perpage']= $perpage;
		$this->load->view('view-tasks',$data);
		
		$this->load->view(FOOTER);	
	} //view task ends here
	
	public function edittask()
	{
		$this->load->view(HEADER);	

		$cond = array();
		$table='tasks';
		
		$cond['TaskId'] = $this->uri->segment(2);
		
		if( $this->commonmodel->checkexists($table,$cond))
		{
			
			$fields='*';
			$order_by='';
			$order_by_field='';
			$limit='';
			
			$data['task'] = $this->commonmodel->getRows_fields($table,$cond,$fields,$order_by,$order_by_field,$limit);
			
			
			if( $this->input->post('edittask') )
			{
				$this->form_validation->set_rules( $this->config->item('edittask'));
				
				if( $this->form_validation->run() === false ) 
					$this->load->view('edit-task',$data);
				else
				{
					
					$table = 'tasks';
					$setdata = array();
					
					$cond = array();
					
					$cond['TaskId'] = $this->uri->segment(2);
					
					$setdata['Task'] = $this->input->post('Task');
					
					$ScheduleAt = date_create($this->input->post('ScheduledAt'));
					$ScheduleAt = date_format($ScheduleAt,"Y-m-d");
					
					$setdata['ScheduledAt'] = $ScheduleAt;
					
					$setdata['Status'] = $this->input->post('Status');
					$setdata['LastUpdate'] = time();
					
					if( $this->commonmodel->updatedata($table,$setdata,$cond))
					{
						$msg = "<div class='alert alert-success'>Task updated successfully </div>";
						$this->session->set_flashdata('task-updated',$msg);
					}
					else
					{
						$msg = "<div class='alert alert-danger'>Unable to updated successfully </div>";
						$this->session->set_flashdata('task-updated',$msg);
					}
					redirect(base_url('edit-task/').$this->uri->segment(2));
					
				}
			}
			else
					$this->load->view('edit-task',$data);	
		}
		else
		{
			$data['routeto'] = 'view-tasks';
			$this->load->view('page-not-found',$data);			
		}
		
		
		
		
		$this->load->view(FOOTER);	
			
	}


//callback function starts here

public function checkstatus($status)
{

	if( $status=='0')
	{
		$this->form_validation->set_message('checkstatus','Select Status');
		return false;
	}
	else
	{
		$this->form_validation->set_message('checkstatus','');
		return true;
	}
	

} 

//callback functions ends here

}//controller ends here
