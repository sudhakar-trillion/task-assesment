<?PHP
class Commonmodel extends CI_Model
{
	public function checkexists($table,$cond)
	{
		$this->db->where($cond);
		$qry = $this->db->get($table);
		if($qry->num_rows()>0)
			return $qry->num_rows();
		else
			return "0";
		
	}
	
	
	public function getnumRows($table,$cond)	
	{
		$this->db->where($cond)	;
		
		$qry = $this->db->get($table);
		return  $qry->num_rows();
	}
	
	public function getRows_fields($table,$cond,$fields,$order_by,$order_by_field,$limit)
	{
		$this->db->select($fields);
		$this->db->from($table);
		
		if( sizeof($cond) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit(10,$limit);
		}
		$qry = $this->db->get('');
		
		if($qry->num_rows()>0)
		{
			return $qry;		
		}
		else
			return "0";
		
	}
	
	
	public function getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='')
	{
		$this->db->select($field);
		$this->db->from($table);
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		$qry = $this->db->get('');
		if($qry->num_rows()>0)
		{
			return $qry->row($field);			
		}else
			return "0";
		
	}
	public function getrows($table,$cond,$order_by='',$order_by_field='',$limit='')
	{
		
		
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		
		$qry = $this->db->get($table);
		if($qry->num_rows()>0)
		return $qry;
		else	
		return "0";
		
	}
	
	
	public function get_single_row($table,$cond,$order_by='',$order_by_field='',$limit='')
	{
		
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		
		$qry = $this->db->get($table);
//		echo $this->db->last_query(); exit; 
		
		if($qry->num_rows()>0)
		return $qry;
		else	
		return "0";
	
	}
	
	public function insertdata($table,$data)
	{
		$this->db->insert($table,$data)	;
		return $this->db->insert_id();
		
	}
	
	
	public function updatedata($table,$data,$cond)	
	{
		$this->db->where($cond);
		$this->db->update($table,$data);
		return $this->db->affected_rows(); exit; 
//		echo $this->db->last_query(); exit; 
		if($this->db->affected_rows()>0)
			return "1";
		else
			return "0";
	}
	
	public function deleterow($table,$cond)
{
	$this->db->delete($table,$cond);
	return "1";	
}
	
	public function getsmtpdetails()
	{
			$this->db->select('user,password');
			$this->db->from('smtp_details');
			$this->db->limit(1);
			$qry = $this->db->get();

			if($qry->num_rows()>0)
				return $qry;
			else
				return "0";
		
					
	}
	
	public function getkeydetails($cond)
	{
		
			$this->db->select('EncKey');
			$this->db->from('getkeys');
			$this->db->where($cond);
			$this->db->limit(1);
			$qry = $this->db->get();

			if($qry->num_rows()>0)
				return $qry;
			else
				return "0";
	}



//general pagination 

	public function paginate($table,$cond,$order_by='',$order_by_field='',$limit,$start )
	{
		
		$this->db->select('*');
		$this->db->from($table);
		
		if( sizeof($cond) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit,$start);
		}
		$qry = $this->db->get('');

		
		if($qry->num_rows()>0)
		{
			return $qry;		
		}
		else
			return "0";
		
		
	}

//general pagination ends here


//assignedteacherPaginateion starts here

	public function assignedteacherPaginateion($cond,$order_by='SLNO',$order_by_field,$limit,$start )
	{
		
		$this->db->select('assign.SLNO,cls.ClassName,Sec.Section,sub.SubjectName as Subject, tec.TeacherName');
		$this->db->from('assignteachers as assign');
		$this->db->join('newclass as cls','cls.SLNO=assign.ClassSlno');
		$this->db->join('sections as Sec','Sec.SectionId=assign.Section');
		$this->db->join('teacher as tec','tec.TeacherId=assign.TeacherId');
		$this->db->join('subjects as sub','sub.SubjectId=assign.Subject');
		
		if(!empty($cond))
			$this->db->where($cond);
		
		$this->db->limit($limit,$start);
		
		$qry = $this->db->get();
			
			//return $this->CI->db->last_query();
			if($qry->num_rows()>0)
				return $qry;
			else
				return '0';	
		
		
	}
	
//assignedteacherPaginateion ends here


