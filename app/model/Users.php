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

		$sql1 = "insert into users(FName,LName,Email,Password,UserType_id) values ('$FN','$LN','$EM','$PW',2)"; //2 de user id 
		if($this->db->query($sql1) === true){
			echo "Records inserted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql1. " . $conn->error;
		}
		
		
	}

	function InsertinDB_Static_admin($FN, $LN, $EM, $PW) {
		$sql2 = "INSERT INTO users (FName, LName, Email, Password, UserType_id) VALUES ('$FN', '$LN', '$EM', '$PW', 1)"; //1 de admin id
	
		

		if ($this->db->query($sql2) === true) {
			echo "Records inserted successfully.";
		} else {
			echo "ERROR: Could not able to execute $sql1. " . $this->db->error;
		}
	}
	
	
	public function getAdminsByUserType($userType)
    {
        // Adjust the query based on your database structure
        $sql = "SELECT * FROM users WHERE UserType_id = $userType";
        $result = $this->db->query($sql);

        $admins = [];
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }

        return $admins;
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

	function EmailCheck ($email){
        $db = $this->connect();
        $sql = "SELECT * FROM users WHERE Email = '$email'";
		$result = $this->db->query($sql);
        if ($result->num_rows == 1) {
          return true;
        } else {
           return false;
        }
    }

	public function SelectAllUsersInDB() {
		$sql = "SELECT * FROM users";
		$users = $this->db->query($sql); // Use the query function
	
		$result = array(); // Initialize $result as an array
	
		while ($row = $this->db->fetchRow($users)) { // Use the fetchRow function
			//$userObj = new User($row["ID"]);
			$result[] = $row;
		}
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
	
		return $result;
	}
	public function deleteAdmin($adminID) {
		// Adjust the query based on your database structure
		$sql = "DELETE FROM users WHERE ID = $adminID";
		$this->db->query($sql);
	}
}


