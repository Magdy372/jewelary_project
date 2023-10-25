<?php
include_once("UserClass.php");

if(isset($_GET['edit_id'])){
    $UserObject = new User($_GET['edit_id']) ;
}

if(isset($_POST["submit"])){
    $Fname=$_POST["FName"];
    $Lname=$_POST["LName"];
    $Email=$_POST["Email"];
    
    $UserObject=User::editinfoinadmin($Fname,$Lname,$Email,$_GET['edit_id']);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">

            <label for="">First Name <span>*</span></label>
            <input type="text" name = "FName" value="<?=$UserObject->FName?>" >
        
        
            <label for="">Last Name <span>*</span></label>
            <input type="text"   name = "LName" value="<?=$UserObject->LName?>" >
        
            <label for="">Email <span>*</span></label>
            <input type="email" name = "Email" value="<?=$UserObject->Email?>">
        						
        
        <button type="submit"name="submit" class="btn btn-default login-btn">Submit</button>
    </form>						
</body>
</html>