<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="<?PHP echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">

    <title>Task scheduling </title>

    <!-- Bootstrap CSS -->    
    <link href="resources/template-assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="resources/template-assets/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="resources/template-assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="resources/template-assets/css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <!-- owl carousel -->
    <!-- Custom styles -->
    <link href="resources/template-assets/css/style.css" rel="stylesheet">
    <link href="resources/template-assets/css/style-responsive.css" rel="stylesheet" />

    <!-- =======================================================
        Theme Name: NiceAdmin
        Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
    
        <link rel="stylesheet" href="resources/custom-assests/css/jquery-ui.css" />

<style>
.ui-state-default { text-align:center!important; }
.ui-datepicker td  { padding:5px!important;}
.err-msg{color:red;}
.required{color:red!important;}

.ui-datepicker-today
{
    background: rgba(255, 152, 0, 0.18) !important;
    border-radius: 50% !important;	
}

.filtersection div
{
	margin:10px !important;

}
.filtersection
{
	margin-bottom:0px !important;
}

.doc_details
{
	
	margin-top:30px;
	border-top:2px solid rgba(167, 172, 178, 0.23);
	padding-top:15px;
	display:none;

}

.doc_details .doc_child{
	margin-bottom:10px;
}


.err-border{border:1px solid #F00;}
#ui-datepicker-div{ z-index:22 !important;}
</style>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a class="logo">Task <span class="lite">Scheduling</span></a>
            <!--logo end-->

            

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                  
                  
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                               <!-- <img alt="" src="resources/template-assets/img/avatar1_small.jpg">-->
                                <i class="fa fa-user"></i>
                            </span>
                            <span class="username"><?PHP echo $this->session->userdata('LoginId');?></span>
                            <b class="caret"></b>
                        </a>

                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            
                            <li class="eborder-top">
                                <a href="<?PHP echo base_url('logout.php')?>"><i class="icon_profile"></i> Logout</a>
                            </li>
                          
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                

				           <li><a class="" href="<?PHP echo base_url('add-task')?>"><i class="fa fa-plus"></i>Add task </a></li>
                          <li><a class="" href="<?PHP echo base_url('view-tasks')?>"><i class="fa fa-desktop"></i>View tasks</a></li>
                  
                  
                  
                
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
