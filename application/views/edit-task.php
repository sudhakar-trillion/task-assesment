<?PHP include('header.php');?>
<section id="main-content">
  <section class="wrapper">  
 <div class="row">
				<div class="col-lg-12">
                
                <ol class="breadcrumb">

						  <li><i class="fa fa-home"></i> <a href="<?PHP echo base_url('add-task');?> ">Add task </a></li>
						<li><i class="fa fa-desktop"></i> <a href="<?PHP echo base_url('view-tasks');?> ">View tasks </a></li>	
                        <li><i ></i>Edit task</li>						  	
					</ol>
                
                </div>
			</div>

	<div class="row">
  
                  <div class="col-lg-12">
                 
                      <section class="panel">
                          <header class="panel-heading">
                            Edit task
                          </header>
                          <div class="panel-body">
                          <?PHP
						  	if($this->input->post('edittask'))
							{
									$Task = $this->input->post('Task');	

									$ScheduledAt = $this->input->post('ScheduledAt');	
									$Status=$this->input->post('Status');
							}
							else
							{
								foreach($task->result() as $tsk)	
								{
									$Task = $tsk->Task;	
									$ScheduledAt = date_create($tsk->ScheduledAt);
									$ScheduledAt = date_format($ScheduledAt,'d-m-Y');	
									$Status=$tsk->Status;
								}
							}
						  ?>
                          
                          
                             <?PHP echo @$this->session->flashdata('task-updated');	 ?>
                              <div class="form col-lg-9">
                                  <form class="form-validate form-horizontal " id="register_form" method="post" action="">
                                      
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-4">Task<span class="required">*</span></label>
                                          <div class="col-lg-6">
                                             <textarea class=" form-control" id="Task" name="Task"><?PHP echo $Task; ?> </textarea>
                                          </div>
                                           <div class="col-lg-2 err-msg"><span><?PHP echo form_error('Task');?></span> </div>
                                      </div>
                                      
                                     
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-4">Schedule at<span class="required">*</span></label>
                                          <div class="col-lg-6">
<input class=" form-control " id="bookingdate" name="ScheduledAt" type="text" value="<?PHP echo $ScheduledAt; ?>" />
                                          </div>
                                           <div class="col-lg-2 err-msg"><span><?PHP echo form_error('ScheduledAt');?></span> </div>
                                      </div>
                                      
                                       <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-4">Status<span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          
													<select name="Status" class="form-control">
                                                    	<option value="0" <?PHP if( $Status=='0'){ echo 'selected';}?> >Select Status  </option>
                                                        <option value="Active" <?PHP if($Status=='Active'){ echo 'selected';}?>>Active </option>
                                                        <option value="Inactive" <?PHP if($Status=='Inactive'){ echo 'selected';}?> >Inactive </option>
                                                        
                                                        
                                                    </select>
                                          </div>
                                           <div class="col-lg-2 err-msg"><span><?PHP echo form_error('Status');?></span> </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-4 col-lg-8">
                                             
                                             <input type="submit" class="btn btn-primary " value="Update " name="edittask" />
                                           
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>          
              
</section          
      ></section>
      