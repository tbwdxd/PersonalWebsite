
<?php

class DataAccess {
    
	private static $instance;
    public $link_id;
    public $query_id;
	
    private function __construct($host,$user,$pass,$db) {
        $this->link_id=mysql_pconnect($host,$user,$pass);
        mysql_select_db($db,$this->link_id);
    }
    public static function getInstance($host,$user,$pass,$db) {
        if(!isset(DataAccess::$instance)) {
            DataAccess::$instance = new DataAccess($host,$user,$pass,$db);
        }
		return(DataAccess::$instance);
    }
    public function query($sql) {
        $this->query_id=mysql_unbuffered_query($sql,$this->link_id);
        if ($this->query_id) return true;
  		else return false;
	}
    public function fetchRows($sql) {
   	    $this->query($sql);	
 		$arr=array();
  		$i=0;
  		while( $row=mysql_fetch_array($this->query_id,MYSQL_ASSOC) ){   
			$arr[$i]=$row;
      		$i++;
  		}
        return $arr; 
    }
}
?>
