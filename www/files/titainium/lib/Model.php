<?php

class Model {
    
    var $data; 
    function __construct(&$data) {
        $this->data=$data; 
    }
	function login(){
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		// define variables and set to empty values
		$email = $pwd = "";
		$isError = false;	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["CWID"])) {
				$isError = true;
			}
			else {
				$CWID = test_input($_POST["CWID"]);
			}
			if (empty($_POST["password"])) {
				$isError = true;
			}
			else {
				$pwd = hash("sha512", test_input($_POST["password"]));
			}
		}
		if(!$isError) {
			$row=$this->data->fetchRows("SELECT * FROM account WHERE CWID='$CWID'");
			if(empty($row))
				$row=$this->data->fetchRows("SELECT * FROM account WHERE Email='$CWID'");
			foreach($row as $value){
				if(count($value)!=0){
					$dbCWID = $value['CWID'];
					$dbEmail = $value['Email'];
					$dbpwd = $value['PWD'];
					$dbtype = $value['Type'];
					$name = $value['First_Name']." ".$value['Last_Name'];
					if(($CWID == $dbCWID) || ($CWID = $dbEmail) && ($pwd == $dbpwd)) {
						$_SESSION['CWID']=$CWID;
						$_SESSION['Name']=$name;
						$_SESSION['type']=$dbtype;
						return true;
						die();
					}
				}
			}
			return false;
		}
		return false;
	}
	function logout(){
		session_destroy();
		}
	function getuserbysession(){
		$CWID = $_SESSION['CWID'];
		$user = $this->data->fetchRows("SELECT * FROM account WHERE CWID = $CWID");
		return $user;
		}
	function get_dep(){
		$dep = $this->data->fetchRows("SELECT * FROM department WHERE NOT Department_ID = 1");
		return $dep;
		}
	function get_course(){
		$dep = $this->data->fetchRows("SELECT * FROM course");
		return $dep;
		}
	function get_coursebysession(){
		$CWID = $_SESSION['CWID'];
		$user = $this->data->fetchRows("SELECT * FROM account WHERE CWID = $CWID");
		foreach ($user as $value) {
			$dpid = $value['Department_ID'];
		}
		$course =  $this->data->fetchRows("SELECT * FROM course WHERE Department_ID = $dpid");
		return $course;
		}
	function get_coursebypick(){
		$CWID = $_SESSION['CWID'];
		$picked = $this->data->fetchRows("SELECT * FROM picked_course WHERE Student_CWID = $CWID");
		if(!empty($picked)){
			foreach ($picked as $value) {
				if ($value['Course_ID'])
					$csid[] = intval($value['Course_ID']);
			}
    		$csidlist=implode(",",$csid);

    		//The SQL Query
    		$query="SELECT * FROM course WHERE Course_ID in (".$csidlist.")";
			$course =  $this->data->fetchRows($query);
			return $course;
			}
		else
			return "";
		}
	function get_coursebyid($id){
		$cs = $this->data->fetchRows("SELECT * FROM course WHERE Course_ID = $id");
		return $cs;
		}
	function get_gradebycourse($id,$cid){
		$gd = $this->data->fetchRows("SELECT * FROM picked_course WHERE Student_CWID = $id AND Course_ID = $cid");
		return $gd;
		}
	function getstudentbyid($id){
		$cs = $this->data->fetchRows("SELECT * FROM picked_course WHERE Student_CWID = $id");
		return $cs;
		}
	function getuserbyid($id){
		$user = $this->data->fetchRows("SELECT * FROM account WHERE CWID = $id");
		return $user;
		}
	function get_detailbyid($id){
		$cs = $this->data->fetchRows("SELECT * FROM course WHERE Course_ID = $id");
		foreach ($cs as $value) {
			$csdtid = $value["Detail_ID"];
		}
		$csdt =  $this->data->fetchRows("SELECT * FROM course_detail WHERE Detail_ID = $csdtid");
		return $csdt;
		}
	function get_studentbycourse($id){
		$cs = $this->data->fetchRows("SELECT * FROM picked_course WHERE Course_ID = $id");
		if(!empty($cs)){
			foreach ($cs as $value) {
				if ($value['Student_CWID'])
					$CWID[] = intval($value['Student_CWID']);
			}
    		$cwidlist=implode(",",$CWID);

    		//The SQL Query
    		$query="SELECT * FROM account WHERE CWID in (".$cwidlist.")";
			$student =  $this->data->fetchRows($query);
			return $student;
			}
		else
			return "";
		}
	function get_matbycourse($id){
		$CWID = $_SESSION['CWID'];
		$file = $this->data->fetchRows("SELECT * FROM files WHERE Course_ID = $id AND Type = 1");
		if(!empty($file)){
			return $file;
			}
		else
			return "";
		}
	function get_hwmatbycourse($id){
		$CWID = $_SESSION['CWID'];
		$file = $this->data->fetchRows("SELECT * FROM files WHERE Course_ID = $id AND Type = 2");
		if(!empty($file)){
			return $file;
			}
		else
			return "";
		}	
	function get_coursebyins(){
		$CWID = $_SESSION['CWID'];
		$course =  $this->data->fetchRows("SELECT * FROM course WHERE Instructor_CWID = $CWID");
		return $course;
		}
	function get_detail(){
		$dep = $this->data->fetchRows("SELECT * FROM course_detail");
		return $dep;
		}
	function get_faculty(){
		$dep = $this->data->fetchRows("SELECT * FROM account WHERE Type = 2");
		return $dep;
		}
	function get_exception(){
		$CWID = $_SESSION['CWID'];
		$exc = $this->data->fetchRows("SELECT * FROM picked_course WHERE Student_CWID = $CWID");
		return $exc;
		}
	function enroll(){
		$CWID = $_SESSION['CWID'];
		$cid = $_GET["id"];
		$detail = $this->data->fetchRows("SELECT * FROM course WHERE Course_ID='$cid'");
		foreach ($detail as $value) {
			$cdid = $value["Detail_ID"];
			$thistime = $value["Time_Chunk"];
		}
		$pickedc = $this->data->fetchRows("SELECT * FROM picked_course WHERE Course_ID='$cid'");
		$picked ="";
		if(!empty($pickedc)){
			foreach ($pickedc as $value) {
				$cid2 = $value["Course_ID"];
			}
			$picked =  $this->data->fetchRows("SELECT * FROM course WHERE Course_ID='$cid2'");
		}
		$sametime=0;
		$sql="SELECT * FROM picked_course WHERE Detail_ID='$cdid' AND Student_CWID = '$CWID'";
		if($this->data->fetchRows($sql)){
			$error['HeadErr']="You Have Already Enrolled in A Section of This Course!";
			return $error;
		}
		else{
			if(!empty($picked)){
				foreach ($picked as $value) {
					if($thistime == $value['Time_Chunk']){
						$error['HeadErr']="You Have Class at This Time!";
						return $error;
					}
				}
			}
			$sql2="INSERT INTO picked_course VALUES ('','$cid','$cdid','$CWID',$thistime,'')";
			if ($this->data->query($sql2)){
				$error="";	
				return $error;

			}
		}
		$error['HeadErr']="Enrolled Unsuccessfully.";
		return $error;
	}
	function uploadfile(){
		$csid = $_GET['id'];
		$target_dir = 'file/'.$csid.'/';
		$target_file = $target_dir . basename($_FILES['fileup']['name']);
		if ( ! is_dir($target_dir)) {
   			mkdir($target_dir);
		}
		if(empty($_POST['filename']))
			$filename = $_FILES['fileup']['name'];
		else
			$filename = $_POST['filename'];
		if (move_uploaded_file($_FILES['fileup']['tmp_name'],$target_file)){ 
			$dir = $target_file;
			$CWID = $_SESSION['CWID'];
			$sql="SELECT * FROM files WHERE File_Name ='$filename' AND Directory = '$dir'";
			if($this->data->fetchRows($sql)){
				$error['HeadErr']="DD";
				return false;
			}
			$sql="INSERT INTO files VALUES ('','$filename','$csid','$CWID',1,'$dir',0)";
			if ($this->data->query($sql)){
				return true;	
			}
		}
		return false;
	}
	function addgradesec(){
		$csid = $_GET['id'];
		$fid =0;
		if(!empty($_FILES)){
			$target_dir = 'file/'.$csid.'/';
			$target_file = $target_dir . basename($_FILES['insup']['name']);
			$filename = $_POST['gdname'];
			if ( ! is_dir($target_dir)) {
   			mkdir($target_dir);
			}
			if (move_uploaded_file($_FILES['insup']['tmp_name'],$target_file)){ 
				$dir = $target_file;
				$CWID = $_SESSION['CWID'];
				$sql="INSERT INTO files VALUES ('','$filename','$csid','$CWID',2,'$dir',0)";
				$this->data->query($sql);
				$sql1="SELECT * FROM files WHERE File_Name ='$filename' AND Directory = '$dir'";
				$uploaded = $this->data->fetchRows($sql1);
				foreach ($uploaded as $value) {
					$fid = $value['File_ID'];
				}
			}
		}
		$gs_title = $_POST['gdname'];
		$persentage = $_POST['persentage'];
		$sql2="INSERT INTO grade_section VALUES ('','$gs_title','$csid','$persentage','$fid',0)";
		if ($this->data->query($sql2))
			return true;	
		else
			return false;
	}
	function update_grade($id,$cid){
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(@$_POST["grade"] != ""){
			$grade = test_input($_POST["grade"]);
			$sql="UPDATE picked_course SET Grade ='$grade' WHERE Student_CWID = $id AND Course_ID = $cid";
     		if ($this->data->query($sql)) return "";
     			else return false;
     	}
     	else return false;
	}
}

?>