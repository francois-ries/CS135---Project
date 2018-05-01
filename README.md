# CS135 Project: Classroom Reservation System

**Project Team**  
Klaudia Dziewulski, François Ries, Wenonah Zhang


**Motivation**   
CMC campus does not have enough space for students to have club meetings, host events or study in groups. 
To encourage collaborative work on campus, we would like to create a user-friendly system to allow students to reserve any classroom online.

**How to Deloy**   
			
1. Database 
	*  Use `database.sql` file as the source to create the database.  
	*  Run  `dummy_data.sql` file in mysql console.  
2. Register your account
	* Fill required information and **use student id in 5C consortium**

	* For register as an *admin*, enter admin key: `secretkey`.  
	* For register an an *regular user*, leave admin key blank.  
	* **You cannot register multiple accounts with the same student id.**  
* 	Login 
   * It will automatically direct you to the correct interface. 
*  Make a Reservation
   *   Put down your reservation time, location, equipment, capacity.
   *   Click submit.
   *   Click book for the reservation you prefer.
* Admin 
   * Click Approve or Deny for pending reservations. 
   * View all the current reservation.
   * Update room feature. 
     * Search by a room name, ex: LC 100
     * The current room feature will be loaded.
     * Update the feature and click submit.

**Highlights**  
* 	MVC Design Pattern 
*  Lots of Functionalities! 
     
### Have fun playing around with our classroom reservation system.
  

 