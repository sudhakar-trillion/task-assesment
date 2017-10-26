<?PHP include('header.php'); ?>
<section id="main-content">
  <section class="wrapper">  
 <div class="row">
				<div class="col-lg-12">
                
                <ol class="breadcrumb">

                        <li><i class="fa fa-home"></i> <a href="<?PHP echo base_url('add-task');?> ">Add task </a></li>
						<li><i ></i>View tasks</li>						  	
					</ol>
                
                </div>
			</div>

	<div class="row">
  
                  <div class="col-lg-12">
                 	
                    
                    
                    
                      <section class="panel">
                         
                          <header class="panel-heading">
                              View tasks
                          </header>
                          
         
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                           <tr>
                                <th>SLNO</th>
                                 <th><i class="icon_profile"></i> Task</th>
                                 <th><i class="icon_calendar"></i> Schedule At</th>
                                 <th><i class="icon_mail_alt"></i> Status</th>
                               <th><i class="icon_cogs"></i> Actions</th>
                              </tr>
                           <?PHP
						   $slno=0;
						   if($this->uri->segment(2)) { $slno = ($this->uri->segment(2)-1)*$perpage;	}
						   foreach($tasks->result() as $task)
								{
									
									$slno++;	
										
									$bookdate = date("d-m-Y");
						   ?>
                           
                              
                              <tr class="data-row">
                              <td class="SLNO"><?PHP echo $slno; ?> </td>
                                 <td><a style="cursor:pointer" class="view-task" id="<?PHP echo $task->TaskId; ?>" data-toggle="modal" data-target="#myModal"> <?PHP echo substr($task->Task,0,100).'...'; ?></a></td>
                                 <td><?PHP echo $task->ScheduledAt; ?></td>
                                 <td><?PHP echo $task->Status?></td>
                                
                                  
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="<?PHP echo base_url('edit-task/').$task->TaskId?>" style="margin-right:4px"><i class="icon_pencil-edit_alt"></i></a>
                                
                                     <a class="btn btn-danger delete_task" deltask='<?PHP echo $task->TaskId; ?>' ><i class="icon_close_alt2 "></i></a>	
                                      
                                  </div>
                                  </td>
                                  
                              </tr>
                              
                              
                              
                              
                              <?PHP 
							  		
									}//foreach ends here
									?>
                                    <tr>
                              		<td colspan="8"><?PHP echo $pagination_string;?> </td>
                              </tr>
							
                                                           
                           </tbody>
                        </table>
                          
                          
                      </section>
                  </div>
              </div>          
              
</section          
      ></section>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Task description</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  