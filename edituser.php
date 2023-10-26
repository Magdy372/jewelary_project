<?php
include_once("UserClass.php");

if(isset($_GET['edit_id'])){
    $UserObject = new User($_GET['edit_id']) ;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$FnameErr = $LnameErr = $EmailErr =  ""; 
$emailTaken = false;


include_once "UserClass.php";


if(isset($_POST['submit'])){ //check if form was submitted

	// Validate the first name field
    if (empty($_POST["FName"])) {
        $FnameErr = "First Name is required";
    } else {
        $name = test_input($_POST["FName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $FnameErr = "Only letters and white space allowed";
        }
    }

	// Validate the last name field
    if (empty($_POST["LName"])) {
        $LnameErr = "last Name is required";
    } else {
        $name = test_input($_POST["LName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $LnameErr = "Only letters and white space allowed";
        }
    }

    // Validate the email field
    if (empty($_POST["Email"])) {
        $EmailErr = "Email is required";
    } else {
        $email = test_input($_POST["Email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $EmailErr = "Invalid Email format";
        }
    }
    $email = test_input($_POST["Email"]);
    $UserID = $_GET['edit_id'];
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $sql1 = "SELECT * FROM users WHERE ID = '$UserID'";
    $result1 = mysqli_query($GLOBALS['con'], $sql1);

    $row = mysqli_fetch_array($result1);

    if (mysqli_num_rows($result) > 0 && $row['Email'] !== $email) {
        $EmailErr = "Email is already taken. please, login";
        $emailTaken = true;
    }
    

	if (empty($nameErr) && empty($emailErr) && !$emailTaken) {
		$FN=htmlspecialchars($_POST['FName']);
		$LN=htmlspecialchars($_POST['LName']);
		$EM=htmlspecialchars($_POST['Email']);
        $TY = htmlspecialchars($_POST['Typeid']);		

        $UserObject=User::editinfoinadmin($FN,$LN,$EM,$TY,$_GET['edit_id']);
	
	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditUser</title>
   
   
   <style>
             
    body {

        color: black;
        background: #D3D3D3;
        font-family: 'Lato', sans-serif;
        font-size: 15px;
        line-height: 1.42857;
        margin-left: 300px; /* Increase the margin to shift the content further right */
    }


    .container {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        text-align: center;
    }

    .container label {
        font-weight: bold;
    }

    .container input {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .container button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: auto; /* Push the button to the bottom of the container */
    align-self: center; /* Center the button horizontally */
}

    .container button:hover {
        background-color: #0056b3;
    }


.navbar {
            width: 250px;
            height: 100%;
            background-color: white;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar a {
            display: block;
            width: 60%;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            color: white;
            font-weight: bold;
            margin: 10px 0;
            border-radius: 5px;
            background-color: gray;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 0;
            padding: 20px;
        }

        /* Media query for smaller screens */
        @@media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .navbar {
                width: 200px;
                height: 100%;
                background-color: #333;
                position: fixed;
                left: 0;
                top: 0;
                color: white;
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .content {
                margin-left: 0;
            }
        }

        .logo {
            width: 150px;
            height: auto;
            margin: 20px 0;
        }
        @media (max-width: 768px) {
            .navbar {
                width: 100%;
                background-color: #007BFF;
                padding: 10px;
                align-items: flex-start;
            }

            .navbar a {
                padding: 10px 20px;
                margin: 10px 0;
            }

            .logo {
                width: 100px;
                margin: 10px 0;
            }
        }


    </style>
</head>
<body>
   
    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
   
    </div>
    <form method="post">
    <div class="container">        
        <h2>Edit User</h2>

            <label for="">First Name <span style="color:red">*<?=$FnameErr?></span></label>
            <input type="text" name = "FName" value="<?=$UserObject->FName?>" required >
        
        
            <label for="">Last Name <span style="color:red">*<?=$LnameErr?></span></label>
            <input type="text"   name = "LName" value="<?=$UserObject->LName?>"  required >
        
            <label for="">Email <span style="color:red">*<?=$EmailErr?></span></label>
            <input type="email" name = "Email" value="<?=$UserObject->Email?>" required >

            <label for="$Typeid">Type:</label>
            <select name="Typeid" id="Typeid">
                <option value='1'>Admin</option>
                <option value='2'>User</option>
            </select><br>
        						
        
        <button type="submit"name="submit" class="btn btn-default login-btn">Submit</button>
</div>
    </form>						
</body>
</html>