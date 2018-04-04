<?php

class Model {

	public function getlogin()
 	{
		// return "cool" ;
		// here goes some hardcoded values to simulate the database
		if(isset($_REQUEST['register'])){
			return 'register';
		}
		
  		if(isset($_REQUEST['sid']) && isset($_REQUEST['password'])){
			// check database 
  
   			if($_REQUEST['sid']=='admin' && $_REQUEST['password']=='admin'){
    			return 'login';
   			}
    		else{
    			return 'invalid user';
   			}
		}

 	}
 
}

?>