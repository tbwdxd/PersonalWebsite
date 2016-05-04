<?php
interface show_welcome
{
    public function get_name();
    public function print_message($name);
}

class user implements show_welcome
{
	public function get_name(){
		 $name= $_SESSION['Name'];
		 print_message($name);
	}
	public function print_message($name){
		echo "Dear $name, Login successful.";
		}
}

class user implements show_welcome
{
	public function get_name(){
		 $EID= $_SESSION['EID'];
		 print_message($EID);
	}
	public function print_message($name){
		echo "Employee #$name, welcome back to the dash board.";
		}
}


?>