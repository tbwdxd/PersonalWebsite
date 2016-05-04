<?php
ob_start();
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AAA Student Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
session_start();
require_once('lib/DataAccess.php');
require_once('lib/Model.php');
require_once('lib/View.php');
require_once('lib/Controller.php');
$data=DataAccess::getInstance('localhost','testdd','test15821961_gg','Titainium');
if(@$_SESSION['CWID'] == ""){//user hasn't login yet
    header('Location:login.php');
    exit();
    }
else if(@$_SESSION['type'] == "3"){//admin
    header("location:management.php");
    }
//
$action=@$_GET["action"];
switch ($action)
{
    case "viewprofile":
        $controller=& new profileController($data); break; 
    case "viewcourse":
        $controller=& new viewcourseController($data); break;
    case "enrollcourse":
        $controller=& new enrollcourseController($data); break;
    case "enroll":
        $controller=& new enrollController($data); break;
    case "viewcoursefac":
        $controller=& new viewcoursefacController($data); break;
    case "manage":
        $controller=& new managefacController($data); break;
    case "stumanage":
        $controller=& new managestuController($data); break;
    case "uploadmat":
        $controller=& new uploadmatController($data); break;
    case "addgradesec":
        $controller=& new addgradesecController($data); break;
    case "uploadhw":
        $controller=& new uploadhwController($data); break;
    case "lookstudent":
        $controller=& new lookstudentController($data); break;
    case "grade":
        $controller=& new gradeController($data); break;
    default:
        $controller=& new indexController($data); break;
}   
?>
<body>
<div id="wrapper">
<?php
if(@$_SESSION['type'] == "1")
    echo "
    <nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='index.php'>AAA Student Portal Beta v0.1 Student</a>
            </div>
            <!-- /.navbar-header -->

            <ul class='nav navbar-top-links navbar-right'>
                <!-- /.dropdown -->
                <li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='fa fa-user fa-fw'></i>  <i class='fa fa-caret-down'></i>
                    </a>
                    <ul class='dropdown-menu dropdown-user'>
                        <li><a href='?action=viewprofile'><i class='fa fa-user fa-fw'></i> User Profile</a>
                        </li>
                        <li class='divider'></li>
                        <li><a href='login.php?action=logout'><i class='fa fa-sign-out fa-fw'></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class='navbar-default sidebar' role='navigation'>
                <div class='sidebar-nav navbar-collapse'>
                    <ul class='nav' id='side-menu'>
                    <!-- Search-->
                        <li class='sidebar-search'>
                            <div class='input-group custom-search-form'>
                                <input type='text' class='form-control' placeholder='Search...'>
                                <span class='input-group-btn'>
                                <button class='btn btn-default' type='button'>
                                    <i class='fa fa-search'></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href='management.php'><i class='fa fa-dashboard fa-fw'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='#'><i class='fa fa-calendar fa-fw'></i> Course Management<span class='fa arrow'></span></a>
                            <ul class='nav nav-third-level'>
                                <li>
                                   <a href='?action=viewcourse'>View Course Schedule</a>
                                </li>
                                <li>
                                    <a href='?action=enrollcourse'>Get Enroll a Course Section</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>";
else if(@$_SESSION['type'] == "2")
    echo "
    <nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='index.php'>AAA Student Portal Beta v0.1 Faculty</a>
            </div>
            <!-- /.navbar-header -->

            <ul class='nav navbar-top-links navbar-right'>
                <!-- /.dropdown -->
                <li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='fa fa-user fa-fw'></i>  <i class='fa fa-caret-down'></i>
                    </a>
                    <ul class='dropdown-menu dropdown-user'>
                        <li><a href='?action=viewprofile'><i class='fa fa-user fa-fw'></i> User Profile</a>
                        </li>
                        <li class='divider'></li>
                        <li><a href='login.php?action=logout'><i class='fa fa-sign-out fa-fw'></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class='navbar-default sidebar' role='navigation'>
                <div class='sidebar-nav navbar-collapse'>
                    <ul class='nav' id='side-menu'>
                    <!-- Search-->
                        <li class='sidebar-search'>
                            <div class='input-group custom-search-form'>
                                <input type='text' class='form-control' placeholder='Search...'>
                                <span class='input-group-btn'>
                                <button class='btn btn-default' type='button'>
                                    <i class='fa fa-search'></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href='management.php'><i class='fa fa-dashboard fa-fw'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='#'><i class='fa fa-calendar fa-fw'></i> Course Management<span class='fa arrow'></span></a>
                            <ul class='nav nav-third-level'>
                                <li>
                                   <a href='?action=viewcoursefac'>View My Courses</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>"; 
?>
<div id='page-wrapper'>
<?php
$view=$controller->getView(); 
$view->display(); 


?>
</div>
</div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script src='bower_components/datatables/media/js/jquery.dataTables.min.js'></script>
    <script src='bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>