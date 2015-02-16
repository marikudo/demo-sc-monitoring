<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Open Task</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?=base_url()?>media/bootstrap-3.2.0/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>media/fonts/font.css" rel="stylesheet">
    <link href="<?=base_url()?>media/font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="<?=base_url()?>media/css/styles.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-fixed-top header">
  <div class="col-md-12">
        <div class="navbar-header">
          
          <a href="#" class="navbar-brand brand-name">Open Task</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1">
          <i class="glyphicon glyphicon-search"></i>
          </button>
      
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse1">
          <form class="navbar-form pull-left">
              <div class="input-group" style="max-width:470px;">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="http://www.bootply.com" target="_ext">Bootply+</a></li>
             <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><span class="badge pull-right">40</span>Link</a></li>
                  <li><a href="#"><span class="badge pull-right">2</span>Link</a></li>
                  <li><a href="#"><span class="badge pull-right">0</span>Link</a></li>
                  <li><a href="#"><span class="label label-info pull-right">1</span>Link</a></li>
                  <li><a href="#"><span class="badge pull-right">13</span>Link</a></li>
                </ul>
             </li>
             <li><a href="#" id="btnToggle"><i class="glyphicon glyphicon-th-large"></i></a></li>
             <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
           </ul>
        </div>  
     </div> 
</nav>

<div class="main">
  <div class="pull-left padding-top" id="left-sm-panel">
    <div class="welcome left-inner" style="background:#fff">
      <p >Welcome, Red</p>
    </div>
    <div class="left-inner left-menu" style="background:#fff">
      <div class="menu-container">
        <ul>
          <li><a href="#">Add New Project</a></li>
          <li><a href="#">Create New Task</a></li>
        </ul>
      </div>
    </div>

     <div class="left-inner left-menu" style="background:#fff">
      <div class="menu-container">
        <h3>Quick Help</h3>
        <p>Click Add new project to add project and create your task</p>
      </div>
    </div>

  </div>
  <div class="pull-left padding-top" id="project-container">
    <h4>Projects</h4>
    <div class="project-action">
      <a href="#refresh-project"><i class="fa fa-refresh"></i></a>
      <a href="#add-project"><i class="fa fa-plus"></i></a>
    </div>
      <div class="project">
        <h3>Jun, 2, 2014</h3>
        <h2>Lorem Ipsum Dolorem</h2>

        <p>Lorem ipsum dolor sit amet, consectetur </p>
      </div>

       <div class="project">
        <h3>Jun, 2, 2014</h3>
        <h2>Lorem Ipsum Dolorem</h2>
          <p>Lorem ipsum dolor sit amet, consectetur </p>
      </div>
  </div>
  <div class="pull-left padding-top" id="task-container">
    
    <div class="current-project">
       <h3 style="color:#888">Lorem</h3>
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
       tempor incididunt ut labore et dolore magna aliqua.</p>
        <div class="action-container">
         
          <a href="#attachment" class="attachment"><i class="fa fa-paperclip"></i> Attachment(s)</a>
          <a href="#delete" class="delete"><i class="fa fa-trash-o"></i> Delete</a>
          <a href="#edit" class="edit"><i class="fa fa-pencil-square-o"></i> Edit</a>
          <br class="clear" />
        </div>

    </div>
    <div class="task-top">
      <h4>Task</h4>
      <div class="project-action">
      <a href="#refresh-project"><i class="fa fa-refresh"></i></a>
      <a href="#add-project"><i class="fa fa-plus"></i></a>
    </div>
    </div>
     <div class="issues-container">
         <div class="issue">
          <h3><span class="date">Jun, 2, 2014</span> <span class="count">2 Hrs</span></h3>
          <h2>Lorem Ipsum Dolorem</h2>
          <p>Lorem ipsum dolor sit amet, consectetur </p>
        </div>

         <div class="issue">
          <h3>Jun, 2, 2014</h3>
          <h2>Lorem Ipsum Dolorem</h2>
          <p>Lorem ipsum dolor sit amet, consectetur </p>
        </div>
     </div>

   
  </div>
   <div class="pull-left padding-top" id="history-container">
    <div class="history-container">
      <h4 style="padding-left:5px;color:#888">Task History</h4>
         <div class="issue">
          <h3><span class="date">Jun, 2, 2014</span> <span class="count">2 Hrs</span></h3>
          <h2>Lorem Ipsum Dolorem</h2>
          <p>Lorem ipsum dolor sit amet, consectetur </p>
        </div>

         <div class="issue">
          <h3>Jun, 2, 2014</h3>
          <h2>Lorem Ipsum Dolorem</h2>
          <p>Lorem ipsum dolor sit amet, consectetur </p>
        </div>
     </div>
   </div>


     
</div>
  <script type="text/javascript" src="<?=base_url()?>media/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>media/bootstrap-3.2.0/js/bootstrap.js"></script>
  </body>
  </html>