<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/User.php");

class Users extends Model {
	private $users;
	function __construct() {
        $this->db = $this->connect();
	}


	function getUsers() {
		return $this->users;
	}


    function InsertinDB_Static($FN, $LN, $EM, $PW) {
		//trying to adding validation on Email to check if this email are token or no 
		// $sql = "SELECT * FROM users WHERE Email = '$email'";
        // $result = $this->$db->query($sql);
    
        // if ($result && $result->num_rows > 0) {
        //     $EmailErr = "Email is already taken. Please, login.";
        //     $emailTaken = true;
        // }

		$sql1 = "insert into users(FName,LName,Email,Password,UserType_id) values ('$FN','$LN','$EM','$PW',2)";
		if($this->db->query($sql1) === true){
			echo "Records inserted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql1. " . $conn->error;
		}
		
		
	}

    
    function login($Email, $Password) {
		$sql = "SELECT * FROM users WHERE Email = '$Email'";
		//$result = mysqli_query($GLOBALS['con'], $sql);
		$result = $this->db->query($sql);
		if ($result->num_rows == 1) {
			$row = $this->db->fetchRow();
			$storedPassword = $row['Password'];
			if (password_verify($Password , $storedPassword)) {
				$_SESSION["UserID"]=$row["ID"];
				$_SESSION["Name"]=$row["FName"];
				header("Location:../public/index.php");
			}
			else{
				echo "Email or password is incorrect ;)";
			}
		}
	}
	
}