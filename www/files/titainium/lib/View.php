<?php
class View {
   
    var $output; 

	function display() {  
     	echo($this->output);
	}
}
class emptyView extends View{
	function __construct(){
		$this->output.= "";
		}
	}
class loginView extends View {
	function __construct($error){
		if(!empty($error['HeadErr'])){
			$error="* ".$error['HeadErr'];
			}
		$this->output.= "
    	<div class='container'>
        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <h2  align='center'><small>AAA Student Portal</small></h2>
                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Please Log In Before Access</h3>
                    </div>
                    <div class='panel-body'>
                        <form method='post' action= '?action=login'>
                            <fieldset>
                                <div class='form-group'>";
                                if (@$error['HeadErr'])
                                   $this->output.= "
                                    <div class='alert alert-danger'>".$error."</div>";
                                else if(@$error['HeadNot'])
                                	$this->output.= "
                                    <div class='alert alert-success'>".$error['HeadNot']."</div>";
        $this->output.= "
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='CWID' name='CWID' type='CWID' autofocus>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='Password' name='password' type='password' value=''>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type='submit' class='btn btn-lg btn-success btn-block' name='submit' value='Login'>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src='../bower_components/jquery/dist/jquery.min.js'></script>

    <!-- Bootstrap Core JavaScript -->
    <script src='../bower_components/bootstrap/dist/js/bootstrap.min.js'></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src='../bower_components/metisMenu/dist/metisMenu.min.js'></script>

    <!-- Custom Theme JavaScript -->
    <script src='../dist/js/sb-admin-2.js'></script>";
		}
	}

