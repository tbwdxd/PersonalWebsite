<?php
class View {
   
    var $output; 

	function display() {  
     	echo($this->output);
	}
}
class indexView extends View{
    function __construct(){
		$this->output.="<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
                <div class='col-lg-3 col-md-6'>
                    <div class='panel panel-primary'>
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
                        <a href='?action=addstudent'>
                            <div class='panel-footer'>
                                <span class='pull-left'>Add New Student</span>
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
                        <a href='?action=addcourse'>
                            <div class='panel-footer'>
                                <span class='pull-left'>Add New Course Session</span>
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
class addstudentView extends View{
	function __construct($success,$error,$department){
		$i =1;
		foreach ($department as $value){
			$dep[$i] = $value['Department_Name'];
			$depid[$i] = $value['Department_ID'];
			$i++;
			}
		$fname=$lname=$email=$address=$pwd=$pwd1="";
		if ($success != 1){
			$fname =@$_POST['firstname'];
			$lname = @$_POST['lastname'];
			$email = @$_POST['email'];
			$address = @$_POST['address'];
			$pwd ="";
			$pwd1 ="";
		}
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$emailErr=@$error['emailErr'];
		$pwdErr=@$error['pwdErr'];
		$pwd1Err=@$error['pwd1Err'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Add New Student</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-graduation-cap fa-fw'></i> Add New Student
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=addstu'>";
                            			if ($success == 1)
                                   			$this->output.= "<div class='alert alert-success'> Student Added Successfully.</div>";
                               		 	$this->output.= "
                                        <div class='form-group'>
                                            <label>First Name</label>";
                                        if (!empty($fnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $fnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Student First Name' name='firstname' type='firstname' value = $fname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Last Name</label>";
                                        if (!empty($lnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $lnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Student Last Name' name='lastname' type='lastname' value = $lname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Email</label>";
                                        if (!empty($emailErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $emailErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Student Email' name='email' type='email' value = $email>
                                        </div>
                                        <div class='form-group'>
                                            <label>Password</label>";
                                        if (!empty($pwdErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $pwdErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Password' name='password' type='password'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Password</label>";
                                        if (!empty($pwd1Err))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $pwd1Err</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Confirm Password' name='password1' type='password'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Address</label>
                                            <input class='form-control'placeholder='Address' name='address' type='address' value = $address>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department</label>
                                            <select class='form-control' name = 'department'>";
                                            for ($fValue =1; $fValue <= count($dep);$fValue++){
												$fMenu = $dep[$fValue];
												$fid = $depid[$fValue];
												if ($fMenu != ""){
												$this->output.="<option value = '$fid'>$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class modifystuView extends View{
	function __construct($success,$error,$department,$student){
		$i =1;
		foreach ($department as $value){
			$dep[$i] = $value['Department_Name'];
			$depid[$i] = $value['Department_ID'];
			$i++;
			}
		foreach ($student as $value){
			$CWID = $value['CWID'];
			$fname= $value['First_Name'];
			$lname= $value['Last_Name'];
			$email= $value['Email'];
			$depID= $value['Department_ID'];
			$address=$value['Address'];
		}
		if ($success != 1){
			$CWID = $value['CWID'];
			$fname= $value['First_Name'];
			$lname= $value['Last_Name'];
			$email= $value['Email'];
			$depID= $value['Department_ID'];
			$address=$value['Address'];
		}
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$emailErr=@$error['emailErr'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Modify Student</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-graduation-cap fa-fw'></i> Modify  Student
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=updatestu'>";
                            			if ($success == 1)
                                   			$this->output.= "<div class='alert alert-success'> Student Added Successfully.</div>";
                               		 	$this->output.= "
                               		 	<div class='form-group'>
                               		 	<label>CWID</label>
                               		 		<input class='form-control' name='CWID' type='CWID' value = $CWID readonly='readonly'>
                               		 	</div>
                                        <div class='form-group'>
                                            <label>First Name</label>";
                                        if (!empty($fnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $fnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Student First Name' name='firstname' type='firstname' value = $fname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Last Name</label>";
                                        if (!empty($lnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $lnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Student Last Name' name='lastname' type='lastname' value = $lname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Email</label>";
                                        if (!empty($emailErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $emailErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Student Email' name='email' type='email' value = $email>
                                        </div>
                                        <div class='form-group'>
                                            <label>Address</label>
                                            <input class='form-control'placeholder='Address' name='address' type='address' value = $address>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department</label>
                                            <select class='form-control' name = 'department'>";
                                            for ($fValue =1; $fValue <= count($dep);$fValue++){
												$fMenu = $dep[$fValue];
												$fid = $depid[$fValue];
												if ($fMenu != ""){
													$this->output.="<option value = '$fid'";
													if ($fid == $depID)
													$this->output.=" selected ";
												$this->output.=">$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class addfacultyView extends View{
	function __construct($success,$error,$department){
		$i =1;
		foreach ($department as $value){
			$dep[$i] = $value['Department_Name'];
			$depid[$i] = $value['Department_ID'];
			$i++;
			}
		$fname=$lname=$email=$address=$pwd=$pwd1="";
		if ($success != 1){
			$fname =@$_POST['firstname'];
			$lname = @$_POST['lastname'];
			$email = @$_POST['email'];
			$address = @$_POST['address'];
			$pwd ="";
			$pwd1 ="";
		}
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$emailErr=@$error['emailErr'];
		$pwdErr=@$error['pwdErr'];
		$pwd1Err=@$error['pwd1Err'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Add New Faculty</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-graduation-cap fa-fw'></i> Add New Faculty
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=addfac'>";
                            			if ($success == 1)
                                   			$this->output.= "<div class='alert alert-success'> Faculty Added Successfully.</div>";
                               		 	$this->output.= "
                                        <div class='form-group'>
                                            <label>First Name</label>";
                                        if (!empty($fnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $fnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Faculty First Name' name='firstname' type='firstname' value = $fname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Last Name</label>";
                                        if (!empty($lnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $lnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Faculty Last Name' name='lastname' type='lastname' value = $lname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Email</label>";
                                        if (!empty($emailErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $emailErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Faculty Email' name='email' type='email' value = $email>
                                        </div>
                                        <div class='form-group'>
                                            <label>Password</label>";
                                        if (!empty($pwdErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $pwdErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Password' name='password' type='password'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Password</label>";
                                        if (!empty($pwd1Err))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $pwd1Err</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Confirm Password' name='password1' type='password'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Address</label>
                                            <input class='form-control'placeholder='Address' name='address' type='address' value = $address>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department</label>
                                            <select class='form-control' name = 'department'>";
                                            for ($fValue =1; $fValue <= count($dep);$fValue++){
												$fMenu = $dep[$fValue];
												$fid = $depid[$fValue];
												if ($fMenu != ""){
												$this->output.="<option value = '$fid'>$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class modifyfacView extends View{
	function __construct($success,$error,$department,$faculty){
		$i =1;
		foreach ($department as $value){
			$dep[$i] = $value['Department_Name'];
			$depid[$i] = $value['Department_ID'];
			$i++;
			}
		foreach ($faculty as $value){
			$CWID = $value['CWID'];
			$fname= $value['First_Name'];
			$lname= $value['Last_Name'];
			$email= $value['Email'];
			$depID= $value['Department_ID'];
			$address=$value['Address'];
		}
		if ($success != 1){
			$CWID = $value['CWID'];
			$fname= $value['First_Name'];
			$lname= $value['Last_Name'];
			$email= $value['Email'];
			$depID= $value['Department_ID'];
			$address=$value['Address'];
		}
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$emailErr=@$error['emailErr'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Modify Faculty</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-graduation-cap fa-fw'></i> Modify Faculty
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=updatefac'>";
                            			if ($success == 1)
                                   			$this->output.= "<div class='alert alert-success'> Faculty Added Successfully.</div>";
                               		 	$this->output.= "
                               		 	<div class='form-group'>
                               		 	<label>CWID</label>
                               		 		<input class='form-control' name='CWID' type='CWID' value = $CWID readonly='readonly'>
                               		 	</div>
                                        <div class='form-group'>
                                            <label>First Name</label>";
                                        if (!empty($fnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $fnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Faculty First Name' name='firstname' type='firstname' value = $fname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Last Name</label>";
                                        if (!empty($lnameErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $lnameErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Faculty Last Name' name='lastname' type='lastname' value = $lname>
                                        </div>
                                        <div class='form-group'>
                                            <label>Email</label>";
                                        if (!empty($emailErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $emailErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Faculty Email' name='email' type='email' value = $email>
                                        </div>
                                        <div class='form-group'>
                                            <label>Address</label>
                                            <input class='form-control'placeholder='Address' name='address' type='address' value = $address>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department</label>
                                            <select class='form-control' name = 'department'>";
                                            for ($fValue =1; $fValue <= count($dep);$fValue++){
												$fMenu = $dep[$fValue];
												$fid = $depid[$fValue];
												if ($fMenu != ""){
													$this->output.="<option value = '$fid'";
													if ($fid == $depID)
													$this->output.=" selected ";
												$this->output.=">$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class adddepartmentView extends View{
	function __construct($success){
		if($success == 0){
			$error="* Add Department Unsuccessful, Please Check Your Input.";
			}
		else if($success == 1){
			$error="Add Department Successfully.";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Add New Department</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-university fa-fw'></i> Add New Department
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=adddep'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$error."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>".$error."</div>";
                            $this->output.= "
                                        <div class='form-group'>
                                            <label>Department Name</label>
                                            <input class='form-control'placeholder='Department Name' name='dpname' type='dpname'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department Phone Number</label>
                                            <input class='form-control'placeholder='Department Phone Number' name='dpphone' type='dpphone'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department Email</label>
                                            <input class='form-control'placeholder='Department Email' name='dpemail' type='dpemail'>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class addcoursedetailView extends View{
	function __construct($success,$department){
		$i =1;
		foreach ($department as $value){
			$dep[$i] = $value['Department_Name'];
			$depid[$i] = $value['Department_ID'];
			$i++;
			}
		if($success == 0){
			$error="* Add Course Detail Unsuccessful, Please Check Your Input.";
			}
		else if($success == 1){
			$error="Add Course Detail Successfully.";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Add New Course Detail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-book fa-fw'></i> Add New Course Detail
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=addcdet'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$error."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>".$error."</div>";
                            $this->output.= "
                                        <div class='form-group'>
                                            <label>Course Title</label>
                                            <input class='form-control'placeholder='Course Title' name='csname' type='csname'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Department</label>
                                            <select class='form-control' name = 'department'>";
                                            for ($fValue =1; $fValue <= count($dep);$fValue++){
												$fMenu = $dep[$fValue];
												$fid = $depid[$fValue];
												if ($fMenu != ""){
												$this->output.="<option value = '$fid'>$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Course Unit</label>
                                            <input class='form-control'placeholder='Course Unit' name='csunit' type='csunit'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Course Type</label>
                                            <select class='form-control' name = 'cstype'>
                                            <option value = '1'>Obligatory</option>
                                            <option value = '2'>Elective</option>
                                            <option value = '3'>Other</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Course Textbook</label>
                                            <input class='form-control'placeholder='Course Textbook<' name='csbook' type='csbook'>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}

class addcourseView extends View{
	function __construct($success,$detail,$faculty,$error){
		$i =1;
		foreach ($detail as $value){
			$title[$i] = $value['Course_Name'];
			$cdid[$i] = $value['Detail_ID'];
			$i++;
			}
		$i =1;
		foreach ($faculty as $value){
			$name[$i] = $value['First_Name']." ".$value['Last_Name'];
			$CWID[$i] = $value['CWID'];
			$i++;
			}
		$capa=$loc=$date=$time="";
		if ($success != 1){
			$capa =@$_POST['capa'];
			$loc = @$_POST['loc'];
			$date = @$_POST['date'];			
		}
		$locErr=@$error['locErr'];
	   	$capaErr=@$error['capaErr'];
		$dateErr=@$error['dateErr'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		else if($success == 1){
			$error="Add Course Section Successfully.";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Add New Course Section</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-calendar fa-fw'></i> Add New Course Section
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=addcs'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$headErr."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>".$error."</div>";
                            $this->output.= "
                            				<div class='form-group'>
                                            <label>Title</label>
                                            <select class='form-control' name = 'cdid'>";
                                            for ($fValue =1; $fValue <= count($title);$fValue++){
												$fMenu = $title[$fValue];
												$fid = $cdid[$fValue];
												if ($fMenu != ""){
													$this->output.="<option value = '$fid'";
													if ($fid == @$_POST["cdid"])
														$this->output.=" selected ";
													$this->output.=">$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        	<div class='form-group'>
                                            <label>Instructor</label>
                                            <select class='form-control' name = 'CWID'>";
                                            for ($fValue =1; $fValue <= count($name);$fValue++){
												$fMenu = $name[$fValue];
												$fid = $CWID[$fValue];
												if ($fMenu != ""){
												$this->output.="<option value = '$fid'";
													if ($fid == @$_POST["CWID"])
														$this->output.=" selected ";
													$this->output.=">$fMenu</option>";
											}
										}
								$this->output.="
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Course Time</label>
                                            <select class='form-control' name = 'cstime'>
                                            <option value = '1'";
											if (@$_POST["cstime"] == 1)
												$this->output.=" selected ";
											$this->output.=">8:00am-10:00am</option>
                                            <option value = '2'";
											if (@$_POST["cstime"] == 2)
												$this->output.=" selected ";
											$this->output.=">10:00am-12:00pm</option>
                                            <option value = '3'";
											if (@$_POST["cstime"] == 3)
												$this->output.=" selected ";
											$this->output.=">1:00pm-3:00pm</option>
                                            <option value = '4'";
											if (@$_POST["cstime"] == 4)
												$this->output.=" selected ";
											$this->output.=">3:00pm-5:00pm</option>
                                            <option value = '5'";
											if (@$_POST["cstime"] == 5)
												$this->output.=" selected ";
											$this->output.=">5:00am-7:00pm</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Capacity</label>";
                                        if (!empty($capaErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $capaErr</div>";
                                        $this->output.= "                                            
                                            <input class='form-control'placeholder='Course Capacity' name='capa' type='capa' value = $capa>
                                        </div>
                                        <div class='form-group'>
                                            <label>Location</label>";
                                        if (!empty($locErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $locErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Course Location' name='loc' type='loc' value = $loc>
                                        </div>
                                        <div class='form-group'>
                                            <label>Date</label>";
                                        if (!empty($dateErr))
                                        $this->output.= "
                                            <div class='alert alert-danger'>*  $dateErr</div>";
                                        $this->output.= "
                                            <input class='form-control'placeholder='Course Date' name='date' type='date' value = $date>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Submit</button>
                                        <button type='reset' class='btn btn-default'>Reset</button>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}

class searchstuView extends View{
	function __construct($success){
		if($success == 0){
			$error="* Modify Student Unsuccessful, Please Check Your Input.";
			}
		else if($success == 1){
			$error="Modify Student Successfully.";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Modiy Student By Search</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-book fa-fw'></i> Search Student
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=searchstu'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$error."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>".$error."</div>";
                            $this->output.= "
                                        <div class='form-group'>
                                            <input type='text' class='form-control' name='CWID'>
                                            <span class='input-group-btn'>
                                                <button class='btn btn-default' type='submit'><i class='fa fa-search'></i>
                                                </button>
                                            </span>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class searchfacView extends View{
	function __construct($success){
		if($success == 0){
			$error="* Modify Faculty Unsuccessful, Please Check Your Input.";
			}
		else if($success == 1){
			$error="Modify Faculty Successfully.";
			}
		$this->output.= "<div class='row'>
        <div class='col-lg-12'>
            <h1 class='page-header'>Modiy Faculty By Search</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class='row'>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-book fa-fw'></i> Search Faculty
                            <div class='pull-right'>
                                <div class='btn-group'>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <form role='form' method='post' action= '?action=searchfac'>";
                            if ($success == 0)
                                   $this->output.= "<div class='alert alert-danger'>".$error."</div>";
                            else if ($success == 1)
                                   $this->output.= "<div class='alert alert-success'>".$error."</div>";
                            $this->output.= "
                                        <div class='form-group'>
                                            <input type='text' class='form-control' name='CWID'>
                                            <span class='input-group-btn'>
                                                <button class='btn btn-default' type='submit'><i class='fa fa-search'></i>
                                                </button>
                                            </span>
                                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
    </div>
    <!-- /.row -->";
		}
	}
class viewcourseView extends View{
	function __construct($course,$detail,$faculty,$department){
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
                            <div class='dataTable_wrapper'>
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
													$type = 'Other';# code...
													break;
												default:
													$type = 'Obligatory';
													break;
											}
											$this->output.= "<td>$type</td>";
											$book = $csbook[$dtid];
											$this->output.= "<td>$book</td>
											<td>$loc</td>
											<td>$time</td>
											<td>$capa</td>";
											$this->output.= "</tr>";
											}
                                    $this->output.= "</tbody>
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
?>

 