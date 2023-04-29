<?php
	/**
	 * Description of Login
	 *
	 * @author Muhammad Ibrohim
	 */
	 
	class Login {
	    private $db; //database conection link
	     
	    public function __construct($database) {
	        $this->db = $database;
	    }
	    public function loginAdmin($username, $password) {
		    $result = $this->db->prepare("SELECT * FROM users WHERE username= ? AND password= ? AND blokir='N' ");
		    $result->bindParam(1, $username);
		    $result->bindParam(2, $password);
		    $result->execute();
		    $rows = $result->fetch();
		    return $rows;
		}
	}
?>