class indexView extends View{
    function __construct(){
    	if($_SESSION['type']==1){
    		$view ="viewcourse";
    		$view2="enrollcourse";
    	}
    	else
    		$view =$view2= "viewcoursefac";
		$this->output.="<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
                <div class='col-lg-3 col-md-6'>
                    <div class='panel panel-yellow'>
                        <div class='panel-heading'>
                            <div class='row'>
                                <div class='col-xs-3'>
                                    <i class='fa fa-graduation-cap fa-5x'></i>
                                </div>
                                <div class='col-xs-9 text-right'>
                                    <div class='huge'></div>
                                </div>
                            </div>
                        </div>
                        <a href='?action=$view'>
                            <div class='panel-footer'>
                                <span class='pull-left'>Manage My Course</span>
                                <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                                <div class='clearfix'></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class='col-lg-3 col-md-6'>
                    <div class='panel panel-green'>
                        <div class='panel-heading'>
                            <div class='row'>
                                <div class='col-xs-3'>
                                    <i class='fa fa-calendar fa-5x'></i>
                                </div>
                                <div class='col-xs-9 text-right'>
                                    <div class='huge'></div>
                                </div>
                            </div>
                        </div>
                        <a href='?action=$view2'>
                            <div class='panel-footer'>
                                <span class='pull-left'>View Course Schedule</span>
                                <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                                <div class='clearfix'></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Dash Board Item Example
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown'>
                                        Actions
                                        <span class='caret'></span>
                                    </button>
                                    <ul class='dropdown-menu pull-right' role='menu'>
                                        <li><a href='#'>Action</a>
                                        </li>
                                        <li><a href='#'>Another action</a>
                                        </li>
                                        <li><a href='#'>Something else here</a>
                                        </li>
                                        <li class='divider'></li>
                                        <li><a href='#'>Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            Nothing to Display.
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-bell fa-fw'></i> Notifications Panel (Display Only)
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <div class='list-group'>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-comment fa-fw'></i> New Comment
                                    <span class='pull-right text-muted small'><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-twitter fa-fw'></i> 3 New Followers
                                    <span class='pull-right text-muted small'><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-envelope fa-fw'></i> Message Sent
                                    <span class='pull-right text-muted small'><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-tasks fa-fw'></i> New Task
                                    <span class='pull-right text-muted small'><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-upload fa-fw'></i> Server Rebooted
                                    <span class='pull-right text-muted small'><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-bolt fa-fw'></i> Server Crashed!
                                    <span class='pull-right text-muted small'><em>11:13 AM</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-warning fa-fw'></i> Server Not Responding
                                    <span class='pull-right text-muted small'><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-shopping-cart fa-fw'></i> New Order Placed
                                    <span class='pull-right text-muted small'><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href='#' class='list-group-item'>
                                    <i class='fa fa-money fa-fw'></i> Payment Received
                                    <span class='pull-right text-muted small'><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href='#' class='btn btn-default btn-block'>View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
            </div>
    </div>
    <!-- /.row -->";
	}
}
class ProfileView extends View{
	function __construct($user,$department){
		foreach ($user as $value){
			$fname= $value['First_Name'];
			$lname= $value['Last_Name'];
			$email= $value['Email'];
			$type= $value['Type'];
			$dep = $value['Department_ID'];
			$address = $value['Address'];
			}
		$i=1;
		foreach ($department as $value){
			while($i!=$value['Department_ID']){
				$title[$i] = "";
				$i++;
			}
			$title[$i]= $value['Department_Name'];
			$i++;
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>View My Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-4'>
                    <div class='panel panel-green'>
                        <div class='panel-heading'>
                            My Profile
                        </div>
                        <div class='panel-body'>
                            <p>First Name: $fname</p>
                            <p>Last Name: $lname</p>
                            <p>Email Address: $email</p>
                            <p>Type: ";
                            switch ($type) {
                            	case 1:
                            		$this->output.="Student";
                            		break;
                            	case 2:
                            		$this->output.="Faculty";
                            		break;
                            	default:
                            		$this->output.="Student";
                            		break;
                            }
                            $this->output.= "</p>
                            <p>Department: $title[$dep]</p>
                            <p>Address: $address</p>
                        </div>
                        <div class='panel-footer'>
                            AAA Student Portal
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class enrollcourseView extends View{
	function __construct($course,$detail,$faculty,$department,$exception,$success,$error){
		if(!empty($error['HeadErr'])){
			$error="* ".$error['HeadErr'];
			}
		$i=1;
		foreach ($detail as $value){
			while ($i != $value['Detail_ID']){
				$cstitle[$i] = '';
				$depid[$i] = '';
				$csunit[$i] = '';
				$cstype[$i] = '';
				$csbook[$i] = '';
				$i++;
			}
			$cstitle[$i] = $value['Course_Name'];
			$depid[$i] = $value['Department_ID'];
			$csunit[$i] = $value['Course_Unit'];
			$cstype[$i] = $value['Type'];
			$csbook[$i] = $value['Textbook'];
			$i++;
			}
		$i=1;
		foreach ($faculty as $value){
			while ($i != $value['CWID']){
				$name[$i] = '';
				$i++;
			}
			$name[$i] = $value['First_Name']." ".$value['Last_Name'];
			$i++;
			}
		$i =1;
		foreach ($department as $value){
			while ($i != $value['Department_ID']){
				$dep[$i] = '';
				$i++;
			}
			$dep[$i] = $value['Department_Name'];
			$i++;
			}
		$i =1;
		foreach ($exception as $value){
			$exccs[$i] = $value['Course_ID'];
			$exccsdt[$i] = $value['Detail_ID'];
			$i++;
			}
		$this->output.= "
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>All Courses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            List Show All Courses
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <div class='dataTable_wrapper'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$error."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>Enrolled Successfully.</div>";
                            $this->output.= "
                                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Section</th>
                                            <th>Department</th>
                                            <th>Instructor</th>
                                            <th>Unit</th>
                                            <th>Type</th>
                                            <th>Textbook</th>
                                            <th>Location</th>
                                            <th>Time</th>
                                            <th>Capacity</th>
                                            <th>Enroll</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    	foreach ($course as $value){
                                    		$id = $value['Course_ID'];
                                    		$dtid = $value['Detail_ID'];
                                    		$time = $value['Time_Chunk'];
                                    		$section = $value['Section_Number'];
                                    		$facid = $value['Instructor_CWID'];
                                    		$capa = $value['Capacity'];
                                    		$loc = $value['Location'];
                                    		$data = $value['Date'];
                                    		$this->output.= "<tr class=$id>
                                    		<td>$id</td>";
                                    		$title = $cstitle[$dtid];
                                    		$this->output.= "<td>$title</td>
                                    		<td>$section</td>";
                                    		$depname = $dep[$depid[$dtid]];
											$this->output.= "<td>$depname</td>";
											$insname = $name[$facid];
											$this->output.= "<td>$insname</td>";
											$unit = $csunit[$dtid];
											$this->output.= "<td>$unit</td>";
											$typen = $cstype[$dtid];
											switch ($typen) {
												case 1:
													$type = 'Obligatory';
													break;
												case 2:
													$type = 'Elective';
													break;
												case 3:
													$type = 'Other';
													break;
												default:
													$type = 'Obligatory';
													break;
											}
											$this->output.= "<td>$type</td>";
											$book = $csbook[$dtid];
											$this->output.= "<td>$book</td>
											<td>$loc</td>";
											switch ($time) {
												case 1:
													$time = '8-10am';
													break;
												case 2:
													$time = '10am-12pm';
													break;
												case 3:
													$time = '1-3pm';
													break;
												case 4:
													$time = '3-5pm';
													break;
												case 5:
													$time = '5-7pm';
													break;
												default:
													$time = '8-10am';
													break;
											}
											$this->output.= "
											<td>$time</td>
											<td>$capa</td>";
											if(!empty($exccs)){
												for($a=1;$a<$i;$a++){
													if($exccs[$a] == $id)
														$this->output.= "<td>Enrolled</td>";
													else
														$this->output.= "<td><a href ='?action=enroll&id=$id'>Enroll</a></td>";
												}
											}
											else
												$this->output.= "<td><a href ='?action=enroll&id=$id'>Enroll</a></td>";
											$this->output.= "</tr>";
											}
                                    $this->output.= "
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    ";
		}
	}
class managetableView extends View{
	function __construct($course,$detail,$faculty,$department,$exception,$success,$error,$is_fac){
		if(!empty($error['HeadErr'])){
			$error="* ".$error['HeadErr'];
			}
		$i=1;
		foreach ($detail as $value){
			while ($i != $value['Detail_ID']){
				$cstitle[$i] = '';
				$depid[$i] = '';
				$csunit[$i] = '';
				$cstype[$i] = '';
				$csbook[$i] = '';
				$i++;
			}
			$cstitle[$i] = $value['Course_Name'];
			$depid[$i] = $value['Department_ID'];
			$csunit[$i] = $value['Course_Unit'];
			$cstype[$i] = $value['Type'];
			$csbook[$i] = $value['Textbook'];
			$i++;
			}
		$i=1;
		foreach ($faculty as $value){
			while ($i != $value['CWID']){
				$name[$i] = '';
				$i++;
			}
			$name[$i] = $value['First_Name']." ".$value['Last_Name'];
			$i++;
			}
		$i =1;
		foreach ($department as $value){
			while ($i != $value['Department_ID']){
				$dep[$i] = '';
				$i++;
			}
			$dep[$i] = $value['Department_Name'];
			$i++;
			}
		$i =1;
		foreach ($exception as $value){
			$exccs[$i] = $value['Course_ID'];
			$exccsdt[$i] = $value['Detail_ID'];
			$i++;
			}
		$this->output.= "
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>All Teaching Courses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            List Show All Teaching Courses
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <div class='dataTable_wrapper'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$error."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>Enrolled Successfully.</div>";
                            $this->output.= "
                                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Section</th>
                                            <th>Department</th>
                                            <th>Instructor</th>
                                            <th>Unit</th>
                                            <th>Type</th>
                                            <th>Textbook</th>
                                            <th>Location</th>
                                            <th>Time</th>
                                            <th>Capacity</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    	foreach ($course as $value){
                                    		$id = $value['Course_ID'];
                                    		$dtid = $value['Detail_ID'];
                                    		$time = $value['Time_Chunk'];
                                    		$section = $value['Section_Number'];
                                    		$facid = $value['Instructor_CWID'];
                                    		$capa = $value['Capacity'];
                                    		$loc = $value['Location'];
                                    		$data = $value['Date'];
                                    		$this->output.= "<tr class=$id>
                                    		<td>$id</td>";
                                    		$title = $cstitle[$dtid];
                                    		$this->output.= "<td>$title</td>
                                    		<td>$section</td>";
                                    		$depname = $dep[$depid[$dtid]];
											$this->output.= "<td>$depname</td>";
											$insname = $name[$facid];
											$this->output.= "<td>$insname</td>";
											$unit = $csunit[$dtid];
											$this->output.= "<td>$unit</td>";
											$typen = $cstype[$dtid];
											switch ($typen) {
												case 1:
													$type = 'Obligatory';
													break;
												case 2:
													$type = 'Elective';
													break;
												case 3:
													$type = 'Other';
													break;
												default:
													$type = 'Obligatory';
													break;
											}
											$this->output.= "<td>$type</td>";
											$book = $csbook[$dtid];
											$this->output.= "<td>$book</td>
											<td>$loc</td>";
											switch ($time) {
												case 1:
													$time = '8-10am';
													break;
												case 2:
													$time = '10am-12pm';
													break;
												case 3:
													$time = '1-3pm';
													break;
												case 4:
													$time = '3-5pm';
													break;
												case 5:
													$time = '5-7pm';
													break;
												default:
													$time = '8-10am';
													break;
											}
											$this->output.= "
											<td>$time</td>
											<td>$capa</td>";
											if($is_fac==0)
												$action = "stumanage";
											else
												$action = "manage";
											$this->output.= "<td><a href ='?action=$action&id=$id'>Manage</a></td>";
											$this->output.= "</tr>";
											}
                                    $this->output.= "
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    ";
		}
	}
class manageView extends View{
	function __construct($course,$csdt,$student,$file,$hwmat,$success,$error){
		$id=$_GET['id'];
		foreach ($csdt as $value) {
			$title = $value["Course_Name"];
		}
		foreach ($course as $value) {
			$name = $title." Section-". $value["Section_Number"];
			$cid =$value["Course_ID"];
		}
		$this->output.= "
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>Manage Course</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            $name
                        </div>
                        <!-- .panel-heading -->
                        <div class='panel-body'>
                            <div class='panel-group' id='accordion'>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>Material</a>
                                        </h4>
                                    </div>
                                    <div id='collapseOne' class='panel-collapse collapse in'>
                                        <div class='panel-body'>
                                            <div class='row'>
           									</div>
						            		<div class='row'>
						                	<div class='col-lg-8'>
						                    <div class='panel panel-default'>
						                        <div class='panel-heading'>
						                            <i class='fa fa-file-text-o fa-fw'></i> Add New Material
						                            <div class='pull-right'>
						                                <div class='btn-group'>
						                                    
						                                </div>
						                            </div>
						                        </div>
						                        <!-- /.panel-heading -->
						                        <div class='panel-body'>
						                            <form role='form' method='post'enctype='multipart/form-data' action= '?action=uploadmat&id=$id'>";
						                            if ($success == 0)
						                                   $this->output.= "<div class='alert alert-danger'>Upload Unsuccessfully.</div>";
						                            else if ($success == 1)
						                                   $this->output.= "<div class='alert alert-success'>Upload Successfully.</div>";
						                            $this->output.= "
						                                        <div class='form-group'>
						                                            <label>File Name</label>
						                                            <input class='form-control'placeholder='File Name' name='filename' type='filename'>
						                                        </div>
						                                        <div class='form-group'>
						                                            <label>Upload File</label>
						                                            <input name='fileup' type='file'>
						                                        </div>
						                                        <button type='submit' class='btn btn-default'>Submit</button>
						                                        <button type='reset' class='btn btn-default'>Reset</button>
						                                    </form>
						                        </div>
						                        <!-- /.panel-body -->
						                    </div>";
						                    if (!empty($file)){
						                    	$this->output.="<h3>Uploaded Files: </h3>";
						                		foreach ($file as $value) {
						                			$this->output.= "<div class='alert alert-info'><a class='alert-link'href = ".$value['Directory'].">".$value['File_Name']."<a></div>";
						                		}
						              		}
											$this->output.="	
										</div> 
						    			</div>
                                        </div>
                                    </div>
                                </div>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapseTwo'>Homework</a>
                                        </h4>
                                    </div>
                                    <div id='collapseTwo' class='panel-collapse collapse'>
                                        <div class='panel-body'>
                                        	<div class='row'>
           									</div>
						            		<div class='row'>
						                	<div class='col-lg-8'>
						                    <div class='panel panel-default'>
						                        <div class='panel-heading'>
						                            <i class='fa fa-check fa-fw'></i> Add New Grade Section
						                            <div class='pull-right'>
						                                <div class='btn-group'>
						                                    
						                                </div>
						                            </div>
						                        </div>
						                        <!-- /.panel-heading -->
						                        <div class='panel-body'>
                                            		<form role='form' method='post'enctype='multipart/form-data' action= '?action=addgradesec&id=$id'>
				                                    	<div class='form-group'>
				                                            <label>Section Name</label>
				                                            <input class='form-control'placeholder='Example: Homework1' name='gdname' type='gdname'>
				                                        </div>
				                                        <div class='form-group'>
				                                            <label>Upload Instruction</label>
				                                            <input name='insup' type='file'>
				                                        </div>
				                                        <div class='form-group'>
				                                            <label>Persentage</label>
				                                            <input class='form-control'placeholder='Persentage' name='persentage' type='persentage'>
				                                        </div>
				                                        <button type='submit' class='btn btn-default'>Submit</button>
				                                        <button type='reset' class='btn btn-default'>Reset</button>
				                            		</form>
                                        		</div>
                                    		</div>
                               				</div>
                               				</div>
                               				";
                    if (!empty($hwmat)){
						                    	$this->output.="<h3>Homeworks: </h3>";
						                		foreach ($hwmat as $value) {
						                			$this->output.= "<div class='alert alert-info'><a class='alert-link'href = ".$value['Directory'].">".$value['File_Name']."<a></div>";
						                		}
						              		}
				$this->output.="
                               			</div>
                               		</div>
                               	</div>

                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapseThree'>Students</a>
                                        </h4>
                                    </div>
                                    <div id='collapseThree' class='panel-collapse collapse'>
                                        <div class='panel-body'>";
                                        foreach ($student as $value) {
                                        	$name = $value["First_Name"]." ".$value["Last_Name"]." CWID:".$value["CWID"];
                                        	$CWID = $value["CWID"];
                                        	$this->output.= "<a href='?action=lookstudent&id=$CWID&cid=$cid'><button type='button' class='btn btn-outline btn-primary btn-lg'>$name</button></a>";
                                        }
                                        $this->output.= "
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->";
		}
}
class stumanageView extends View{
	function __construct($course,$csdt,$grade,$file,$hwmat,$success,$error){
		$id=$_GET['id'];
		foreach ($grade as $value) {
			$finalgrade = $value["Grade"];
		}
		foreach ($csdt as $value) {
			$title = $value["Course_Name"];
		}
		foreach ($course as $value) {
			$name = $title." Section-". $value["Section_Number"];
			$cid =$value["Course_ID"];
		}
		$this->output.= "
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>Manage Course</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            $name
                        </div>
                        <!-- .panel-heading -->
                        <div class='panel-body'>
                            <div class='panel-group' id='accordion'>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>Material</a>
                                        </h4>
                                    </div>
                                    <div id='collapseOne' class='panel-collapse collapse in'>
                                        <div class='panel-body'>
                                            <div class='row'>
           							</div>
						            <div class='row'>
						                <div class='col-lg-8'>
						                    ";
						                	if (!empty($file)){
						                    	$this->output.="<h3>Class Materials: </h3>";
						                		foreach ($file as $value) {
						                			$this->output.= "<div class='alert alert-info'><a class='alert-link'href = ".$value['Directory'].">".$value['File_Name']."<a></div>";
						                		}
						              		}
											$this->output.="
										</div> 
						    			</div>
                                        </div>
                                    </div>
                                </div>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapseTwo'>Homework</a>
                                        </h4>
                                    </div>
                                    <div id='collapseTwo' class='panel-collapse collapse'>
                                        <div class='panel-body'>
                                            <form role='form' method='post'enctype='multipart/form-data' action= '?action=uploadhw&id=$id'>
				                                    <div class='form-group'>
				                                            <label>File Name</label>
				                                            <input class='form-control'placeholder='File Name' name='filename' type='filename'>
				                                        </div>
				                                        <div class='form-group'>
				                                            <label>Upload File</label>
				                                            <input name='fileup' type='file'>
				                                        </div>
				                                        <button type='submit' class='btn btn-default'>Submit</button>
				                                        <button type='reset' class='btn btn-default'>Reset</button>
				                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapseThree'>Grade</a>
                                        </h4>
                                    </div>
                                    <div id='collapseThree' class='panel-collapse collapse'>
                                        <div class='panel-body'>$finalgrade
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->";
		}
}
class GradeView extends View{
	function __construct($student,$id,$cid,$success){
		foreach ($student as $value){
			$CWID =$value['CWID'];
			$fname= $value['First_Name'];
			$lname= $value['Last_Name'];
			}
		$name = $fname." ".$lname;
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Grade Student</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-4'>
                    <div class='panel panel-green'>
                        <div class='panel-heading'>
                            $name
                        </div>
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=grade&id=$CWID&cid=$cid'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>Failed</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>Success</div>";
                            $this->output.= "
                                        <div class='form-group'>
                                            <label>Final Grade</label>
                                            <input class='form-control'placeholder='Grade' name='grade' type='grade'>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <div class='panel-footer'>
                            AAA Student Portal
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
?>