//studentsPaginateion starts here

	public function studentsPaginateion($cond,$order_by,$order_by_field,$limit,$start )
	{
		
		$this->db->select('std.StudentId,std.Student,std.AcademicYear,std.Roll,cls.ClassName,Sec.Section');
		$this->db->from('students as std');
		$this->db->join('newclass as cls','cls.SLNO=std.ClassName');
		$this->db->join('sections as Sec','Sec.SectionId=std.ClassSection');
		
		$order_by_field.=',ClassSection';
		
		if(!empty($cond))
			$this->db->where($cond);
		$this->db->order_by($order_by_field,$order_by);

		$this->db->limit($limit,$start);
		
		$qry = $this->db->get();
		#echo $this->db->last_query(); exit;
			
			//return $this->CI->db->last_query();
			if($qry->num_rows()>0)
				return $qry;
			else
				return '0';	
		
		
	}
	
//studentsPaginateion ends here


//feestructurepagination starts here

	public function feestructurepagination($cond,$order_by,$order_by_field,$limit,$start)
	{
		$this->db->select("sch.*, cls.ClassName");
		$this->db->from('schoolfee as sch');
		$this->db->join('newclass as cls','cls.SLNO=sch.Class');
		if(!empty($cond))
			$this->db->where($cond);
		$this->db->order_by($order_by_field,$order_by);

		$this->db->limit($limit,$start);

		$qry = $this->db->get();

		
		if($qry->num_rows()>0)
				return $qry;
			else
				return '0';	
		
	}

//feestructurepagination ends here

//notifstudentspagination starts here

public function notifstudentspagination($cond,$order_by='DESC',$order_by_field,$limit,$start,$AddedBy )
{
	
	$this->db->select('noti.NotificationId, cls.ClassName,sec.Section,CONCAT(std.Student,"", std.LastName) as StudentName,noti.Notification, date_format(DATE(noti.AddedOn),"%d-%m-%Y") as AddedOn, noti.Status ');
	$this->db->from('notifications as noti');
	$this->db->join('newclass as cls','cls.SLNO=noti.ClassName');
	$this->db->join('sections as sec','sec.SectionId=noti.ClassSection');
	$this->db->join('students as std','std.StudentId=noti.StudentId');
	
	if(!empty($cond))
			$this->db->where($cond);
			
	$this->db->where('noti.AddedBy',$AddedBy);
			
		$this->db->order_by($order_by_field,$order_by);

		$this->db->limit($limit,$start);
		$qry = $this->db->get();
	
		if($qry->num_rows()>0)
			return $qry;
		else
			return '0';	

}

//notifstudentspagination ends here

//viewassignedsubjectspagination starts here

public function viewassignedsubjectspagination($cond,$order_by='ASC',$order_by_field,$limit,$start)
{
	$this->db->select("assign.AssignedId,cls.ClassName,assign.ClassSlno, sub.SubjectName");
	$this->db->from('assignedsubjects as assign');
	$this->db->join('newclass as cls','cls.SLNO=assign.ClassSlno');
	$this->db->join('subjects as sub','sub.SubjectId=assign.SubjectAssigned');
	
	if(!empty($cond))
			$this->db->where($cond);
			
		$this->db->order_by($order_by_field,$order_by);

		$this->db->limit($limit,$start);
		$qry = $this->db->get();
	
		if($qry->num_rows()>0)
			return $qry;
		else
			return '0';	
	
	
}

//viewassignedsubjectspagination ends here


//viewhomeworkspagination starts here

	public function viewhomeworkspagination($cond,$order_by='DESC',$order_by_field,$limit,$start)
	{
		
		$this->db->select('hw.HomeWork, hw.Status, date_format(hw.HomeWorkOn,"%d-%m-%Y") as HomeWorkOn, hw.HomeworkId, cls.ClassName, sec.Section, CONCAT(std.Student," ", std.LastName) as Student, sub.SubjectName');		
		$this->db->from(' homeworks as hw');	
		$this->db->join('newclass as cls','cls.SLNO=hw.ClassSlno');
		$this->db->join('sections as sec','sec.SectionId=hw.ClassSection');
		$this->db->join('students as std','std.StudentId=hw.StudentId');
		$this->db->join('subjects as sub','sub.SubjectId=hw.SubjectId');		
		if(!empty($cond))
			$this->db->where($cond);
			
		$this->db->order_by($order_by_field,$order_by);

		$this->db->limit($limit,$start);
		$qry = $this->db->get();
	
		if($qry->num_rows()>0)
			return $qry;
		else
			return '0';	
		
	}


//viewhomeworkspagination ends here

