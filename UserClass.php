<?php
//include "DB.php";
$con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o","Jewelry_project");

class User
{
	public $FName;
	public $LName;
	public $Email;
	public $Password;
	public $UserType_obj;
	public $ID;
	
	function __construct($id)	{
		if ($id !=""){
			$sql="select * from users where 	ID=$id";
			$User = mysqli_query($GLOBALS['con'],$sql);
			if ($row = mysqli_fetch_array($User)){
				$this->FName=$row["FName"];
				$this->LName=$row["LName"];
				$this->Email=$row["Email"];
				$this->Password=$row["Password"];
				$this->ID=$row["ID"];
                $this->UserType_obj = new UserType($row["UserType_id"]);
			}
		}
	}
	
	// static function login($Email,$Password){
	// 	$sql="SELECT * FROM users WHERE Email='$Email' and Password='$Password'";	
	// 	$result=mysqli_query($GLOBALS['con'],$sql);
	// 	if ($row=mysqli_fetch_array($result)){
	// 		return new User($row[0]); 		
	// 	}
	// 	return NULL;
	// }

	static function login($Email, $Password) {
		$sql = "SELECT * FROM users WHERE Email = '$Email'";
		$result = mysqli_query($GLOBALS['con'], $sql);
	
		if ($row = mysqli_fetch_array($result)) {
			$storedPassword = $row['Password'];
			if (password_verify($Password , $storedPassword)) {
				return new User($row['ID']);
			}
			else{
				echo "Email or password is incorrect ;)";
			}
		}
	
		return NULL;
	}
	
	static function SelectAllUsersInDB(){
		$sql = "select * from users";
		$con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");
		$Users = mysqli_query($con, $sql);
		$i = 0;
		$Result = array(); // Initialize $Result as an array
	
		while ($row = mysqli_fetch_array($Users)) {
			$MyObj = new User($row["ID"]);
			$Result[$i] = $MyObj;
			$i++;
		}
	
		return $Result;
	}
	
	
	static function deleteUser($ObjUser){
		$sql="delete from users where ID=".$ObjUser->ID;
		if(mysqli_query($GLOBALS['con'],$sql))
			return true;
		else
			return false;
	}
	
	
	static function InsertinDB_Static($FN, $LN, $EM, $PW) {
		// Hash the password using the default algorithm (bcrypt)
	
		//$sql = "INSERT INTO users (FName, LName, Email, Password , UserType_id) VALUES ('$FN', '$LN', '$EM', '$hashedPW', 2)";
		$sql = "insert into users(FName,LName,Email,Password,UserType_id) values ('$FN','$LN','$EM','$PW',2)";
		if (mysqli_query($GLOBALS['con'], $sql)) {
			return true;
		} else {
			return false;
		}
	}

	function UpdateMyDB(){
		$sql="update users set UserName='".$this->UserName."' ,Password='$this->Password' where ID=".$this->ID."";
		if(mysqli_query($GLOBALS['con'],$sql))
			return true;
		else
			return false;	
	}	

    static function editinfo ($FN , $LN , $EM , $id){
      //check if form was submitted
            $Fname=$FN;
            $Lname=$LN;
            $Email=$EM;

            $sql="update  users set FName='$Fname', LName='$Lname', Email='$Email'
            where ID ='$id' ;";
        
            $result=mysqli_query($GLOBALS['con'],$sql);
            if($result)	{
                // $_SESSION["FName"]=$Fname;
                // $_SESSION["LName"]=$Lname;
                // $_SESSION["Email"]=$Email;
                // $_SESSION["Password"]=$Password;
                
                //header("Location:user_accountpage#.php");
                //exit;
            }
            else {
                echo $sql;
            }
    }


    static function editPW ($oldPW , $PW , $id){
       
        $Password = $PW;
        $oldPass = $oldPW;

        $sql = "SELECT Password FROM users WHERE ID = $id";
        $result = mysqli_query($GLOBALS['con'], $sql);

        if (!$result) {
            echo "Error executing SQL query.";
            exit();
        }

        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            echo "User not found.";
            exit();
        }

        $storedPassword = $row['Password'];

        // Compare the old password entered with the stored password
		
        if (password_verify($oldPass , $storedPassword)) {
            // Passwords match; proceed to update the password
            // You should hash and salt the new password for security.
            //$hashedNewPassword = password_hash($Password, PASSWORD_DEFAULT);

			$hashedPW = password_hash($Password , PASSWORD_DEFAULT , ["cost" => 12] );

            $updateSql = "UPDATE users SET Password = '$hashedPW' WHERE ID = $id";
            $updateResult = mysqli_query($GLOBALS['con'], $updateSql);

            if ($updateResult) {
                echo " Edited Successfully :)";
            } else {
                echo "Error updating password.";
            }
        } else {
            echo "Old password is incorrect.";
        }
    
    
    }


	
    static function editinfoinadmin ($FN , $LN , $EM , $id){
		//check if form was submitted
			  $Fname=$FN;
			  $Lname=$LN;
			  $Email=$EM;
  
			  $sql="update  users set FName='$Fname', LName='$Lname', Email='$Email'
			  where ID ='$id' ;";
		  
			  $result=mysqli_query($GLOBALS['con'],$sql);
			  if($result)	{
				  // $_SESSION["FName"]=$Fname;
				  // $_SESSION["LName"]=$Lname;
				  // $_SESSION["Email"]=$Email;
				  // $_SESSION["Password"]=$Password;
				  
				  header("Location:usercrud.php");
				  exit;
			  }
			  else {
				  echo $sql;
			  }
	  }
}
class UserType {
	public $ID;
	public $UserTypeName;
	public $ArrayOfPages;
	function __construct($id){
		if ($id !=""){
			$sql="select * from usertypes where ID=$id";
			$result=mysqli_query($GLOBALS['con'],$sql);
			if ($row = mysqli_fetch_array($result))	{
				$this->UserTypeName=$row["Name"];
				$this->ID=$row["ID"];
				$sql="select PageID from usertype_pages where UserTypeID=$this->ID";
				$result=mysqli_query($GLOBALS['con'],$sql);
				$i=0;
				while($row1=mysqli_fetch_array($result)){
					$this->ArrayOfPages[$i]=new pages($row1[0]);
					$i++;
				}
			}
		}
	}
	
	static function SelectAllUserTypesInDB(){
		$sql="select * from usertypes";
		$TypeDataSet = mysqli_query($GLOBALS['con'],$sql);
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($TypeDataSet))	{
			$MyObj= new UserType($row["ID"]);
			$Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
	}
}

class pages {
	public $ID;
	public $FreindlyName;
	public $Linkaddress;

	function __construct($id){
		if ($id !=""){	
			$sql="select * from pages where ID=$id";
			$result2=mysqli_query($GLOBALS['con'],$sql) ;
			if ($row2 = mysqli_fetch_array($result2)){
				$this->FreindlyName=$row2["FreindlyName"];
				$this->Linkaddress=$row2["Linkaddress"];
				$this->ID=$row2["ID"];
			}
		}
	}
	
	static function SelectAllPagesInDB(){
		$sql="select * from pages";
		$PageDataSet = mysqli_query($GLOBALS['con'],$sql);		
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($PageDataSet))	{
			$MyObj= new pages($row["ID"]);
			$Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
	}
}
?>