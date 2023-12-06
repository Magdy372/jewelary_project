<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "controller/UserController.php");
?>
<?php


class User extends Model 
{
	public $FName;
	public $LName;
	public $Email;
	public $Password;
	public $UserType_obj;
	public $ID;


	// public function __construct()
    // {
        
 	// 	$this->db = $this->connect();
        
    // }

    function __construct($id,$Fname="",$Lname ="" ,$Email="",$password="" ) {
        $this->id = $id;
		$this->db = $this->connect();
    
        if(""===$id){
          $this->readUser($id);
        }else{
          $this->FName = $Fname;
          $this->LName = $Lname;
          $this->Password=$password;
          $this->Email = $Email;
        }
      }
    

    public function getFName()
    {
        return $this->FName;
    }

    public function setFName($FName)
    {
        $this->FName = $FName;
    }

    // Getter and Setter for LName
    public function getLName()
    {
        return $this->LName;
    }

    public function setLName($LName)
    {
        $this->LName = $LName;
    }

    // Getter and Setter for Email
    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    // Getter and Setter for Password
    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    // Getter and Setter for UserType_obj
    public function getUserTypeObj()
    {
        return $this->UserType_obj;
    }

    public function setUserTypeObj($UserType_obj)
    {
        $this->UserType_obj = $UserType_obj;
    }

    // Getter and Setter for ID
    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }



    function readUser($id){
        $sql = "SELECT * FROM user where ID=".$id;
        $db = $this->connect();
        $result = $db->query($sql);
        if ($result->num_rows == 1){
          $row = $db->fetchRow();
          $this->name = $row["Name"];
          $_SESSION["Name"]=$row["Name"];
          $this->password=$row["Password"];
          $this->age = $row["Age"];
          $this->phone = $row["Phone"];
        }
        else {
          $this->name = "";
              $this->password="";
          $this->age = "";
              $this->phone = "";
        }
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
		// $sql="delete from users where ID=".$ObjUser->ID;
		// if(mysqli_query($GLOBALS['con'],$sql))
		// 	return true;
		// else
		// 	return false;


		// $userID = $ObjUser->ID;
		// $con = $GLOBALS['con'];
		
		// // Delete related records in the ShoppingCart table
		// $deleteShoppingCartQuery = "DELETE FROM ShoppingCart WHERE UserID = $userID";
		// if (mysqli_query($con, $deleteShoppingCartQuery)) {
		// 	// Then, delete the user
		// 	$deleteUserQuery = "DELETE FROM users WHERE ID = $userID";
		// 	if (mysqli_query($con, $deleteUserQuery)) {
		// 		return true; // User and related ShoppingCart records deleted successfully
		// 	}
		// }
		
		// return false; // Deletion failed	


		$userID = $ObjUser->ID;
		$con = $GLOBALS['con'];

		// Delete related records in the ShoppingCart table
		$deleteShoppingCartQuery = "DELETE FROM ShoppingCart WHERE UserID = $userID";
		// Delete related records in the Wishlist table
		$deleteWishlistQuery = "DELETE FROM Wishlist WHERE UserID = $userID";

		// Use a transaction to ensure both deletions succeed or fail together
		mysqli_autocommit($con, false);
		
		if (mysqli_query($con, $deleteShoppingCartQuery) && mysqli_query($con, $deleteWishlistQuery)) {
			// Both deletions were successful, commit the transaction
			mysqli_commit($con);
			mysqli_autocommit($con, true); // Restore autocommit mode
			// Then, delete the user
			$deleteUserQuery = "DELETE FROM users WHERE ID = $userID";
			if (mysqli_query($con, $deleteUserQuery)) {
				return true; // User and related ShoppingCart and Wishlist records deleted successfully
			}
		}
		
		// At least one deletion failed, rollback the transaction
		mysqli_rollback($con);
		mysqli_autocommit($con, true); // Restore autocommit mode
		return false; // Deletion failed
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


	
    static function editinfoinadmin ($FN , $LN , $EM , $TY , $id){
		//check if form was submitted
			  $Fname=$FN;
			  $Lname=$LN;
			  $Email=$EM;
			  $Type=$TY;
  
			  $sql="update  users set FName='$Fname', LName='$Lname', Email='$Email' , UserType_id='$Type'
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