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
    <link rel="shortcut icon" href="img/favicon.png">
	
    <title>Admin Login</title>

    <!-- Bootstrap CSS -->    
    <link href="resources/template-assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="resources/template-assets/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="resources/template-assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="resources/template-assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="resources/template-assets/css/style.css" rel="stylesheet">
    <link href="resources/template-assets/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link href="resources/custom-assests/css/style.css" rel="stylesheet">
</head>

  <body >

    <div class="container">

      <form class="login-form" action="" method="post">        
			<h3 style="text-align:center; padding-top:10px">
         <?PHP echo @$this->session->flashdata('invalidCredentials');?>
            </h3>
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="User Id" name="userid" value="<?PHP echo set_value('userid')?>">
             
            </div>
             <span class="err-msg"><?PHP echo form_error('userid');?> </span>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
             <span class="err-msg"><?PHP echo form_error('password');?></span>
           
            <input class="btn btn-primary btn-lg btn-block" name="adminlogin" type="submit" value="Login">

        </div>
      </form>
    
    
    </div>


  </body>
</html>
