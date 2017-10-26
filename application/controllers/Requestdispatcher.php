<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requestdispatcher extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata'); 
		$this->load->model('commonmodel');	
	}
	
	
	
	public function striptags($posted_data)
		{
			
			$requested_from =  $_SERVER['HTTP_REFERER'];
		if( strpos($requested_from, 'localhost/task-assesment') !== false )
			{
				foreach($posted_data as $key=>$val) 
				{ 
					$str = stripslashes(str_replace("'","",$val));
					$_POST[$key] = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
				}
				return $_POST;	
			}
			else
				echo "!!!! Access denied !!!!"; exit; 
		
		
		}
	
//get task starts here

	public function gettask()
	{
			$postdata = $this->striptags($_POST);
			extract($postdata);
			
			$cond = array();
			$table = 'tasks';
			
			$cond['TaskId'] = $id;
			
			if($this->commonmodel->checkexists($table,$cond))
			{
				$field='Task';
				$order_by='';
				$order_by_field='';
				$limit='';
				$task = $this->commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
				echo "<p>".$task."</p>";
				
			}
			else
				echo "Sorry invalid request";
	}
	
	//gettask ends here 

	public function deletetask()
	{
			$postdata = $this->striptags($_POST);
			extract($postdata);
			
			$cond = array();
			$table = 'tasks';
			
			$cond['TaskId'] = $id;
			
			
			if($this->commonmodel->checkexists($table,$cond))
			{
				if( $this->commonmodel->deleterow($table,$cond) )
					echo "1";
				else
					echo "0";
				
				
			}
			else
				echo "-1";
			
			
	}
	
}//controller ends here
