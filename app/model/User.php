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
    
        if(""!==$id){
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


	  function readUser($id) {
        $sql = "SELECT * FROM users WHERE ID=" . $id;
        $db = $this->connect();
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc(); // Assuming fetch_assoc is the correct method
            $this->FName = $row["FName"];
            $this->LName = $row["LName"];
            $this->Email = $row["Email"];
            $this->Password = $row["Password"];
            // Add more attributes as needed
            $this->ID = $row["ID"];
            // Assuming UserType_obj is an object, you need to instantiate it
            $this->UserType_obj = new UserType($row["UserType_id"]); // Change UserType with the actual class name
        } else {
            // Handle the case when the user is not found
            $this->FName = "";
            $this->LName = "";
            $this->Email = "";
            $this->Password = "";
            $this->ID = "";
            $this->UserType_obj = null; // or handle UserType_obj accordingly
        }
    }
      

	
	
	
	public function deleteUser($ObjUser){
		$userID = $ObjUser->ID;
		$con = $GLOBALS['con'];


		// Delete related records in the ShoppingCart table
		$deleteShoppingCartQuery = "DELETE FROM ShoppingCart WHERE UserID = $userID";
		// Delete related records in the Wishlist table
		$deleteWishlistQuery = "DELETE FROM Wishlist WHERE UserID = $userID";
		// Delete related records in the Orders table
		$deleteOrdersQuery = "DELETE FROM Order_table WHERE UserID = $userID";
		// Delete related records in the Order Details  table
		//$deleteOrdersQuery = "DELETE FROM OrderDetails WHERE UserID = $userID";
        
		// Use a transaction to ensure both deletions succeed or fail together
		mysqli_autocommit($con, false);
		
		if (mysqli_query($con, $deleteShoppingCartQuery) && mysqli_query($con, $deleteWishlistQuery) && mysqli_query($con, $deleteOrdersQuery)) {
			// Both deletions were successful, commit the transaction
			mysqli_commit($con);
			mysqli_autocommit($con, true); // Restore autocommit mode
			// Then, delete the user
			$deleteUserQuery = "DELETE FROM users WHERE ID = $userID";
			if (mysqli_query($con, $deleteUserQuery)) {
                //header("Location:usercrud.php");
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

    function editinfo ($FN , $LN , $EM , $id){
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


    function editPW ($oldPW , $PW , $id){
       
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


$con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o","Jewelry_project");

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
	public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    // Getter and Setter for FriendlyName
    public function getFriendlyName()
    {
        return $this->FreindlyName;
    }

    public function setFriendlyName($FreindlyName)
    {
        $this->FreindlyName = $FreindlyName;
    }

    // Getter and Setter for LinkAddress
    public function getLinkAddress()
    {
        return $this->Linkaddress;
    }

    public function setLinkAddress($Linkaddress)
    {
        $this->LinkAddress = $Linkaddress;
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
class Address extends Model  {
    public $address_id;
    public $country;
    public $street;
    public $city;
    public $apartmentNumber;
    public $postalCode;
    public $userID;

    public function __construct($userID = null) {
        $this->db = $this->connect();
        if ($userID !== null) {
            $this->loadAddressByUserID($userID);
        }
    }

   
    public function loadAddressByUserID($userID) {
        $sql = "SELECT * FROM `address` WHERE `UserID` = $userID";
        $result = $this->connect()->query($sql);

        $addresses = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $address = new Address();
                $address->setAttributes($row);
                $addresses[] = $address;
                
            }
        }

        return $addresses;
    }

    private function setAttributes($row) {
        $this->address_id=$row['address_id'];
        $this->country = $row['Country'];
        $this->street = $row['street'];
        $this->city = $row['city'];
        $this->apartmentNumber = $row['apartmentnumber'];
        $this->postalCode = $row['PostalCode'];
        $this->userID = $row['UserID'];
    }
    public function createAddress($country, $street, $city, $apartmentNumber, $postalCode, $userID) {
        $sql = "INSERT INTO `address` (`Country`, `street`, `city`, `apartmentnumber`, `PostalCode`, `UserID`)
                VALUES ('$country', '$street', '$city', $apartmentNumber, $postalCode, $userID)";

        return $this->connect()->query($sql);
    }

    // Setters
    public function setCountry($country) {
        $this->country = $country;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setApartmentNumber($apartmentNumber) {
        $this->apartmentNumber = $apartmentNumber;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    // Getters
    public function getCountry() {
        return $this->country;
    }
    public function getAddressID (){
        return $this->address_id;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getCity() {
        return $this->city;
    }

    public function getApartmentNumber() {
        return $this->apartmentNumber;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getUserID() {
        return $this->userID;
    }
}


    

    // Add getters and setters as needed



// class UserType extends User {
// 	public $ID;
// 	public $UserTypeName;
// 	public $ArrayOfPages;
// 	// function __construct($id){
// 	// 	if ($id !=""){
// 	// 		$sql="select * from usertypes where ID=$id";
// 	// 		$result=mysqli_query($GLOBALS['con'],$sql);
// 	// 		if ($row = mysqli_fetch_array($result))	{
// 	// 			$this->UserTypeName=$row["Name"];
// 	// 			$this->ID=$row["ID"];
// 	// 			$sql="select PageID from usertype_pages where UserTypeID=$this->ID";
// 	// 			$result=mysqli_query($GLOBALS['con'],$sql);
// 	// 			$i=0;
// 	// 			while($row1=mysqli_fetch_array($result)){
// 	// 				$this->ArrayOfPages[$i]=new pages($row1[0]);
// 	// 				$i++;
// 	// 			}
// 	// 		}
// 	// 	}
// 	// }
// 	function __construct($id)
//     {
// 		$this->db = $this->connect();
// 		$db = $this->connect();
//         if ($id != "") {
//             $sql = "SELECT * FROM usertypes WHERE ID=$id";
//             $result = $db->query($sql);
            
//             if ($row = $db->fetchRow($result)) {
//                 $this->UserTypeName = $row["Name"];
//                 $this->ID = $row["ID"];
                
//                 $sql = "SELECT PageID FROM usertype_pages WHERE UserTypeID=$this->ID";
//                 $result = $db->query($sql);
                
//                 $i = 0;
//                 while ($row1=mysqli_fetch_array($result)) {
//                     $this->ArrayOfPages[$i] = new pages($row1[0]); // Assuming you have a Pages class
//                     $i++;
//                 }
//             }
//         }
//     }
	
// 	static function SelectAllUserTypesInDB(){
// 		$sql="select * from usertypes";
// 		$TypeDataSet = mysqli_query($GLOBALS['con'],$sql);
// 		$i=0;
// 		$Result;
// 		while ($row = mysqli_fetch_array($TypeDataSet))	{
// 			$MyObj= new UserType($row["ID"]);
// 			$Result[$i]=$MyObj;
// 			$i++;
// 		}
// 		return $Result;
// 	}
// }

// class pages extends User{
// 	public $ID;
// 	public $FreindlyName;
// 	public $Linkaddress;

// 	function __construct($id) {
// 		$this->db = $this->connect();
// 		$db = $this->connect();
//         if (!empty($id)) {
//             $sql = "SELECT * FROM pages WHERE ID = $id";
//             $result = $db->query($sql);

//             if ($row = $db->fetchRow($result)) {
//                 $this->FriendlyName = $row["FreindlyName"]; // Note: Corrected the variable name
//                 $this->LinkAddress = $row["Linkaddress"]; // Note: Corrected the variable name
//                 $this->ID = $row["ID"];
//             }
//         }
//     }
	
// 	static function SelectAllPagesInDB(){
// 		$sql="select * from pages";
// 		$PageDataSet = mysqli_query($GLOBALS['con'],$sql);		
// 		$i=0;
// 		$Result;
// 		while ($row = mysqli_fetch_array($PageDataSet))	{
// 			$MyObj= new pages($row["ID"]);
// 			$Result[$i]=$MyObj;
// 			$i++;
// 		}
// 		return $Result;
// 	}
// }
// ?>