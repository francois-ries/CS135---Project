<?php

class Model {

	public function getlogin()
 	{
 		// here goes some hardcoded values to simulate the database
  		if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
            // check database 
  
   			if($_REQUEST['username']=='admin' && $_REQUEST['password']=='admin'){
    			return 'login';
   			}
    		else{
    			return 'invalid user';
   			}
  		}
 	}
 
}

?>class Model{
    
}