//viewstudentactivitypagination starts here

	public function viewstudentactivitypagination($cond,$order_by='DESC',$order_by_field,$limit,$start)
	{
			$this->db->select('sactiv.ActivityId, sactiv.ActivityTitle, date_format(sactiv.ActivityDate,"%d-%m-%Y") as ActivityDate,cls.ClassName, sec.Section, CONCAT(std.Student," ", std.LastName) as Student ');		
		$this->db->from(' studentactivities as sactiv');	
		$this->db->join('newclass as cls','cls.SLNO=sactiv.ClassSlno');
		$this->db->join('sections as sec','sec.SectionId=sactiv.ClassSection');
		$this->db->join('students as std','std.StudentId=sactiv.StudentId');

		if(!empty($cond))
			$this->db->where($cond);
			
		$this->db->order_by($order_by_field,$order_by);

		$this->db->limit($limit,$start);
		$qry = $this->db->get();
	
		if($qry->num_rows()>0)
			return $qry;
		else
			return '0';	
		
	}
	
//viewstudentactivitypagination ends here


//getArchieveEvents starts here

	public function getArchieveEvents()
	{
		$cond = array();
		$event_lists = array();
		
		$cond['StudentId'] = $this->session->userdata('StudentId');
		$table = 'students';
		
		$ClassSlno = $this->getAfield($table,$cond,$field='ClassName',$order_by='',$order_by_field='',$limit='');
		$ClassSection = $this->getAfield($table,$cond,$field='ClassSection',$order_by='',$order_by_field='',$limit='');
		
		
		$cond = array();
		$event_lists = array();
		
		$cond['StudentId'] = $this->session->userdata('StudentId');
		$cond['ClassSlno'] = $ClassSlno;
		$cond['ClassSection'] = $ClassSection;
		
		
		$this->db->select('ActivityId,MONTHNAME(ActivityDate) as Mnth,ActivityTitle, date_format(ActivityDate,"%m-%Y") as monthyear' );
		$this->db->from('studentactivities');
		$this->db->where($cond);
		$qry = $this->db->get();
		
		
		if($qry->num_rows()>0)
		{
			$month="test";
			$event_lists['Events_exists']= 'Yes';
			foreach($qry->result() as $event)
			{
				
				if( $event->Mnth==$month )
				{
					
				}
				else
				{
					$month = $event->Mnth;
				}
				$event_lists['Event'][$month][] = array(
														"EventName"=>ucwords($event->ActivityTitle),
														"ActivityId"=>$event->ActivityId
														);
				
				
				
			}
		}
		else
			$event_lists['Events_exists']= 'No';
		
		//echo json_encode($event_lists);
		return $event_lists;

	}
//getArchieveEvents ends here

//getLatestPics starts here

	public function getLatestPics()
	{
		
		$cond = array();
		$event_lists = array();
		
		$cond['StudentId'] = $this->session->userdata('StudentId');
		$table = 'students';
		
		$ClassSlno = $this->getAfield($table,$cond,$field='ClassName',$order_by='',$order_by_field='',$limit='');
		$ClassSection = $this->getAfield($table,$cond,$field='ClassSection',$order_by='',$order_by_field='',$limit='');
		
		
		$cond = array();
		$event_lists = array();
		
		$cond['StudentId'] = $this->session->userdata('StudentId');
		$cond['ClassSlno'] = $ClassSlno;
		$cond['ClassSection'] = $ClassSection;
		
		
		$this->db->select('ActivityId, date_format(ActivityDate,"%m-%Y") as monthyear' );
		$this->db->from('studentactivities');
		$this->db->where($cond);
		$this->db->order_by('MONTH(ActivityDate)','DESC');

		$this->db->limit(1);
		$qry = $this->db->get();
		if($qry->num_rows()>0)
		{
			$ActivityId='';
			$monthyear='';
			
			foreach($qry->result() as $eventdetails)
			{
				$ActivityId = $eventdetails->ActivityId;
				$monthyear = $eventdetails->monthyear;
			}
			
			
			$cond= array();
			$table='activitypics';
			
			$cond['ActivityId'] = $ActivityId;
			$fields = 'Picture';
			
			$eventpics = $this->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='ActivityPicId',$limit='');
			if($eventpics!='0')
				return $eventpics;
			else
				return "0";
			
		}
		else
		{
			return "0";	
		}
		
			
	}

//getLatestPics ends here




}

?>